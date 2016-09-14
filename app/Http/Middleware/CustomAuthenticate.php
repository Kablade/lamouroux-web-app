<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuthenticate
{
  public function handle($request, Closure $next)
  {
    $user = Auth::user();
    
    if(Auth::user() == null)
      return redirect()->guest('users/login');

    return $next($request);
  }
}
