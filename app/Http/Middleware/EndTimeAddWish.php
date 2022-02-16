<?php

namespace App\Http\Middleware;

use Closure;

class EndTimeAddWish
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
        if(Time_Now() > End_TimeChooseWishes()){
            session()->push('m','error');
            session()->push('m',"لقد أنتهى الوقت المخصص لاختيار الرغبات");   
            return redirect()->back();

        }
        return $next($request);
    }
}
