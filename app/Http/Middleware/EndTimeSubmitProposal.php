<?php

namespace App\Http\Middleware;

use Closure;
use App\ProjectCalendar;
use App\Calendar;

class EndTimeSubmitProposal
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
       /* $Calendar=Calendar::where('Current','2')->first();
        if($Calendar){
            return $next($request);
        }else{
            session()->push('m','info');
            session()->push('m','لم يتم فتح التقويم بعد من قبل الجنة');
            return redirect()->back();
        }*/
        if(Time_Now() > EndTimeSubmitProposal()){
            session()->push('m','error');
            session()->push('m','لقد أنتهي وقت تقديم مقترحات المشاريع');
            return redirect()->back();
        } 
        if(count(Calendar_Current()) == 0){
            session()->push('m', 'info');
            session()->push('m', 'لم يتم فتح التقويم وتقديم الطلبات من قبل اللجنة');
            return redirect()->back();

        }
        return $next($request);
    }
}
