<?php

namespace App\Http\Middleware;

use Closure;
use App\ProjectStudent;
use App\projectGroup;
use App\Proposal;
use App\StatuProposal;

class JoinGroup
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
        $GroupId = $request->id;
        $UserId = \Auth::user()->id;
        $UserGender = \Auth::user()->Gender;
        $GetGroup =  projectGroup::findOrfail($GroupId);
        $ProposalId = $GetGroup->proposals_id;
        $GetProposal =  StatuProposal::where('proposal_id',$ProposalId)->first();
        if( $GetProposal != null){
                $GetNumberOfStudents = $GetProposal->NumberOfStudents;
                $GetNumberOfBoys= $GetProposal->NumberOfBoys;
                $GetNumberOfGirls= $GetProposal->NumberOfGirls;
                if($UserGender =="ذكر"){
                        if($GetNumberOfBoys > $GetNumberOfStudents){
                            session()->push('m','error');
                            session()->push('m','عذراً ، لا تستطيع الانضمام الى هذه المجموعة لان العدد اصبح كافياً.قم باختيار مجموعة اخرى.');   
                            return redirect('group');}
                        else{
                    return $next($request);}
                }
                if($UserGender =="انثي"){
                        if($GetNumberOfGirls > $GetNumberOfStudents){
                            session()->push('m','error');
                            session()->push('m','عذراً ، لا تستطيع الانضمام الى هذه المجموعة لان العدد اصبح كافياً.قم باختيار مجموعة اخرى.');   
                            return redirect('group');}
                        else{
                    return $next($request);}
                }
        }
        else{
            session()->push('m','error');
            session()->push('m','المعذرة هناك خطا في عدم تواجد مقترح المشروع ، يرجى التواصل مع مدير النظام');   
            return redirect('home/student');
        }
       
    }
}
