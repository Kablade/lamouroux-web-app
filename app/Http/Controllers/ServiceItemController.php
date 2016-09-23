<?php

/*
|--------------------------------------------------------------------------
| Controller Service Item
|--------------------------------------------------------------------------
|
| Ce contrôleur gère la partie "entête de commande".
| Il permet donc d'afficher la liste des commandes, une commande en
| particulier, mais aussi les reports, validation et temps d'inter.
|
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Carbon\Carbon;
use App\Models\ServiceItemHeader as ServiceItemHeader;
use App\Models\ServiceItemLine as ServiceItemLine;
use App\Models\ServiceLine as ServiceLine;
use App\Models\Intervention as Intervention;

class ServiceItemController extends Controller
{
  protected static $dateFormat = 'd/m/Y H:i';

  //------------------------
  // Routes.
  //------------------------

  // Headers

  public function getAll()
  {
    $headers = ServiceItemHeader::where('description', '<>', '')->get();
    return view('service.list', ['headers'=>$headers]);
  }

  public function get($id)
  {
    $header = ServiceItemHeader::where('order_no',$id)->first();
    $lines = ServiceItemLine::where('order_no', $id)->get();

    return view('service.order',  ['header'=>$header], ['lines'=>$lines]);
  }

  // Intervention

  public function getIntervention($id)
  {
    $header = ServiceItemHeader::find($id);
    if(!$header)
      return headerNotFound();

    $interventions = Intervention::where('order_no', $id)->get();

    return view('service.intervention', ['header'=>$header, 'interventions' => $interventions]);
  }

  public function addIntervention($id, Request $request)
  {
    $header = ServiceItemHeader::find($id);
    if(!$header)
      return headerNotFound();

    $rules = [
      'start_date' => 'required|date_format:d/m/Y H:i',
      'end_date' => 'required|date_format:d/m/Y H:i|after:start_date',
      'description' => 'max:50',
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails())
    {
        return redirect()->route('header::getIntervention', $id)->with(['error' => true, 'messages' => $validator->messages()]);
    }

    $created = $header->interventions()->create([
      'start_date' =>  Carbon::createFromFormat('d/m/Y H:i', $request->input('start_date')),
      'end_date' => Carbon::createFromFormat('d/m/Y H:i', $request->input('end_date')),
      'description' => $request->input('description')
    ]);

    return redirect()->route('header::getIntervention', $id)->with(['error' => false, 'messages' => ['Temps ajouté avec succès.']]);
  }

  public function deleteIntervention($id, $intervId, Request $request)
  {
    Intervention::where('id', $intervId)->delete();
    return redirect()->route('header::getIntervention', $id)->with(['error' => false, 'messages' => ['Ligne supprimée avec succès.']]);
  }

  //------------------------
  // Utils.
  //------------------------

  //Methode appellée en cas d'erreur : "entête non trouvé"
  public function headerNotFound()
  {
    return redirect()->route('header::all')->with(['error' => true, 'messages' => ['Entête introuvable']]);
  }
}
