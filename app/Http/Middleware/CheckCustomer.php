<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class CheckCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(Auth::guest())
      {
        return redirect()->route('login')->with('error','Login First');
      }
      else{
      $userRoles = Auth::user()->role;
      if($userRoles == 'customer'){
        return $next($request);
      }
      return redirect('login');
    }
  }
}
