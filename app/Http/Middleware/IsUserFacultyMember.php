<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\ProjectSupervisor;

class IsUserFacultyMember
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
        if(Auth::user()->Roles == 4){ 
            $UserId = \Auth::user()->id; 
            if(Auth::user()->IsActive ==1){
                $Studdent = ProjectSupervisor::where('users_id',$UserId)->first();
                if($Studdent){
                    return $next($request);
                }else{
                    auth()->logout();
                    return redirect('error')->withFlashMessage('لايوجد لديك رقم مستخدم في جدول أعضاء هيئة التدريس!!');
                }
               

            }else{
                auth()->logout();
                return redirect('error')->withFlashMessage('حسابك غير مفعل ، يرجي التواصل مع مدير النظام');
            }
        }
        return redirect('/');
    }
}
