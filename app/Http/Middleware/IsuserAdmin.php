<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class IsuserAdmin
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
        if($request->user() === null){
             return redirect('/');
        }
        if(Auth::user()->Roles == 1){
          if(Auth::user()->IsActive ==1){
            return $next($request);
          }
          else{
            auth()->logout();
            return redirect('error')->withFlashMessage('حسابك غير مفعل ، يرجي التواصل مع مدير النظام');
          }
          
        }
        return redirect('/');  
    }
}



