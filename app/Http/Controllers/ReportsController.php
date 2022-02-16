<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectCalendar;
use App\ProjectSupervisor;
use App\Proposal;
use App\Program;
use App\Proposal_Program;
use App\User;
use App\Branch;
use App\ProjectStudent;
use App\projectGroup;
use App\StatuProposal;
//use Barryvdh\DomPDF\PDF
use PDF;
use Excel;

class ReportsController extends Controller
{

    public function export_user_as_pdf($id){

        $user = User::findOrfail($id);
        // // $user = User::Where('id', $id)->get();
        //return view('Reports.Administrator.user_info', compact('user'));
        $pdf = PDF::loadView('Reports.Administrator.user_info', compact('user'));
        return $pdf->download('user_info.pdf');
    }
    public function export_users_as_excle(){
       
      
        $users=User::all();

        //$users = $allUsers->get('id', 'Name', 'username', 'Gender', 'PhoneNumber', 'Email', 'Roles', 'IsActive', 'status', 'created_at', 'updated_at', 'deleted_at');
        Excel::create('جميع مستخدمي نظام ادارة مشاريع التخرج', function ($excel) use ($users) {
            $excel->sheet('جميع مستخدمي النظام', function ($sheet) use ($users) {
                $sheet->loadView('Reports.Administrator.all_users', compact('users'));
            });
        })->export('xlsx');
        return redirect()->back();
    }
    public function export_students_as_excle(){
        $PS = ProjectStudent::all();
        Excel::create('طلبة مشروع التخرج', function ($excel) use ($PS) {
            $excel->sheet('جميع الطلبة المسجلين', function ($sheet) use ($PS) {
                $sheet->loadView('Reports.Project-Committee.students', compact('PS'));
            });
        })->export('xlsx');
        return redirect()->back();
    }
    public function export_supervisors_as_excle(){
        $Supervisors = ProjectSupervisor::all();
        Excel::create('بيانات المشرفين', function ($excel) use ($Supervisors) {
            $excel->sheet('جميع المشرفين لمشاريع التخرج', function ($sheet) use ($Supervisors) {
                $sheet->loadView('Reports.Project-Committee.supervisors', compact('Supervisors'));
            });
        })->export('xlsx');
        return redirect()->back();
    }
    




    public function MyStudentGroup($id){
        $group = projectGroup::findOrfail($id);
        $GP =  $group->proposals_id;
        $GB = $group->branches_id;
        $GLader = $group->GroupLader;
        if($GB == '1'){
            $Team = ProjectStudent::where([['branches_id','1'],['project_groups_id',$id]])->get(); // Get Team item
            $coler = 'info';
            $TypeStudent = 'طلاب';
            return view('Reports.FacultyMember.deteils-my-group',compact('group','coler','Team','TypeStudent'));
        }
        elseif($GB == '2'){
            $Team = ProjectStudent::where([['branches_id','2'],['project_groups_id',$id]])->get(); // Get Team item
            $coler = 'danger';
            $TypeStudent = 'طالبات';
            return view('Reports.FacultyMember.deteils-my-group',compact('group','coler','Team','TypeStudent'));
        }
        else{
            session()->push('m','error');
            session()->push('m','حدث خطأ ، في عدم تواجد المجموعة التي اخترتها يرجي ابلاغ مهندس صيانة النظام');   
            return redirect()->back();

        }
    }
}
