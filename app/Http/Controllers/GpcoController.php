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
use App\GroupWishe;
use App\Grade;
use App\Meeting;
use App\Meeting_projectStudent;
use App\TypeDeliv;
use App\Deliv;
use App\Calendar;
use PDF;
use Excel;
use DB;
use App\SupervisorExpected;
use Carbon;


class GpcoController extends Controller
{
    // Home Page
    Public function HomeGPCO(){ // Page Home of GPCO
        try{
            return view('layouts.Home.GPCO');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله HomeGPCO.  "); 
        }
    }

    // Configuration
    Public function CalendarIndex(){// Call page index of calendar
        try{
            $Calendars = Calendar::where('Current','1')->get();
            $Type_filter = '1';
     
            return view('Project-Committee.Configuration.Calendar.index',compact('Calendars','Type_filter'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله CalendarIndex.  "); 
        }
    }
    Public function CalendarFilter(Request $request){// Call page index of calendar
        try{
           
            if($request->filter == 1){
                $Calendars = Calendar::where('Current','1')->get();
                $Type_filter = '1';
                return view('Project-Committee.Configuration.Calendar.index',compact('Calendars','Type_filter'));
            }
            if($request->filter == 2){
                $Calendars = Calendar::where('Active','1')->get();
                $Type_filter = '2';
                return view('Project-Committee.Configuration.Calendar.index',compact('Calendars','Type_filter'));
            }
            if($request->filter == 3){
                $Calendars = Calendar::where('Active','0')->get();
                $Type_filter = '3';
                return view('Project-Committee.Configuration.Calendar.index',compact('Calendars','Type_filter'));
            }
            if($request->filter == 4){
                $Calendars = Calendar::get();
                $Type_filter = '4';
                return view('Project-Committee.Configuration.Calendar.index',compact('Calendars','Type_filter'));
            }
            return redirect('project-committee/calendar');
        
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله CalendarIndex.  "); 
        }
    }
    Public function CalendarCreate(){// Call page create of calendar
        try{
            return view('Project-Committee.Configuration.Calendar.create');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله CalendarCreate.  "); 
        }
    }
    Public function CalendarStore(Request $request){// Call page create of calendar
        $this->validate($request,
            [
                'AcademicYear'=>'required',
                'Semester'=>'required',
                'Name'=>'nullable|max:100|min:5',
                'StartDate'=>'required',
                'EndDate'=>'required',
                'EndSubmissionProposals'=>'required',
                'EndCreateGroup'=>'required',
                'EndChooseWishes'=>'required'
            ],
            [
                'required'=>'يرجي أضافة البيانات',
                'Name.max'=>'أقصي عدد من الحروف 100 ',
                'Name.min'=>'أقل عدد من الحروف 5 ',
            ]
        );
        try{
            if($request->Name ==null){
                $name = " التقويم الخاص بمشاريع التخرج التي سجلت في الفصل الدراسي $request->Semester من العام الجامعي $request->AcademicYear";
            }
            if($request->Name !=null){
                $name = $request->Name;
            }
            if($request->Current !=null){
                $get_calendar= Calendar::where('Current','1')->get();
                if(count($get_calendar) > 0){
                    foreach($get_calendar as $cal){
                        $input = ['Current'=>'0'];
                        Calendar::where('id',$cal->id)->update($input);
                    }
                }
                $Current = $request->Current;
            }
            if($request->Current ==null){
                $Current = '0';
            }

            $New_Callendar = new Calendar;
            $New_Callendar->AcademicYear = $request->AcademicYear;
            $New_Callendar->Semester = $request->Semester;
            $New_Callendar->Name = $name;
            $New_Callendar->StartDate = $request->StartDate;
            $New_Callendar->EndDate = $request->EndDate;
            $New_Callendar->EndSubmissionProposals = $request->EndSubmissionProposals;
            $New_Callendar->EndCreateGroup = $request->EndCreateGroup;
            $New_Callendar->EndChooseWishes = $request->EndChooseWishes;
            $New_Callendar->Active = $request->Active;
            $New_Callendar->note = $request->note;
            $New_Callendar->Current = $Current;
            $New_Callendar->created_by = \Auth::user()->id;
            $New_Callendar->save();

            session()->push('m','success');
            session()->push('m','تم أنشاء التقويم بنجاح');   
            return redirect('project-committee/calendar');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله CalendarStore.  "); 
        }
    }
    

    Public function Conditions(){// Page Coditions of GPC
       /* $mytime = Carbon\Carbon::now()->format('m/d/Y h:i A');
        $Time_System_Now = date('m/d/Y h:i A');
        dd( $mytime,  $Time_System_Now);*/
        try{
            return view('GPCO.Configuration.Conditions');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله Conditions.  "); 
        }
    }
    Public function UpdateConditions(Request $request ,$id){// Update Sattings of Conditions
        try{ 
            $input = $request->all();
          
            ProjectCalendar::findOrfail($id)->update($input);
            session()->push('m','success');
            session()->push('m','تم حفظ الاعدادات بنجاح');   
            return redirect()->back();   
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله UpdateConditions.  "); 
        }
    }
    Public function Grades(){// Page Grades of GPC
        try{
            return view('GPCO.Configuration.Grades');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله Grades.  "); 
        }
    }
    Public function UpdateGrades(Request $request ,$id){// Update Sattings of Grades
        $this->validate($request,
            [
                'DegreeOfAttendance'=>'numeric|max:100|min:0',
                'DegreeOfDelivery'=>'numeric|max:100|min:0',
                'DegreeOfSupervisor'=>'numeric|max:100|min:0',
                'DegreeOfMidtermDiscussion'=>'numeric|max:100|min:0',
                'DegreeOfFinalDiscussion'=>'numeric|max:100|min:0',
            ],
            [
   
                'max'=>'أقصي عدد من الارقام 100 ',
                'min'=>'أقل عدد من الارقام 0 ',
            ]
        );
     
        try{ 
            $Sam =  $request->DegreeOfAttendance
                    +$request->DegreeOfDelivery
                    +$request->DegreeOfSupervisor
                    +$request->DegreeOfMidtermDiscussion
                    +$request->DegreeOfFinalDiscussion;
            if($Sam > 100){
                session()->push('m','error');
                session()->push('m',"لقد أضفت مجموع درجات اكبر من 100 وهي ($Sam)");   
                return redirect()->back();   

            }
            if($Sam <= 100){
                $input = $request->all();
                Grade::findOrfail($id)->update($input);
                session()->push('m','success');
                session()->push('m','تم حفظ الاعدادات بنجاح');   
                return redirect()->back(); 
            }
             
           
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله UpdateGrades.  "); 
        }
    }

    // Appointments
    Public function Deliveries(){// Page Deliveries of GPC
      
        try{
            $Deliveries = TypeDeliv::orderBy('id','desc')->paginate(10);
            return view('GPCO.Appointments.Deliveries',compact('Deliveries'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله Deliveries.  "); 
        }
    }
    Public function AddDeliveries(Request $request){// Update Deliverids of Grades
        $this->validate($request,
            [
            'Semester'=>'required',
            'name'=>'required',
            'time_open'=>'required',
            'time_close'=>'required',],
            ['required'=>'يرجي أضافة البيانات']
        );
        try{ 

            $input = $request->all();
            
            $input['users_id'] =\Auth::user()->id;
            $input['AcademicYear'] =AcademicYear_GPC();
            $input['Semester'] =$request->Semester;
            $Deliveries = TypeDeliv::create($input);
           
    
            session()->push('m','success');
            session()->push('m','تم حفظ الاعدادات بنجاح');   
            return redirect('appointments/deliveries');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله AddDeliveries.  "); 
        }
    }

    // Student Data
    Public function PageIndexStudentData(){// Page Index Student Data
        try{
            $All_Student = ProjectStudent::get()->count();
            $Center_Branch = ProjectStudent::where('branches_id','1')->get()->count();
            $Girls_Branch= ProjectStudent::where('branches_id','2')->get()->count();
            $Do_notHaveGroups= ProjectStudent::where('project_groups_id',null)->get()->count();
            return view('GPCO.Students.index',compact('All_Student','Center_Branch','Girls_Branch','Do_notHaveGroups'));  
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله PageIndexStudentData.  "); 
        }
    }
    Public function PageStudentDetails($id){// Page Student Data Details
        try{
            if($id == 1){
                $Student = ProjectStudent::paginate(10);  
                $Result_Type = 1;                 
                return view('GPCO.Students.details',compact('Student','Result_Type'));  
            }
            if($id == 2){
                $Student = ProjectStudent::where('branches_id','1')->paginate(10);
                $Result_Type = 2;                 
                return view('GPCO.Students.details',compact('Student','Result_Type'));    
            }
            if($id == 3){
                $Student= ProjectStudent::where('branches_id','2')->paginate(10);
                $Result_Type = 3;                 
                return view('GPCO.Students.details',compact('Student','Result_Type'));    
            }
            if($id == 4){
                $Student= ProjectStudent::where('project_groups_id',null)->paginate(10);
                $Result_Type = 4;                 
                return view('GPCO.Students.details',compact('Student','Result_Type'));  
            }
            return redirect()->back();     
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله PageStudentDetails.  "); 
        }
    }
    Public function StudentDataShow($AcdameicNumber){// Page Student Data Show
        try{
            $Student_Data = ProjectStudent::findOrfail($AcdameicNumber);
            return view('GPCO.Students.show',compact('Student_Data'));  
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله StudentDataShow."); 
        }
    }
    
    // Supervisor Data
    Public function PageIndexSupervisorsData(){// Page Index Supervisor Data
        try{
            $All_Supervisors = ProjectSupervisor::get()->count();
            $Desnat_Supervisors = ProjectSupervisor::where('StatuSupervision','0')->count();
            return view('GPCO.Supervisor.index',compact('All_Supervisors','Desnat_Supervisors'));  
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله PageIndexSupervisorsData.  "); 
        }
    }
    Public function PageSupervisorDetails($id){// Page Supervisor Data Details
        try{
            if($id == 1){
                $Supervisors = ProjectSupervisor::paginate(10);
                $Result_Type = 1;                 
                return view('GPCO.Supervisor.details',compact('Supervisors','Result_Type'));  
            }
            if($id == 2){
                $Supervisors = ProjectSupervisor::where('StatuSupervision','0')->paginate(10);
                $Result_Type = 2;                 
                return view('GPCO.Supervisor.details',compact('Supervisors','Result_Type'));    
            }
            return redirect()->back();     
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله PageSupervisorDetails.  "); 
        }
    }
    Public function SupervisorsDataShow($FunctionalNumber){// Page Supervisor Data Show
        try{
            $Supervisors_Data = ProjectSupervisor::findOrfail($FunctionalNumber);
            $Number_GroupsSupervisor = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor',$FunctionalNumber)->get()->count();
            return view('GPCO.Supervisor.show',compact('Supervisors_Data','Number_GroupsSupervisor'));  
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله SupervisorsDataShow."); 
        }
    }

    // Groups
    public function StatisticsGroups($id){
        try{
            
            if($id == 1){
                $Groups = projectGroup::paginate(10);
                $type=1;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            if($id== 2){
                $Groups = projectGroup::where('branches_id','1')->orderBy('created_at','desc')->paginate(10);
                $type=2;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            if($id == 3){
                $Groups = projectGroup::where('branches_id','2')->orderBy('created_at','desc')->paginate(10);
                $type=3;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            if($id == 4){
                $Groups = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor','>','0')->orderBy('created_at','desc')->paginate(10);
                $type=4;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            if($id == 5){
                $Groups = projectGroup::where('proposals_id','>','0')->orderBy('created_at','desc')->paginate(10);
                $type=5;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            if($id == 6){
                $Groups = projectGroup::where('proposals_id',null)->orderBy('created_at','desc')->paginate(10);
                $type=6;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            if($id == 7){
                $Groups = projectGroup::where('FN_Supervisor','>','0')->orderBy('created_at','desc')->paginate(10);
                $type=7;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            if($id == 8){
                $Groups = projectGroup::where('FN_Supervisor',null)->orderBy('created_at','desc')->paginate(10);
                $type=8;
                return view('GPCO.groups.StatisticsGroups',compact('Groups','type'));
            }
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله StatisticsGroups"); 
        } 

    }
    public function Page_Manage_Groups(){
        try{
            $All_Groups = projectGroup::get();  
            $Approved_Groups = projectGroup::where('proposals_id',">",'0')->count();
            $Approved_Supervisors = projectGroup::where('FN_Supervisor',">",'0')->count();
            $Branches_Boys = projectGroup::where('branches_id','1')->count();
            $Branches_Grils = projectGroup::where('branches_id','2')->count();
            $Null_Approved = projectGroup::where('proposals_id',null)->count();
            $Null_Supervisor = projectGroup::where('FN_Supervisor',null)->count();
            $WorkGroups = projectGroup::where('FN_Supervisor',">",'0')->where('proposals_id',">",'0')->count();
            
            $Procedures_Committee =
                [
                    '1'=>'اعتماد الرغبات بحسب الاولوية المحدده للمشروع',
                    '2'=>'اعتماد الرغبات بحسب تاريخ اختيار المشروع',
                    '3'=>'توزيع المشرفين'  
                ];
            return view('GPCO.groups.index',compact('WorkGroups','Procedures_Committee','All_Groups','Approved_Groups','Approved_Supervisors','Branches_Boys','Branches_Grils','Null_Approved','Null_Supervisor'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Page_Manage_Groups"); 
        } 
       
    }
    public function ProcedureType(Request $request){
        $this->validate($request,
            ['Procedures_Committee'=>'required'],['Procedures_Committee.required'=>'يرجي تحديد أحد الاجراءات لكي يتم البدء بالاجراء']);
        try{
            if($request->Procedures_Committee == 1){
                return redirect('approval-as-primacy');
            }
            if($request->Procedures_Committee == 2){
                return redirect('approval-as-project');
            }
            if($request->Procedures_Committee == 3){
                return redirect('supervisor-distribution');
            }
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله ProcedureType"); 
        } 

    }
    public function ShowGroups ($id){
        try{
            $group = projectGroup::findOrfail($id);
            $GroupId = $group->id;
            $GroupBranches = $group->branches_id;
            $Team = ProjectStudent::where([['project_groups_id',$GroupId],['branches_id',$GroupBranches]])->get(); // Get Team item
            return view('GPCO.groups.show',compact('group','Team'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله ShowGroup"); 
        } 
       
    }
    public function PDFProposal($id){
        $proposal = Proposal::findOrfail($id); 
        //$pdf = PDF::loadView('Reports.GPCO.proposal',compact('proposal'));
        //return $pdf->stream('document.pdf');
        return view('Reports.GPCO.proposal',compact('proposal'));
    }
    public function GPCOX(){
        session()->push('x','عذراً ، الصفحة قيد الإنشاء !!');
        session()->push('x','هذه الرسالة سوف تختفي بعد 5 ثواني.');   
        return view('layouts.Home.GPCO');
    }
    public function IndexPage_Approval_As_Project(){
        try{
            $GW = Proposal::Where('Selected','>','0')->get();
            return view('GPCO.groups.AllProjectSelect',compact('GW'));
        } 
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله IndexPage_Approval_As_Project"); 
        } 
    }
    public function All_Groups_Choice_Project($id){
        try{
         
            $Proposal = Proposal::Where('id',$id)->first();
            $Groups = projectGroup::Where('proposals_id',$Proposal->id)->get();  
            $GroupB = projectGroup::Where('proposals_id',$Proposal->id)->Where('branches_id',1)->count();  
            $GroupG = projectGroup::Where('proposals_id',$Proposal->id)->Where('branches_id',2)->count();  
           // dd( $GroupG);
            $Wishes = GroupWishe::Where('proposals_id',$id)->Where('Certified','0')->orderBy('id')->get();  
            return view('GPCO.groups.AllGroupsChoiceProject',compact('Proposal','Groups','Wishes','GroupB','GroupG'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله All_Groups_Choice_Project"); 
        } 
    }
    public function IndexPage_Approval_As_Primacy(){
        try{
            $Groups = projectGroup::where('proposals_id',null)->where('FN_Supervisor',null)->orderBy('created_at')->paginate(10);
            return view('GPCO.groups.AllGroupsCreate',compact('Groups'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله IndexPage_Approval_As_Primacy"); 
        } 
    }
    public function Details_Groups_Primacy($id){
        try{
            $Groups = projectGroup::where('id',$id)->first();
            $Wishes = GroupWishe::Where('groups_id',$id)->orderBy('created_at','desc')->orderBy('id','desc')->get();

            if($Groups->branches_id == 1){
                $Team = ProjectStudent::where('branches_id',1)->where('project_groups_id',$Groups->id)->get();
            }
            if($Groups->branches_id == 2){
                $Team = ProjectStudent::where('branches_id',2)->where('project_groups_id',$Groups->id)->get();
            }
            return view('GPCO.groups.AllPrimacyGroups',compact('Groups','Wishes','Team'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Details_Groups_Primacy"); 
        } 

    }
    public function Approval_Project_for_Group(Request $request ,$Id_Group,$Id_Proposal){
        //dd($Id_Group,$Id_Proposal);
        try{
          
            $Groups = projectGroup::Where('id',$Id_Group)->first();
            $GroupsBranch =  $Groups->branches_id;
            if($Groups->proposals_id > 0){
                session()->push('m','info');
                session()->push('m',"هذا المجموعة لديها مشروع معتمد ، لايمكنك اعتماد مشروع فوق الاخر!");  
                return redirect()->back();
            }
            else{
                if($GroupsBranch == 1){
                    $NOAPFGB = projectGroup::Where('branches_id','1')->where('proposals_id',$Id_Proposal)->count(); //Number Of Approval Project For Groups Boays
                    if($NOAPFGB >= Max_Certified_Project_GroupB()){
                        session()->push('m','info');
                        session()->push('m',"لقد تم اعتماد هذا المشروع لعدد كافي من مجموعات الطلاب");  
                        return redirect()->back();
    
                    }
                    else{
                        $Proposal ['proposals_id'] =$Id_Proposal;
                        $Proposal ['NotesCommittee'] =$request->NotesCommittee;
                        $Groups->update($Proposal);
                        GroupWishe::Where('groups_id',$Id_Group)->Where('proposals_id',$Id_Proposal)->update(['Certified'=>'1']);
                        session()->push('m','success');
                        session()->push('m',"تم اعتماد المشروع للمجموعة");  
                        return redirect()->back();
                    }
                }
                if($GroupsBranch == 2){
                    $NOAPFGG = projectGroup::Where('branches_id','2')->where('proposals_id',$Id_Proposal)->count(); //Number Of Approval Project For Groups Grilys
                    if($NOAPFGG >= Max_Certified_Project_GroupG()){
                        session()->push('m','info');
                        session()->push('m',"لقد تم اعتماد هذا المشروع لعدد كافي من مجموعات الطالبات");  
                        return redirect()->back();
                    }
                    else{
                        $Proposal ['proposals_id'] =$Id_Proposal;
                        $Proposal ['NotesCommittee'] =$request->NotesCommittee;
                        $Groups->update($Proposal);
                        GroupWishe::Where('groups_id',$Id_Group)->Where('proposals_id',$Id_Proposal)->update(['Certified'=>'1']);
                        session()->push('m','success');
                        session()->push('m',"تم اعتماد المشروع للمجموعة");  
                        return redirect()->back();
                    }
                }

            }
           
            
           
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Approved_Proposal_Groups"); 
        } 
    }
    public function Page_Distribution_Supervisor(){
        try{
            $Groups = projectGroup::Where('proposals_id','>','0')->Where('FN_Supervisor',null)->paginate(10);
            return view('GPCO.groups.IndexSupervisorDistribution',compact('Groups')); 
          }
          catch (\Exception $e) {
              return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Page_Distribution_Supervisor"); 
          } 

    }
    public function DistributionSupervisor($id){
        try{
            $Groups = projectGroup::findOrfail($id);
            $Proposal = Proposal::findOrfail($Groups->proposals_id);
            $Supervisor_Expected = SupervisorExpected::where('proposals_id',$Proposal->id)->get();
            if($Groups->branches_id == 1){
                $Team = ProjectStudent::where('branches_id',1)->where('project_groups_id',$Groups->id)->get();
            }
            if($Groups->branches_id == 2){
                $Team = ProjectStudent::where('branches_id',2)->where('project_groups_id',$Groups->id)->get();
            }
            return view('GPCO.groups.SupervisorDistribution',compact('Groups','Proposal','Supervisor_Expected','Team')); 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله DistributionSupervisor"); 
        } 

    }
    public function Select_Supervisor_ForGroups($Id_Groups,$Id_Supervisor){
        try{
            $Groups = projectGroup::findOrfail($Id_Groups);
            $GroupsBranch =  $Groups->branches_id;
            if($GroupsBranch == 1){
                $NOSSFGB = projectGroup::Where('branches_id','1')->where('FN_Supervisor',$Id_Supervisor)->count(); //Number of select supervisor for groups boays
            
                if($NOSSFGB >= Max_Supervisor_GroupsB()){
                    session()->push('m','info');
                    session()->push('m',"هذ المشرف قد تم أعطائه العدد الكافي من مجموعات الطلاب");  
                    return redirect()->back();
                }
                else{
                    if($Groups->FN_Supervisor == null){
                        $SelectSupervisor['FN_Supervisor'] =$Id_Supervisor;
                        $Groups->update($SelectSupervisor);
                        session()->push('m','success');
                        session()->push('m',"تم اعتماد المشرف بنجاح للمجموعة");  
                        return redirect('supervisor-distribution');
                    }else{
                        session()->push('m','error');
                        session()->push('m',"هذا المجموعة لديها مشرف ، لايمكنك اعتماد مشرف جديد");  
                        return redirect()->back();
                    }

                }

            }
            if($GroupsBranch == 2){
                $NOSSFGG = projectGroup::Where('branches_id','2')->where('FN_Supervisor',$Id_Supervisor)->count(); //Number of select supervisor for groups grils
                if($NOSSFGG >= Max_Supervisor_GroupsB()){
                    session()->push('m','info');
                    session()->push('m',"هذ المشرف قد تم أعطائه العدد الكافي من مجموعات الطالبات");  
                    return redirect()->back();
                }
                else{
                    if($Groups->FN_Supervisor == null){
                        $SelectSupervisor['FN_Supervisor'] =$Id_Supervisor;
                        $Groups->update($SelectSupervisor);
                        session()->push('m','success');
                        session()->push('m',"تم اعتماد المشرف بنجاح للمجموعة");  
                        return redirect('supervisor-distribution');
                    }else{
                        session()->push('m','error');
                        session()->push('m',"هذا المجموعة لديها مشرف ، لايمكنك اعتماد مشرف جديد");  
                        return redirect()->back();
                    }

                }

            }
            
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Select_Supervisor_ForGroups"); 
        } 

    }
    public function Select_AntherSupervisor_ForGroups(Request $request ,$Id_Groups){

        try{
            $Id_Supervisor = $request->Supervisor;
            $Groups = projectGroup::findOrfail($Id_Groups);
            $GroupsBranch =  $Groups->branches_id;
            if($GroupsBranch == 1){
                $NOSSFGB = projectGroup::Where('branches_id','1')->where('FN_Supervisor',$Id_Supervisor)->count(); //Number of select supervisor for groups boays
            
                if($NOSSFGB >= Max_Supervisor_GroupsB()){
                    session()->push('m','info');
                    session()->push('m',"هذ المشرف قد تم أعطائه العدد الكافي من مجموعات الطلاب");  
                    return redirect()->back();
                }
                else{
                    if($Groups->FN_Supervisor == null){
                        $SelectSupervisor['FN_Supervisor'] =$Id_Supervisor;
                        $Groups->update($SelectSupervisor);
                        session()->push('m','success');
                        session()->push('m',"تم اعتماد المشرف بنجاح للمجموعة");  
                        return redirect('supervisor-distribution');
                    }else{
                        session()->push('m','error');
                        session()->push('m',"هذا المجموعة لديها مشرف ، لايمكنك اعتماد مشرف جديد");  
                        return redirect()->back();
                    }

                }

            }
            if($GroupsBranch == 2){
                $NOSSFGG = projectGroup::Where('branches_id','2')->where('FN_Supervisor',$Id_Supervisor)->count(); //Number of select supervisor for groups grils
                if($NOSSFGG >= Max_Supervisor_GroupsB()){
                    session()->push('m','info');
                    session()->push('m',"هذ المشرف قد تم أعطائه العدد الكافي من مجموعات الطالبات");  
                    return redirect()->back();
                }
                else{
                    if($Groups->FN_Supervisor == null){
                        $SelectSupervisor['FN_Supervisor'] =$Id_Supervisor;
                        $Groups->update($SelectSupervisor);
                        session()->push('m','success');
                        session()->push('m',"تم اعتماد المشرف بنجاح للمجموعة");  
                        return redirect('supervisor-distribution');
                    }else{
                        session()->push('m','error');
                        session()->push('m',"هذا المجموعة لديها مشرف ، لايمكنك اعتماد مشرف جديد");  
                        return redirect()->back();
                    }

                }

            }
            
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Select_AntherSupervisor_ForGroups"); 
        } 

    }
    public function Page_Follow_Groups(){
        try{
            return view('GPCO.groups.Follow Groups.Index');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Page_Follow_Groups"); 
        } 
       
    }
    public function Follow_Up_Boys($id){
        try{
            $NameGroups = "الطلاب";
            $TypeGroups = "1";
            $Groups = projectGroup::where('branches_id','1')->where('proposals_id','>','0')->where('FN_Supervisor','>','0')->get();
            if($id == 1){
                return view('GPCO.groups.Follow Groups.Meetings',compact('NameGroups','Groups','TypeGroups'));
            }
            if($id == 2){
                return view('GPCO.groups.Follow Groups.Attendance',compact('NameGroups','Groups','TypeGroups'));
            }
            if($id == 3){
                return view('GPCO.groups.Follow Groups.Deliveries',compact('NameGroups','Groups','TypeGroups'));
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Follow_Up_Boys"); 
        }  
    }
    public function Follow_Up_Grils($id){
        try{
            $NameGroups = "الطالبات";
            $TypeGroups = "2";
            $Groups = projectGroup::where('branches_id','2')->where('proposals_id','>','0')->where('FN_Supervisor','>','0')->get();
            if($id == 1){
                return view('GPCO.groups.Follow Groups.Meetings',compact('NameGroups','Groups','TypeGroups'));
            }
            if($id == 2){
                return view('GPCO.groups.Follow Groups.Attendance',compact('NameGroups','Groups','TypeGroups'));
            }
            if($id == 3){
                return view('GPCO.groups.Follow Groups.Deliveries',compact('NameGroups','Groups','TypeGroups'));
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Follow_Up_Grils"); 
        } 
       
    }
    public function Follow_Up_Group_Meetings($Type_Group,$Id_Group){
        try{
            if($Type_Group == 1){
                $NameGroups = "الطلاب";
            }
            if($Type_Group == 2){
                $NameGroups = "الطالبات";
            }
            $Groups = projectGroup::findOrfail($Id_Group);
            $Meetings = Meeting::where('project_group',$Id_Group)->get();
            return view('GPCO.groups.Follow Groups.Detail Meetings',compact('NameGroups','Groups','Meetings'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Follow_Up_Group_Meetings"); 
        } 
       
    }
    public function Follow_Up_Group_Attendance($Type_Group,$Id_Group){
        try{
            if($Type_Group == 1){
                $NameGroups = "الطلاب";
            }
            if($Type_Group == 2){
                $NameGroups = "الطالبات";
            }
            $Groups = projectGroup::findOrfail($Id_Group);
            $Meetings = Meeting::where('project_group',$Id_Group)->get();
            $Team = ProjectStudent::where([['project_groups_id',$Id_Group],['branches_id',$Type_Group]])->get(); // Get Team item
            $Attendance = Meeting_projectStudent::get();
            return view('GPCO.groups.Follow Groups.Detail Attendance',compact('NameGroups','Groups','Meetings','Team','Attendance'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} ,  هذا الخطأ متواجد في المتحكم الخاص بالجنة المشاريع .GpcoController في الداله Follow_Up_Group_Meetings"); 
        } 
       
    } 
    Public function StudentGrades(){// Page Coditions of GPC
        try{
        $Groups = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor','>','0')->get();
        return view('GPCO.Grades.Index',compact('Groups'));
        }
        catch (\Exception $e) {
        return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله StudentGrades.  "); 
        }
    }
    Public function AddGradesStudent(Request $request ,$AcdameicNumber){// Page Coditions of GPC
        try{
            $Stuent_Record =ProjectStudent::findOrfail($AcdameicNumber);
            $DB_Degree_Midterm_discussion =  $Stuent_Record->Degree_Midterm_discussion;
            $DB_Degree_Final_discussion =  $Stuent_Record->Degree_Final_discussion;
            if($request->Degree_Midterm_discussion != null){
                $DB_Degree_Midterm_discussion = $request->Degree_Midterm_discussion ;
            }
            if($request->Degree_Final_discussion != null){
                $DB_Degree_Final_discussion = $request->Degree_Final_discussion ;
            }
            $New_dagree = [
                'Degree_Midterm_discussion'=>$DB_Degree_Midterm_discussion,
                'Degree_Final_discussion'=>$DB_Degree_Final_discussion,
            ];
            ProjectStudent::findOrfail($AcdameicNumber)->update($New_dagree);
            return redirect('GPCO/grades');
        }
        catch (\Exception $e) {
        return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله StudentGrades.  "); 
        }
    }  
    Public function EditGrades($AcdameicNumber){// Page Coditions of GPC
        try{
            /*
                $Student = ProjectStudent::findOrfail($AcdameicNumber);
                $Student_Group = $Student->project_groups_id;
                $Groups = projectGroup::findOrfail($Student_Group);
                $Meetings = Meeting::where('project_group',$Student_Group)->count();
                $DegreeOfAttendance = Grades()->DegreeOfAttendance;
                $Student_Attendance = Meeting_projectStudent::where('AcdameicNumber',$AcdameicNumber)->count();
                $Student_Degree_Attendanc= 0;
                if($Meetings != 0){
                    $Student_Degree_Attendanc = ($DegreeOfAttendance/$Meetings)*$Student_Attendance;
                
                }  
                if($Meetings == 0){
                    $Student_Degree_Attendanc == 0;
                }
                $DegreeOfDelivery = Grades()->DegreeOfDelivery;
                $NumberOfDelivery = TypeDeliv::where('AcademicYear',$Groups->AcademicYear)->where('Semester',$Groups->Semester)->count();
                $Group_Stuent_Delivery = Deliv::where('group_id',$Student_Group)->where('statu','3')->count();
                $Student_Degree_Delivery= 0;
                if($Group_Stuent_Delivery != 0){
                    $Student_Degree_Delivery  = ($DegreeOfDelivery/$NumberOfDelivery)*$Group_Stuent_Delivery;
                
                }
                if($Group_Stuent_Delivery == 0){
                    $Student_Degree_Delivery  == 0;
                }
            
                $input=[
                    'Degree_attendance'=>$Student_Degree_Attendanc,
                    'Degree_delivery'=>$Student_Degree_Delivery,
                ];
                ProjectStudent::findOrfail($AcdameicNumber)->update($input);
            */
            $Student_Degree = ProjectStudent::findOrfail($AcdameicNumber);
            return view('GPCO.Grades.Edit',compact('Student_Degree'));
        }
        catch (\Exception $e) {
        return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله EditGrades.  "); 
        }
    }
    Public function UpdateGradesStuents(Request $request ,$AcdameicNumber){// Update Sattings of Grades
        try{ 
            $input = $request->all();
            ProjectStudent::findOrfail($AcdameicNumber)->update($input);
            session()->push('m','success');
            session()->push('m','تم حفظ التعديلات بنجاح');   
            return redirect('GPCO/grades');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله UpdateGradesStuents.  "); 
        }
    }
}
