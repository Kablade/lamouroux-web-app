<?php

/*
|--------------------------------------------------------------------------
| Controller User
|--------------------------------------------------------------------------
|
| Ce contrôleur gère les routes liées aux User (login, logout, signature)
|
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer as Customer;
use URL;

class UserController extends Controller
{
  protected static $dateFormat = 'd/m/Y H:i';

  //On récupère la liste de tous les clients / contacts
  public function getCustomerList()
  {
    $customers = Customer::where('name', '<>', '');

    return view('customer.customerList')->with(['customers' => $customers]);
  }

  //On récupère un client spécifique pour afficher sa carte, et les contacts liés
  public function getCustomer($id)
  {
    $customer = Customer::where('id', '=', $id)->first();
    $contacts = Customer::where('company_no', '=', $id);

    return view('customer.customerCard')->with(['customer' => $customer, 'contacts' => $contacts]);
  }
}
