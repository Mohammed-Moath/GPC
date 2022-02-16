<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\ProjectStudent;
use App\Calendar;

class IsUserStudent
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
        if(Auth::user()->Roles == 3){
            $UserId = \Auth::user()->id; 
            if(Auth::user()->IsActive ==1){
                $Studdent = ProjectStudent::where('users_id',$UserId)->first();
                if($Studdent){
                    $Calendar=Calendar::where('Current','1')->first();
                    if($Calendar){
                        return $next($request);
                    }else{
                        auth()->logout();
                        return redirect('error')->withFlashMessage('عذراً لم يتم تفعيل التقويم وفتح النظام من قبل لجنة المشاريع.');
                    }
                   
                }else{
                    auth()->logout();
                    return redirect('error')->withFlashMessage('لايوجد لديك رقم مستخدم في جدول الطلاب!!');
                }
               

            }else{
                auth()->logout();
                return redirect('error')->withFlashMessage('حسابك غير مفعل ، يرجي التواصل مع مدير النظام');
            }
           
        }
        return redirect('/');
    }
}
