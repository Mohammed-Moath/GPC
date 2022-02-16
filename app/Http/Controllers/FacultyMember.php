<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Program;
use App\ProjectSupervisor;
use App\Proposal;
use App\Proposal_Program;
use App\StatuProposal;
use App\projectGroup;
use App\ProjectStudent;
use App\Meeting;
use App\Meeting_projectStudent;
use App\ProjectDegree;
use App\ProjectCalendar;
use App\Deliv;

class FacultyMember extends Controller
{  
    Public function X(){// الصفحة الغير مكتملة
        session()->push('x','GPC | عذراً ، الصفحة قيد الإنشاء !!');
        session()->push('x','هذه الرسالة سوف تختفي بعد 5 ثواني.');   
        return redirect('home/FacultyMember');
    }

    public function home (){
        try{
            return view('layouts.Home.FacultyMember');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله home.  "); 
        }
    }
    Public function IndexProposal(){
        try{
            $UserId = \Auth::user()->id;
            $TPNYes = Proposal::where([['users_id',$UserId],['PropertyRight','3']])->get();
            $TPNNo = Proposal::where([['users_id',$UserId],['PropertyRight','4']])->get();
            return view('FacultyMember.proposal.index',compact('TPNYes','TPNNo'));
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله IndexProposal.  "); 
        }
    }
    public function PageProposal (){
        try{
            if(EndTimeSubmitProposal() > Time_Now()){
                $UserId = \Auth::user()->id;
                $Proposal = Proposal::where('users_id',$UserId)->count();
                if($Proposal >= Max_NumberAddProposal_FacultyMember()){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة العدد المطلوب من المقترحات');   
                    return redirect()->back();
                }else{
                    $Program = Program::all();
                    return view('FacultyMember.proposal.create',compact('Program'));
                }
               
            }
            else{
                session()->push('m','error');
                session()->push('m','عذراً ، لايمكنك تقديم مقترح !! انتهي الوقت المخصص لذلك .');   
                return redirect()->back();
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله PageProposal.  "); 
        }

    }
    public function CreateProposal (Request $request){
               
        $this->validate($request,
            [
                'ProjectProposalTitle'=>'required|max:150|min:10',
                'descrdiption'=>'required|min:100',
                'scope'=>'required|min:50',
                'Outputs'=>'required|min:50',
                'ImportanceProposal'=>'required|min:50',
                'Program'=>'required',
                'Tools'=>'required|min:50',
                'NumberOfStudents'=>'required|numeric|digits_between:1,2|max:5|min:1',
                'PropertyRight'=>'required',
            ],
            [   'required'=>'مطلوب اضافة بيانات هنا !',
                'ProjectProposalTitle.max'=>'اقصي حروف يمكنك كتابته  150 حرف!',
                'ProjectProposalTitle.min'=>'اقل احرف يمكنك كتابته 10 حروف !',
                'descrdiption.min'=>'يرجي كتابة وصف لمقترح المشروع لا يقل عن 100 حرف !',
                'scope.min'=>'يرجي كتابة وصف لحدود المشروع لا يقل عن 50 حرف !',
                'Outputs.min'=>'يرجي كتابة وصف لمخرجات المشروع لا يقل عن 50 حرف !',
                'ImportanceProposal.min'=>'يرجي كتابة وصف لأهمية المشروع لا يقل عن 50 حرف !',
                'Tools.min'=>'يرجي كتابة وصف للادوات المتوقع استخدامها في المشروع لا يقل عن 50 حرف !',
                'NumberOfStudents.max'=>'أقصي عدد طلاب يمكنك اختياره هو 5 ',
                'NumberOfStudents.min'=>'أقل عدد طلاب يمكنك اختياره هو 1 ',
                'NumberOfStudents.digits_between'=>'يرجي كتابة رقم اقل من 10.',
            ]
        );   
        try{
            $username = \Auth::user()->Name;
            $input = $request->all();
            $input['users_id'] =\Auth::user()->id;
            $input['AcademicYear'] =AcademicYear_GPC();
            $input['Semester'] =Semester_GPC();
        
            $NewProposal = Proposal::create($input);

            foreach($input['Program'] as $Program){
                Proposal_Program::create(['proposal_id'=>$NewProposal->id,'program_id'=>$Program]);
            }
            session()->push('m','success');
            session()->push('m',"تم تقديم مقترحك بنجاح {$username} ، وسوف يتم مراجعته من قبل المختص في اللجنة.");   
            return redirect('FacultyMember/my-proposal');
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله CreateProposal.  "); 
        }

    }
    public function ShowProposal($id){
        try{
            $Proposal = Proposal::findOrfail($id);
            $Program = Proposal_Program::where('proposal_id',$id)->get();
            $p = array();
            foreach($Program as $pro){
                $p [] = $pro->program_id;
            }
            $Programs = Program::all();
            return view('FacultyMember.proposal.show',compact('Proposal','p','Programs'));
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله ShowProposal.  "); 
        }

    }
    public function DeleteProposal($id){
        try{
            $Proposal = Proposal::findOrfail($id);
            if( $Proposal->References ==1 && $Proposal->Certified==1){
                session()->push('m','error');
                session()->push('m','لايمكنك حذف المقترح لان تمت مراجعته واعتماده');   
                return redirect()->bake();

            }else{
                $Proposal->delete();
                session()->push('m','success');
                session()->push('m',"تم حذف المقترح بنجاح");  
                return redirect("FacultyMember/my-proposal");
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله DeleteProposal.  "); 
        }

    }
    public function PageEditProposal($id){
        try{
            $Proposal = Proposal::findOrfail($id);
            $Program = Program::all();
            $Proposal_Program = Proposal_Program::where('proposal_id',$id)->get();
            $ProgramID = array();
            foreach( $Proposal_Program  as $p){
                $ProgramID[]= $p->program_id;
            }
            if( $Proposal->References ==1 && $Proposal->Certified==1){
                session()->push('m','error');
                session()->push('m','لايمكنك التعديل على هذا المقترح لانه قد تمت مراجعته واعتماده');   
                return redirect()->bake();

            }else{
                return view('FacultyMember.proposal..edit',compact('Proposal','Program','ProgramID'));
            }
        }

        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله PageEditProposal.  "); 
        }


    }
    public function UpdateProposal(Request $request,$id){
   
        $this->validate($request,
            [
                'ProjectProposalTitle'=>'required|max:150|min:10',
                'descrdiption'=>'required|min:100',
                'scope'=>'required|min:50',
                'Outputs'=>'required|min:50',
                'ImportanceProposal'=>'required|min:50',
                'Program'=>'required',
                'Tools'=>'required|min:50',
                'NumberOfStudents'=>'required|numeric|digits_between:1,2|max:5|min:1',
                'PropertyRight'=>'required',
            ],
            [   'required'=>'مطلوب اضافة بيانات هنا !',
                'ProjectProposalTitle.max'=>'اقصي حروف يمكنك كتابته  150 حرف!',
                'ProjectProposalTitle.min'=>'اقل احرف يمكنك كتابته 10 حروف !',
                'descrdiption.min'=>'يرجي كتابة وصف لمقترح المشروع لا يقل عن 100 حرف !',
                'scope.min'=>'يرجي كتابة وصف لحدود المشروع لا يقل عن 50 حرف !',
                'Outputs.min'=>'يرجي كتابة وصف لمخرجات المشروع لا يقل عن 50 حرف !',
                'ImportanceProposal.min'=>'يرجي كتابة وصف لأهمية المشروع لا يقل عن 50 حرف !',
                'Tools.min'=>'يرجي كتابة وصف للادوات المتوقع استخدامها في المشروع لا يقل عن 50 حرف !',
                'NumberOfStudents.max'=>'أقصي عدد طلاب يمكنك اختياره هو 5 ',
                'NumberOfStudents.min'=>'أقل عدد طلاب يمكنك اختياره هو 1 ',
                'NumberOfStudents.digits_between'=>'يرجي كتابة رقم اقل من 10.',
            ]
        );  
        try{
            $Proposal = Proposal::findOrfail($id);
            if( $Proposal->References ==1 && $Proposal->Certified==1){
                session()->push('m','error');
                session()->push('m','لايمكنك التعديل على هذا المقترح لانه قد تمت مراجعته واعتماده');   
                return redirect()->bake();

            }else{
                $input = $request->all();
                $Proposal->update($input);
                session()->push('m','success');
                session()->push('m',"تم تعديل المقترح بنجاح");  
         
                return redirect("FacultyMember/my-proposal");
            }
        }

        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله UpdateProposal.  "); 
        }


    }
    Public function Page_Proposal(){// page choose Proposal
        try{
            $condtion = ProjectCalendar::findOrfail(1);
            $Proposal = Proposal::where('References',1)->where('Certified',1)->where('PropertyRight','>',1)->orderBy('created_at','desc')->paginate(10);
            return view('FacultyMember.proposal.AllProposals',compact('condtion','Proposal'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله Page_Proposal.  "); 
        }
    }


    Public function IndexGroup(){
        try{
            $UserId = \Auth::user()->id;
            $FNGet =  ProjectSupervisor::where('users_id',$UserId)->first();
            $FN = $FNGet->FunctionalNumber;
            $GroupB = projectGroup::where('branches_id','1')->where('FN_Supervisor',$FN)->get();
            $GroupG = projectGroup::where('branches_id','2')->where('FN_Supervisor',$FN)->get();
            return view('FacultyMember.group.index',compact('GroupB','GroupG'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله IndexGroup.  "); 
        }
    }
    Public function ShowGroup($id){
        try{
            $group = projectGroup::findOrfail($id);
            $GB = $group->branches_id;
            if($GB == '1'){
                $Team = ProjectStudent::where([['branches_id','1'],['project_groups_id',$id]])->get(); // Get Team item
                $coler = 'info';
                $TypeStudent = 'طلاب';
                return view('FacultyMember.group.show',compact('group','coler','Team','TypeStudent'));
            }
            elseif($GB == '2'){
                $Team = ProjectStudent::where([['branches_id','2'],['project_groups_id',$id]])->get(); // Get Team item
                $coler = 'danger';
                $TypeStudent = 'طالبات';
                return view('FacultyMember.group.show',compact('group','coler','Team','TypeStudent'));
            }
            else{
                session()->push('m','error');
                session()->push('m','حدث خطأ ، في عدم تواجد المجموعة التي اخترتها يرجي ابلاغ مهندس صيانة النظام');   
                return redirect()->back();
    
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله ShowGroup.  "); 
        }
       
    }

    public function Meetings(){
        try{
            $UserId = \Auth::user()->id;
            $FNGet =  ProjectSupervisor::where('users_id',$UserId)->first();
            $FN = $FNGet->FunctionalNumber;
            $GroupB = projectGroup::where('branches_id','1')->where('FN_Supervisor',$FN)->get();
            $GroupG = projectGroup::where('branches_id','2')->where('FN_Supervisor',$FN)->get();
            return view('FacultyMember.meetings.index',compact('GroupB','GroupG'));
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله Meetings.  "); 
        }
    }
    Public function MeetingDetails($id){// page Meeting details
        try{
            $Meeting = Meeting::findOrfail($id);
            return view('FacultyMember.meetings.Details',compact('Meeting'));
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله MeetingDetails.  "); 
        }
    }
    Public function MeetingShow($id){// page Meeting details
        try{
           
            $Meetings = Meeting::where('project_group',$id)->get();
            return view('FacultyMember.meetings.show',compact('Meetings'));
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله MeetingDetails.  "); 
        }
    }
    
    public function PageCreateMeetings($id){
        try{
            $group = projectGroup::findOrfail($id);
            $NumberOfMeetings = Meeting::where('project_group',$id)->count();
            $NumberOfMeetingsNow =   $NumberOfMeetings+1;
            switch($NumberOfMeetingsNow){
                case 1:$NameOfMeetings = "الاول";break;
                case 2:$NameOfMeetings = "الثاني";break;
                case 3:$NameOfMeetings = "الثالث";break;
                case 4:$NameOfMeetings = "الرابع";break;
                case 5:$NameOfMeetings = "الخامس";break;
                case 6:$NameOfMeetings = "السادس";break;
                case 7:$NameOfMeetings = "السابع";break;
                case 8:$NameOfMeetings = "الثامن";break;
                case 9:$NameOfMeetings = "التاسع";break;
                case 10:$NameOfMeetings = "العاشر";break;
                case 11:$NameOfMeetings = "الحادي عشر";break;
                case 12:$NameOfMeetings = "الثاني عشر";break;
                case 13:$NameOfMeetings = "الثالث عشر";break;
                case 14:$NameOfMeetings = "الرابع عشر";break;
                case 15:$NameOfMeetings = "الخامس عشر";break;
                case 16:$NameOfMeetings = "السادس عشر";break;
                case 17:$NameOfMeetings = "السابع عشر";break;
                case 18:$NameOfMeetings = "الثامن عشر";break;
                case 19:$NameOfMeetings = "التاسع عشر";break;
                case 20:$NameOfMeetings = "العشرون";break;
                default :$NameOfMeetings = "رقم : $NumberOfMeetingsNow";
            }
            $GB = $group->branches_id;
            $GLader = $group->GroupLader;
            if($GB == '1'){
                $Team = ProjectStudent::where([['branches_id','1'],['project_groups_id',$id]])->get(); // Get Team item
                $coler = 'info';
                $TypeStudent = 'طلاب';
                return view('FacultyMember.meetings.create',compact('group','coler','Team','TypeStudent','NumberOfMeetingsNow','NameOfMeetings'));
            }
            elseif($GB == '2'){
                $Team = ProjectStudent::where([['branches_id','2'],['project_groups_id',$id]])->get(); // Get Team item
                $coler = 'danger';
                $TypeStudent = 'طالبات';
                return view('FacultyMember.meetings.create',compact('group','coler','Team','TypeStudent','NumberOfMeetingsNow','NameOfMeetings'));
            }
            else{
                session()->push('m','error');
                session()->push('m','حدث خطأ ، في عدم تواجد المجموعة التي اخترتها يرجي ابلاغ مهندس صيانة النظام');   
                return redirect()->back();
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله PageCreateMeetings.  "); 
        }
    }
    public function CreateMeetings(Request $request ,$id,$NumberOfMeetingsNow){
        $this->validate($request,
            [
                'TitleMeeting'=>'required',
                'TaskName'=>'required',
                'StudentAN'=>'required',
            ],
            [   'required'=>'مطلوب اضافة بيانات هنا !',
            ]
        ); 

        try{
            $input = $request->all();
            
            $UserId = \Auth::user()->id;
            $FNGet =  ProjectSupervisor::where('users_id',$UserId)->first();
            $FN = $FNGet->FunctionalNumber;
            
            $Meeting = new Meeting;
            $Meeting->project_group = $id;
            $Meeting->TitleMeeting = $request->TitleMeeting;
            $Meeting->TaskName = $request->TaskName;
            $Meeting->NumberOfMeeting =$NumberOfMeetingsNow;
            $Meeting->created_by = $FN;
            $Meeting->save();
    
            foreach($input['StudentAN'] as $Student){
                Meeting_projectStudent::create(['meeting_id'=>$Meeting->id,'AcdameicNumber'=>$Student]) ;
            }
            
            // Calculate grades of attendance for students  
            foreach($input['StudentAN'] as $Student){               
                $Meetings = Meeting::where('project_group',$id)->count(); // Number of meetings for the group
                $DegreeOfAttendance = Grades()->DegreeOfAttendance; // The degree of attendance of the Rapporteur of the Committee
                $Student_Attendance = Meeting_projectStudent::where('AcdameicNumber',$Student)->count(); // Number of student attendance
                $Student_Degree_Attendanc = ($DegreeOfAttendance/$Meetings)*$Student_Attendance; // The calculation of the attendance class
                $Store_degree=[ // Store degree in variable
                    'Degree_attendance'=>$Student_Degree_Attendanc,
                ];
                ProjectStudent::findOrfail($Student)->update($Store_degree); // Add the grade to the student record    
            }

            session()->push('m','success');
            session()->push('m',"تم أنشاء محتويات اللقاء بنجاح");   
            return redirect('FacultyMember/meetings'); 
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله CreateMeetings.  "); 
        }   

    }
    public function ShowFollowUpGroup($id){

        try{
            $group = projectGroup::findOrfail($id);
            $meeting = Meeting::where('project_group',$id)->get();
            $MeetingNumber = count( $meeting);
            $GB = $group->branches_id;;
            if($GB == '1'){
                $coler = 'info';
                $TypeStudent = 'طلاب';
                return view('FacultyMember.follow.show',compact('group','meeting','MeetingNumber','coler','Team','TypeStudent'));
            }
            elseif($GB == '2'){
                $coler = 'danger';
                $TypeStudent = 'طالبات';
                return view('FacultyMember.follow.show',compact('group','meeting','MeetingNumber','coler','Team','TypeStudent'));
            }
            else{
                session()->push('m','error');
                session()->push('m','حدث خطأ ، في عدم تواجد المجموعة التي اخترتها يرجي ابلاغ مهندس صيانة النظام');   
                return redirect()->back();
    
            }
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله ShowFollowUpGroup.  "); 
        }  
    }
    public function StudentGrades(){
        try{
            $UserId = \Auth::user()->id;
            $Group =  ProjectSupervisor::where('users_id',$UserId)->first();
            return view('FacultyMember.StudentGrades.index',compact('Group'));
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله StudentGrades.  "); 
        }  

    }
    public function ShowStudentGrades($id){
       
        try{
            $group = projectGroup::findOrfail($id);
            $Team =  ProjectStudent::where('project_groups_id',$id)->pluck('AcdameicNumber');
            $GB = $group->branches_id;
            if($GB == '1'){
                $TeamDegre =ProjectDegree::where('Student_AN',$Team)->get();
                $coler = 'info';
                $TypeStudent = 'طلاب';
                return view('FacultyMember.StudentGrades.show',compact('Team','TeamDegre','group','coler','TypeStudent'));
            }
            elseif($GB == '2'){
                
                $TeamDegre =ProjectDegree::where('Student_AN',$Team)->get();
                $coler = 'danger';
                $TypeStudent = 'طالبات';
                return view('FacultyMember.StudentGrades.show',compact('Team','TeamDegre','group','coler','TypeStudent'));
            }
            else{
                session()->push('m','error');
                session()->push('m','حدث خطأ ، في عدم تواجد المجموعة التي اخترتها يرجي ابلاغ مهندس صيانة النظام');   
                return redirect()->back();
            }
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله ShowStudentGrades.  "); 
        }  
        

        

    } 

    Public function Deliveries(){// page Deliveries 
        try{
            $UserId = \Auth::user()->id;
            $FNGet =  ProjectSupervisor::where('users_id',$UserId)->first();
            $FN = $FNGet->FunctionalNumber;
            $GroupB = projectGroup::where('branches_id','1')->where('FN_Supervisor',$FN)->get();
            $GroupG = projectGroup::where('branches_id','2')->where('FN_Supervisor',$FN)->get();
            return view('FacultyMember.Deliveries.Index',compact('GroupB','GroupG'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله Deliveries.  "); 
        }
    }
    Public function DeliveriesGroup($id_group){// page Deliveries 
        try{
            $Group = projectGroup::where('id',$id_group)->first();
            return view('FacultyMember.Deliveries.Show',compact('Group'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله DeliveriesGroup.  "); 
        }
    }
    
    Public function DeliverChangeStatu(Request $request ,$id_deliver,$num_statu){// page Deliveries 
        try{
            $Group = Deliv::findOrfail($id_deliver);
            $input=[
                'Note'=>$request->Note,
                'statu'=>$num_statu
            ];
            Deliv::findOrfail($id_deliver)->update($input);
            session()->push('m','success');
            session()->push('m','تم العملية بنجاح');   
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بأعضاء هيئة التدريس FacultyMember ، في الداله DeliverChangeStatu.  "); 
        }
    }
    
    Public function AddStudentGrades(Request $request ,$AcdameicNumber){// Page Coditions of GPC
        try{
            $Stuent_Record =ProjectStudent::findOrfail($AcdameicNumber);
            $DB_Degree_Supervisor =  $Stuent_Record->Degree_Supervisor;
            if($request->Degree_Supervisor != null){
                $DB_Degree_Supervisor = $request->Degree_Supervisor;
            }
            $New_dagree = [
                'Degree_Supervisor'=>$DB_Degree_Supervisor,
            ];
            ProjectStudent::findOrfail($AcdameicNumber)->update($New_dagree);
            return redirect('FacultyMember/grades');
        }
        catch (\Exception $e) {
        return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'GpcoController' ، في الداله AddStudentGrades.  "); 
        }
    } 
    
}
