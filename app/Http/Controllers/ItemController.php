<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\Item as Item;
use App\Models\QuantityItemPerLocation as QuantityItemPerLocation;

class ItemController extends Controller
{
  public function get(Request $request)
  {
    $items = Item::query();

    $searchDescription = $request->input('description');
    $searchId = $request->input('id');

    if($searchDescription !== null) {
      $items = $items->where('description', 'like', '%'.$searchDescription.'%');
    }

    if($searchId !== null) {
      $items = $items->orWhere('id', 'like', '%'.$searchId.'%');
    }

    return response()->json(['data' => $items->get()]);
  }

  public function getAll(Request $request)
  {
    $QuantityItemPerLocation = array();
    $items = Item::all();
    foreach ($items as $item)
    {
      $item_per_location = QuantityItemPerLocation::where([['item_id', '=', $item->id], ['location_code', '=', Auth::user()->userdata->location_code]])->first();
      $QuantityItemPerLocation[$item->id] = $item_per_location->quantity;
    }
    
    return view('items.itemsList',  ['items'=> $items , 'QuantityItemPerLocation' => $QuantityItemPerLocation]);
  }
}
