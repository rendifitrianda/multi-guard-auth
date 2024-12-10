<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    //FILE MIDDLEWARE TEMPAT LOGIKA 
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // dd($roles);
        // Parameter $roles bisa berupa:
        // String: Nama peran tunggal.
        // Array: Daftar nama peran.
        
        if(Auth::check() && Auth::user()->hasAnyRole(['User', 'Costumer'])){
            return $next($request);
        }
            Auth::logout();
            
           return back()->withErrors([
            'email' => 'You do Not Have Access to admin area',
           ]);
    }
}
