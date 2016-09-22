<?php

/*
|--------------------------------------------------------------------------
| Controller Service Line
|--------------------------------------------------------------------------
|
| Ce contrôleur gère les lignes de service.
| Ce qui permet de récupérer les articles, main d'oeuvre etc ...
|
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ServiceItemHeader as ServiceItemHeader;
use App\Models\ServiceItemLine as ServiceItemLine;
use App\Models\ServiceLine as ServiceLine;
use App\Models\Item as Item;
use Validator;

class ServiceLineController extends BaseController
{
  //Methode GET. Toutes les lignes de service
  public function get($headerId, $resId)
  {
    $header = ServiceItemHeader::where('order_no',$headerId)->first();
    $serviceLines = ServiceLine::where([
      ['order_no', '=', $headerId],
      ['service_item_line_resource_no', '=', $resId],
      ])->get();

    return view('service.serviceLines',  ['header'=> $header , 'ressourceId' => $resId, 'serviceLines'=> $serviceLines]);
  }

  //Méthode POST. Enregistre les nouvelles lignes de service.
  public function post($headerId, $resId, Request $request)
  {
    $header = ServiceItemHeader::where('order_no',$headerId)->first();
    $serviceLines = ServiceLine::where([
      ['order_no', '=', $headerId],
      ['service_item_line_resource_no', '=', $resId],
      ])->get();

    $error = false;
    $messages = [];

    $rules = [
      'type' => 'required',
      'id' => 'required',
      'quantity' => 'required|numeric',
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails())
    {
      $messages=$validator->messages();
      $error=true;
      return redirect()->route('header::lines::get',  ['header'=> $header , 'ressourceId' => $resId, 'serviceLines'=> $serviceLines])
      ->with(['error' => $error, 'messages' => $messages]);
    }
    else
    {
      $item = Item::where('id', $request->input('id'))->first();
      $error=false;
      $messages[]='Ligne ajoutée avec succès';
      $serviceLine = new ServiceLine;
      $serviceLine->order_no = $headerId;
      $serviceLine->service_item_line_resource_no = $resId;
      $serviceLine->type = $request->input('type');
      $serviceLine->no = $request->input('id');
      $serviceLine->description = $item->description;
      $serviceLine->quantity = $request->input('quantity');
      $serviceLine->save();

      return redirect()->route('header::lines::get',  ['header'=> $header , 'ressourceId' => $resId, 'serviceLines'=> $serviceLines])
      ->with(['error' => $error, 'messages' => $messages]);
    }
  }

  //Methode GET. Affichage de la vue des fluides.
  public function getFluid($headerId, $resId)
  {
    $serviceItemLine = ServiceItemLine::where([['order_no','=', $headerId],['resource_no','=',$resId]])->first();
    return view('service.fluid', ['lines'=>$serviceItemLine])->with(['headerId' => $headerId, 'resId' => $resId]);
  }

  //Methode POST. Verification saisie fluides et insertion.
  public function postFluid($headerId, $resId, Request $request)
  {
    $serviceItemLine = ServiceItemLine::where([['order_no','=', $headerId],['resource_no','=',$resId]])->first();
    $error = false;
    $messages = [];

    $rules = [
      'bottle-no' => 'required|max:20',
      'fluid-reintroduced' => 'numeric',
      'shift-bottle-no' => 'max:20',
      'fluid-new' => 'numeric',
      'fluid-recovered' => 'numeric',
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails())
    {
      $messages=$validator->messages();
      $error=true;
    }
    else
    {
      $error=false;
      $messages[]='Informations fluides enregistrées avec succès';
      $serviceItemLine->bottle_no = $request->input('bottle-no');
      $serviceItemLine->fluid_reintroduced = $request->input('fluid-reintroduced');
      $serviceItemLine->shift_bottle_no = $request->input('shift-bottle-no');
      $serviceItemLine->fluid_new = $request->input('fluid-new');
      $serviceItemLine->fluid_recovered = $request->input('fluid-recovered');
      $serviceItemLine->fluid_retired = $request->input('fluid-to-retreat');
      $serviceItemLine->save();
    }


    return redirect()->route('header::lines::fluid', [$headerId, $resId])->with(['error' => $error, 'messages' => $messages]);
  }
}
