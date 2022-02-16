<?php

namespace App\Http\Middleware;

use Closure;

class EndTimeCreateGroup
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
        if(Time_Now() > End_TimeCreateGroup()){   
            session()->push('m','error');
            session()->push('m',"لقد أنتهى الوقت المخصص لإنشاء المجموعات");   
            return redirect()->back();
        }
        return $next($request);
    }
}
