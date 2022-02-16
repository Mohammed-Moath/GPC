<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Program;
use App\Branch;
use App\ProjectStudent;
use App\ProjectCalendar;
use App\AcademicNumber;
use App\Proposal;
use App\Proposal_Program;
use App\projectGroup;
use Carbon\Carbon;
use App\User;
use App\StatuProposal;
use App\GroupWishe;
use App\Meeting;
use App\Meeting_projectStudent;
use App\TypeDeliv;
use App\Deliv;
use DB;




class StudentController extends Controller
{ 
    public function __construct(){
        //$this->middleware('student');
    }
    Public function Home(){ // Call Page of Master Student.
        try{
            return view('layouts.Home.Student');
        }  
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Home."); 
        }
    }
    
    // My Proposals.
    public function MyProposals(){ // Call Page My Proposals.
        try{
            $UserId = \Auth::user()->id;
            $TPNYes = Proposal::where([['users_id',$UserId],['PropertyRight','1']])->get();
            $TPNNo = Proposal::where([['users_id',$UserId],['PropertyRight','2']])->get();
            return view('student.proposal.index',compact('TPNYes','TPNNo'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله MyProposals."); 
        }
    }
    Public function CreateProposals(){// Call Page Create Proposals
        try{
            if(EndTimeSubmitProposal() > Time_Now()){
                $UserId = \Auth::user()->id;
                $Proposal = Proposal::where('users_id',$UserId)->count();
                if($Proposal >= Max_NumberAddProposal_Student()){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة العدد المطلوب من المقترحات');   
                    return redirect()->back();
                }else{
                    $Program = Program::all();
                    return view('student.proposal.create',compact('Program'));
                }
               
            }
            else{
                session()->push('m','error');
                session()->push('m','عذراً ، لايمكنك تقديم مقترح !! انتهي الوقت المخصص لذلك .');   
                return redirect()->back();
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله CreateProposals."); 
        }

    }
    Public function StoreProposals(Request $request){// create a new Proposal for Student.
        
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
            $input['calendar_id'] =Calendar_Current()->id;
            $NewProposal = Proposal::create($input);
    
            foreach($input['Program'] as $Program){
                Proposal_Program::create(['proposal_id'=>$NewProposal->id,'program_id'=>$Program]);
            }
            session()->push('m','success');
            session()->push('m',"تم تقديم مقترحك بنجاح {$username} ، وسوف يتم مراجعته من قبل المختص في اللجنة.");   
            return redirect('student/my-proposals');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله StoreProposals."); 
        }
               
    }
    Public function SelectionProposals(){// Call Page Selection Proposals.
        try{
            $condtion = ProjectCalendar::findOrfail(1);
            $Proposal = Proposal::where('References',1)->where('Certified',1)->where('PropertyRight','>',1)->orderBy('created_at','desc')->paginate(10);
            return view('student.proposal.chooseProposal',compact('condtion','Proposal'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله SelectionProposals."); 
        }
    }
    Public function DetailsProposal($id){// Call Page Details Proposal
        try{
            $Proposal = Proposal::findOrfail($id);
            $Program = Proposal_Program::where('proposal_id',$id)->get();
            $p = array();
            foreach($Program as $pro){
                $p [] = $pro->program_id;
            }
            $Programs = Program::all();
            return view('student.proposal.show',compact('Proposal','p','Programs'));
            
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله DetailsProposal."); 
        }
       
    }
    public function EditProposal($id){ // Call page edit proposal
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
                return view('student.proposal.edit',compact('Proposal','Program','ProgramID'));
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله EditProposal."); 
        }
    }
    public function UpdateProposal(Request $request,$id){// Call page proposal update
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
         
                return redirect("student/my-proposals");
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله UpdateProposal."); 
        }
    }
    public function DeleteProposal($id){// Call page proposal delete
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
         
                return redirect("student/my-proposals");
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله DeleteProposal."); 
        }
    }

    // Mg Group
    Public function MyGroup(){// Call the page my group
        try{
            if(Student_has_groug() == 'no'){
                return view('student.group.welcome');  
            }
            else{
                $UserId = \Auth::user()->id;
                $SG = ProjectStudent::where('users_id',$UserId)->first();
                $GId = $SG->project_groups_id;
                $Team = ProjectStudent::where('project_groups_id',$GId)->get(); // Get Team item
                $SAN =  $SG->AcdameicNumber;
                $G =projectGroup::where('id',$GId)->first();
                if($G){
                    $Wishe = GroupWishe::where('groups_id',$G->id)->get();
                    return view('student.group.show',compact('G','Team','SAN','GId','Wishe'));  
                }
                else{
                    return redirect('error')->withFlashMessage('الرقم المعرف الخاص بمجموعتك ، ليس متواجد في جدول المجموعات!!'); 
                }
                  
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله MyGroup."); 
        }
    }
    Public function PageCreateGroup(){// Call the page create group
        try{
            $UserId = \Auth::user()->id;
            $Branch = ProjectStudent::where('users_id',$UserId)->first();
            return view('student.group.create',compact('Branch'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله PageCreateGroup."); 
        }
    }
    Public function CreateGroup(Request $request){//create Group for student
        $this->validate($request,
            ['GroupCode'=>'required|unique:project_groups'],
            ['GroupCode.required'=>"الرجاء أدخال رمز الدخول الخاص بالمجموعة.",
            'GroupCode.unique'=>'عذراً ، الرمز الذي أدخلته موجود مسبقاً !! الرجاء أختيار رمز أخرى فريد .'
        ]);//Validate   
        try{
            if(Time_Now() > End_TimeCreateGroup()){
                session()->push('m','error');
                session()->push('m',"لقد أنتهي الوقت المخصص لإنشاء المجموعات");   
                return redirect()->back();
            }else{ 
                if(Student_has_groug() == 'yes'){
                    session()->push('m','error');
                    session()->push('m',"لا يمكنك أنشاء مجموعة عمل لانك عضو في مجموعة");   
                    return redirect()->back();
                }else{
                    //$Calendar = ProjectCalendar::findOrfail(1);
                    $UserId = \Auth::user()->id;
                    $AN = ProjectStudent::where('users_id',$UserId)->first();
                    $GroupLader = $AN->AcdameicNumber;
                    $username = \Auth::user()->Name;

                    if(projectGroup::where('GroupLader',$GroupLader)->first()){ 
                        session()->push('m','error');
                        session()->push('m',"لا يمكنك أنشاء مجموعة عمل مره اخرى عزيزي {$username} ، لانك قد انشت مجموعة سابقة !!");   
                        return redirect()->back();
                    }
                    else{                   
                        $NewGroup = new projectGroup;
                        $NewGroup->GroupCode = $request->GroupCode;
                        $NewGroup->calendar_id = Calendar_Current()->id;
                        
                        //$NewGroup->AcademicYear = $Calendar->AcademicYear;

                        $NewGroup->branches_id = $AN->branches_id;
                        $NewGroup->GroupLader = $GroupLader;
                        $NewGroup->created_by = $UserId;
                        $NewGroup->Number_Team = '1';
                        $NewGroup->save();
                
                        ProjectStudent::findOrfail($GroupLader)->update(['project_groups_id'=>$NewGroup->id]);
                        session()->push('m','success');
                        session()->push('m','تم أنشاء مجموعة العمل بنجاح.');
                        return redirect('student/my-group');  
                    }
                }
            }  
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله CreateGroup."); 
        }    
    }
    Public function Groups(){// Call the index for all gruop
        try{
            $UserId = \Auth::user()->id;
            $UserGender = \Auth::user()->Gender;
            $condtion = ProjectCalendar::findOrfail(1);
            if($UserGender =="ذكر"){
                $gruop = projectGroup::where('branches_id','1')->orderBy('id','desc')->paginate(10);
                return view('student.group.index',compact('gruop','condtion'));
            }
            if($UserGender =="انثي"){
               $gruop = projectGroup::where('branches_id','2')->paginate(10);
               return view('student.group.index',compact('gruop','condtion'));
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Groups."); 
        } 
    } 
    Public function DetailsGroup($id){// Call page details group 
        try{
            $gruop = projectGroup::findOrfail($id);
            $condtion = ProjectCalendar::findOrfail(1);
            $Team = ProjectStudent::where('project_groups_id',$id)->get(); // Get Team item
            $Wishe = GroupWishe::where('groups_id',$gruop->id)->get();
            return view('student.group.details',compact('gruop','condtion','Team','Wishe'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله DetailsGroup."); 
        }    
    }
    Public function JoinGroup(Request $request ,$id){// Join group 
        try{
            $group = projectGroup::find($id);
            if($group){
                $codeGroup = $group->GroupCode;
                if($codeGroup != $request->GroupCode)
                {
                    session()->push('m','error');
                    session()->push('m','عذراً، رمز المجموعة الذي ادخلته غير صحيح !! يرجي التاكد من الرمز. او قم بالتواصل مع رئيس المجموعة.');   
                    return redirect()->back();
                }
                else{
                    if($group->Number_Team >=  Max_NumberofStudentinGroups() ){
                        session()->push('m','error');
                        session()->push('m','عذراً، هذا المجموعة قد اكتمل عدد الطلاب فيها..');   
                        return redirect()->back();
                    }
                    else{
                        $UserId = \Auth::user()->id;
                        $Student = ProjectStudent::where('users_id',$UserId)->first();
                        $AN = $Student->AcdameicNumber;
                        ProjectStudent::findOrfail($AN)->update(['project_groups_id'=>$id]);
                        $last_Number =$group->Number_Team;
                        $New_Number =$last_Number+1;
                        projectGroup::findOrfail($id)->update(['Number_Team'=>$New_Number]);
                        session()->push('m','success');
                        session()->push('m','تم أضافتك الى المجموعة بنجاح.');   
                        return redirect('student/my-group');
                    }
                        
                }
            }
            else{
                return redirect('error')->withFlashMessage('الرقم المعرف الخاص بمجموعتك ، ليس متواجد في جدول المجموعات!!'); 
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله JoinGroup."); 
        }  
    }
    public function LogOutGroup(){// log out for group
        try{
            $UserId = \Auth::user()->id;
            $Student = ProjectStudent::where('users_id',$UserId)->first();
            $group = projectGroup::findOrfail($Student->project_groups_id);
            $OldNumber_Team =$group->Number_Team;
            $New_Number =$OldNumber_Team-1;
            if( $group->proposals_id == null &&  $group->FN_Supervisor == null ){
                ProjectStudent::findOrfail($Student->AcdameicNumber)->update(['project_groups_id'=>Null]);
                projectGroup::findOrfail($group->id)->update(['Number_Team'=>$New_Number]);
                session()->push('m','success');
                session()->push('m','تم عملية الخروج من المجموعة بنجاح.');   
                return redirect('home/student');
                
            }else{
                session()->push('m','error');
                session()->push('m','لايمكنك الخروج لان المجموعة قد تم اعتمادها من قبل اللجنة');   
                return redirect('student/my-group');

            }
         
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()},  هذا الخطأ متواجد في الكنترول الخاص بالطالب StudentController  ، في الداله LogOutGroup.  "); 
        }
    } 
    Public function AddWish($id){// Add wish proposal in students group
        try{
            $UserId = \Auth::user()->id;
            $SR = ProjectStudent::where('users_id',$UserId)->first();
            $has_group = $SR->project_groups_id;
            if($has_group == null){
                session()->push('m','error');
                session()->push('m',"يرجى اولاً أنشاء مجموعة قبل اختيار الرغبات!");   
                return redirect('student/my-group');
            }
            else{
                $G =projectGroup::where('id',$SR->project_groups_id)->first();
                if($G){
                    if(IsStudentManger() == 'yes'){
                        if($G->Number_Team <  Min_NumberofStudentinGroups()){
                            session()->push('m','error');
                            session()->push('m',"لايمكنك أضافة رغبة مشروع الى مجموعتك لان عدد الطلاب اقل من المطلوب ، قم بأضافة اعضاء الى المجموعة");   
                            return redirect('student/my-group');   
                        }
                        else{
                            $old_NumOfWishe = GroupWishe::where('groups_id',$G->id)->get();  
                            if( Number_Wishes()  > count($old_NumOfWishe)){
                                $Proposal =  Proposal::findOrfail($id);  
                                $IsProposerChoose =  GroupWishe::where('groups_id',$G->id)->where('proposals_id',$id)->get();
                                if(count($IsProposerChoose) == 0){
                                    if($G->Number_Team > $Proposal->NumberOfStudents){
                                        session()->push('m','error');
                                        session()->push('m',"لايمكنك اختيار هذا المقترح لان عدد أعضاء الفريق في المجموعة اكبر من العدد المطلوب");   
                                        return redirect()->back();
                                    }else{
                                        $NewWishe = new GroupWishe;
                                        $NewWishe->groups_id = $G->id;
                                        $NewWishe->proposals_id = $id;
                                        $NewWishe->status = 0;
                                        $NewWishe->save();  
                                        $GetOldSelectedNumber =  $Proposal->Selected;
                                        $except ['Selected'] =$GetOldSelectedNumber+1;
                                        $Proposal->update($except);
                                        session()->push('m','success');
                                        session()->push('m','تم أضافة هذا المقترح بنجاح الى رغبات المجموعة');
                                        return redirect('student/my-group');
                                    }
                                }else{
                                    session()->push('m','error');
                                    session()->push('m',"لقد قمت بأختيار هذه المقترح من قبل!");   
                                    return redirect('student/my-group');   
    
                                }
                            }else{
                                session()->push('m','error');
                                session()->push('m',"لقد أضفت العدد الكافي من الرغبات الى مجموعتك");   
                                return redirect('student/my-group');   

                            }    
                        } 
                    }
                    else{
                        session()->push('m','error');
                        session()->push('m',"عذراً،فقط من صلاحيات مدير المجموعة اختيار الرغبات!");   
                        return redirect()->back();
                    }     
                }
                else {
                    return redirect('error')->withFlashMessage('الرقم المعرف الخاص بمجموعتك ، ليس متواجد في جدول المجموعات!!');  
                }
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()},  هذا الخطأ متواجد في الكنترول الخاص بالطالب StudentController  ، في الداله AddProposal.  "); 
        }
    }
    public function DeleteWish($id){ // Delete wish 
        try{
            $Wishe = GroupWishe::find($id);
            $Wishe->delete();
            return redirect()->back(); 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله DeleteWish."); 
        }  
    }
    public function SelectPriority(Request $request,$Id_WisheNumber,$Id_Priority,$Id_Group){ // add priority for groups student
        try{
            $priority = $request->priority;

            $Wishe = GroupWishe::where('id',$Id_WisheNumber)->first();
            $Wishe->update(['priority'=>$priority]);
            
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله SelectPriority."); 
        } 
    }

    // Meetings
    Public function Meetings(){// page Meetings 
        try{
            $UserId = \Auth::user()->id;
            $SG = ProjectStudent::where('users_id',$UserId)->first();
            $Meetings = Meeting::where('project_group',$SG->project_groups_id)->get();
            return view('student.Meetings.Index',compact('Meetings'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Meetings."); 
        } 
    }
    Public function MeetingDetails($id){// page Meeting details
        try{
            $Meeting = Meeting::findOrfail($id);
            return view('student.Meetings.Details',compact('Meeting'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله MeetingDetails."); 
        } 
    }
    
    // Deliveries
    Public function Deliveries(){// page Deliveries 
        try{
            $UserId = \Auth::user()->id;
            $SG = ProjectStudent::where('users_id',$UserId)->first();
            $Deliver = Deliv::where('group_id',$SG->project_groups_id)->get();
            return view('student.Deliveries.Index',compact('Deliver'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Deliveries."); 
        }

    }
    Public function DeliveriesSubmit($id){// page Deliveries Submit 
        try{
            $Deliveries=TypeDeliv::findOrfail($id);
            return view('student.Deliveries.Submit',compact('Deliveries'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Deliveries."); 
        }

    }
    Public function DeliveriesUpload(Request $request ,$id){// page Deliveries upload 
     
        try{
            $UserId = \Auth::user()->id;
            $RecardStudent = ProjectStudent::where('users_id',$UserId)->first(); 
            $GroupId = $RecardStudent->project_groups_id; 

            $Deliveries_Name = date("Y-m-d-h-i-s") . "_" . $GroupId . "_" . $id . "." .$request->import_file->getClientOriginalExtension();
          
            $request->import_file->move(public_path('uploads\deliveries'),$Deliveries_Name);

            $New_Deliveries = new Deliv;
            $New_Deliveries->group_id =  $GroupId;
            $New_Deliveries->type_deliv = $id;
            $New_Deliveries->created_by = $RecardStudent->AcdameicNumber;
            $New_Deliveries->statu = "0";
            $New_Deliveries->path = $Deliveries_Name;
            $New_Deliveries->save();

         
            session()->push('m','success');
            session()->push('m',"تم التقديم بنجاح");   
            return redirect('student/deliveries');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Deliveries."); 
        }

    }
    Public function DeliveriesDownload($id){// page Deliveries upload 
    
        try{
            $Deliv = Deliv::findOrfail($id);
            return response()->download($Deliv->path);
            
            // return redirect()->download(public_path('uploads\deliveries'),"");
            //return response()->download($Deliv->path);
        

        
            session()->push('m','success');
            session()->push('m',"تم التقديم بنجاح");   
            return redirect('student/deliveries');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Deliveries."); 
        }

    }

    // My ratings
    Public function Attendance(){// page Deliveries 
        try{
            $UserId = \Auth::user()->id;
            $SG = ProjectStudent::where('users_id',$UserId)->first();
            $Meetings = Meeting::where('project_group',$SG->project_groups_id)->get();
            $NumberMeetings = count( $Meetings);
            $Prsent = Meeting_projectStudent::where('AcdameicNumber',$SG->AcdameicNumber)->get()->count();
            $Stu_Prsent = Meeting_projectStudent::where('AcdameicNumber',$SG->AcdameicNumber)->get();
            $Absent = $NumberMeetings-$Prsent;
   
            return view('student.Ratings.Attendance',compact('Meetings','SG','Prsent','Absent','Stu_Prsent'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Attendance."); 
        }
    }
    Public function Grades(){// page Deliveries 
        try{
            $UserId = \Auth::user()->id;
            $SG = ProjectStudent::where('users_id',$UserId)->first();
            $Meetings = Meeting::where('project_group',$SG->project_groups_id)->get();
            $NumberMeetings = count( $Meetings);
            $Prsent = Meeting_projectStudent::where('AcdameicNumber',$SG->AcdameicNumber)->count();
            $Absent = $NumberMeetings-$Prsent;
   
            return view('student.Ratings.Grades',compact('Meetings','SG','Prsent','Absent'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()} هذا الخطأ متواجد في الكنترول الخاص بالطالب 'StudentController'  ، في الداله Attendance."); 
        }
    }

    

    
    public function StudentX(){
          $c = ProjectCalendar::find(1);
        if($c == null){
          dd("الصفحة غير متواجدة يرجي مراجعة مسؤول النظام");
        }
        else{
               //$stu = ProjectStudent::where('users_id',\Auth::user()->id)->first();
        session()->push('x','عذراً ، الصفحة قيد الإنشاء !!');
        session()->push('x','هذه الرسالة سوف تختفي بعد 5 ثواني.');   
    	return view('layouts.Home.Student',compact('c'));

        }
    }
     
    
    

    
    
    

   
    

   
    
}
