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
use Auth;
use Validator;
use Carbon\Carbon;
use App\Models\UserData;
use Image;
use URL;

class UserController extends Controller
{
  protected static $dateFormat = 'd/m/Y H:i';

  public function getProfile()
  {
    $user = Auth::user();
    $userData = $user->userData;

    if($userData == null)
    {
      $user->userData()->create([]);
      $user->save();
      return redirect()->route('user::profile');
    }

    return view('user.profile')->with(['user' => $user]);
  }

  public function postProfile(Request $request)
  {
    $user = Auth::user();
    $error = false;
    $messages = [];

    $rules = [
      'username' => 'required|min:3|max:25|unique:user,username,'.$user->id,
      'email' => 'required|email',
      'password' => 'min:4',
      'confirm_password' => 'min:4|same:password',
      'checked_at' => 'date_format:d/m/Y H:i',
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails())
    {
        $error = true;
        $messages = $validator->messages();
    }
    else
    {
      $user->username = $request->input('username');

      if($request->input('password'))
        $user->password = sha1($request->input('password'));

      $user->email = $request->input('email');

      $userData = $user->userData;

      if($userData == null)
      {
        $userData = new UserData();
        $userData->user_id = $user->id;
      }

      $userData->location_code = $request->input('location_code');
      $userData->truck_brand = $request->input('truck_brand');
      $userData->truck_model = $request->input('truck_model');
      $userData->truck_serial_no = $request->input('truck_serial_no');

      if($request->input('checked_at'))
        $userData->checked_at = Carbon::createFromFormat('d/m/Y H:i', $request->input('checked_at'));

      $user->save();
      $userData->save();

      $messages[] = 'Modifications enregistrées avec succès';
    }

    return redirect()->route('user::postProfile')->with(['error' => $error, 'messages' => $messages]);
  }

  public function login()
  {
    return view('user.login');
  }

  public function doLogin(Request $request)
  {
    $username = $request->input('username');
    $password = $request->input('password');
    $rememberMe = $request->input('rememberMe');

    $error = false;
    $message = '';

    if(!Auth::attempt(['username' => $username, 'password' => $password], $rememberMe))
    {
      $error = true;
      $message = 'Identifiants invalides';

      return redirect()->back()->with(['error' => $error, 'message' => $message]);
    }

    return redirect()->route('header::all')->with(['error' => $error, 'message' => $message ]);
  }

  public function logout()
  {
    Auth::logout();
    return redirect(URL::previous());
  }

  public function signature(Request $request)
  {
    return view('user.sign');
  }

  public function postSignature(Request $request)
  {
    $user = Auth::user();
    $base64 = $request->input('pictureBase64');
    $image = Image::make($base64);
    $image->save(public_path().'/sign/'.$user->id.'.png', 70);

    return redirect()->route('user::signature');
  }

  public function getCustomers()
  {
    $customer = Customer::where('name', '<>', '');

    return redirect()->route('user::getCustomers')->with(['customers' => $customer]);
  }
}
