<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\Item as Item;

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
}
