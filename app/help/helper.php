<?php
use Illuminate\Http\Request;
use App\ScientificDegree;
use App\ScientificDepartment;
use App\ProgramType;
use App\Constraint;
use App\ProjectStudent;
use App\ProjectSupervisor;
use App\UserRole;
use App\Program;
use App\projectGroup;
use App\ProjectCalendar;
use App\Grade;
use App\TypeDeliv;
use App\Calendar;
use App\Branch;



function date_only()
{ // الوقت الحالي
    $date = new \DateTime();
    $date->modify('+3 hours');
    $formatted_date = $date->format('m/d/Y');
    //$Time_System_Now = date('m/d/Y h:i A');
    //$Time_System_Now = date('Y-m-d h:i');
    //$mytime = Carbon\Carbon::now()->format('m/d/Y h:i A');
    return  $formatted_date;
}

function Time_Now(){ // الوقت الحالي
    $date = new \DateTime();
    $date->modify('+3 hours');
    $formatted_date = $date->format('Y-m-d h:i:i');
    //$Time_System_Now = date('m/d/Y h:i A');
    //$Time_System_Now = date('Y-m-d h:i');
    //$mytime = Carbon\Carbon::now()->format('m/d/Y h:i A');
    return  $formatted_date;
}
function Calendars(){
    $Calendars = Calendar::pluck('Name','id');
    return $Calendars;
}
function Calendar_Current(){
    $Calendars = Calendar::where('Current','1')->first();
    return $Calendars;
    
}
function ScientificDegree(){ // جلب بيانات الدرجات العلمية مع المسمى الخاص بعضو هيئة التدريس 
    $Degree = ScientificDegree::pluck('name','id');
    return $Degree;
}
function scientific_degrees(){ // جلب بيانات الدرجات العلمية مع المسمى الخاص بعضو هيئة التدريس 
    $Degree = ScientificDegree::get();
    return $Degree;
}

function ProgramType(){ // جلب بيانات انواع البرامج العلمية 
    $Type = ProgramType::pluck('name','id');
    return $Type;
}
function program_types(){ // جلب بيانات انواع البرامج العلمية 
    $Type = ProgramType::get();
    return $Type;
}
function Constraint(){ // استدعاء القيود العامة للجنة المشاريع 
    $id='1';
    $constraint=Constraint::findorfail($id);
    return $constraint;
}
function Program(){ // جلب جميع البرامج العلمية
    $program = Program::all();
    return $program;
}

function Type_appointments(){
    $type_appointments = [
        '1'=>'تسليم',
        '2'=>'مناقشة',
        '3'=>'حدث',
    ];
    return $type_appointments;

}
function  scientific_departments(){ //جلب جميع الاقسام العلمية
    $SD = ScientificDepartment::get();
    return $SD;

}

function Number(){
    $number = [
        '1'=>'1',
        '2'=>'2',
        '3'=>'3',
        '4'=>'4',
        '5'=>'5',
        '6'=>'6',
        '7'=>'7',
        '8'=>'8',
        '9'=>'9',
        '10'=>'10',

    ];
    return $number;
}
function AcademicYear(){
    $AY=['2017-2016'=>'2017-2016',
          '2018-2017'=>'2018-2017',
          '2019-2018'=>'2019-2018',
          '2020-2019'=>'2020-2019',
          '2021-2020'=>'2021-2020',
          '2022-2021'=>'2022-2021',
          '2023-2022'=>'2023-2022',
          '2024-2023'=>'2024-2023',
          '2025-2024'=>'2025-2024',
          '2026-2025'=>'2026-2025',
          '2027-2026'=>'2027-2026',
          '2028-2027'=>'2028-2027',
          '2029-2028'=>'2029-2028',
          '2030-2029'=>'2030-2029',];
    return $AY;
}
function Semester(){
    $Seme=['الأول'=>'الأول',
          'الثاني'=>'الثاني',
         ];
    return $Seme;
}

function Calendar_GPC(){
    try{
        $id='1';
        $Calendar=ProjectCalendar::findOrfail($id);
        return $Calendar;
    }
    catch (\Exception $e) {
        return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في ملف helper في الدالة Calendar_GPC."); 
    }
}

function Programs(){  
    $P = Program::pluck('ProgramName','id');
    return $P;
}
function UserRoles(){
    $UserRoles = UserRole::pluck('UserRoleAr','id');
    return $UserRoles;
}
/*function ScientificDegrees(){
    $SD = ['1'=>'دبلوم',
           '2'=>'بكالوريوس',
           '3'=>'ماجستير',
           '4'=>'دكتوراة',];
    return $SD;
}*/
function Branch(){
    $b=['1'=>'المركز الرئيسي',
       '2'=>'فرع الطالبات'];
       return $b;
}
function branches(){
   $B = Branch::get();
   return $B;
}
function IsStudentManger(){
    $UserId = \Auth::user()->id;
    $SG = ProjectStudent::where('users_id',$UserId)->first();
    $SAN =  $SG->AcdameicNumber;
    $GId = $SG->project_groups_id;
    $Group = projectGroup::where('id',$GId)->first();
    if ($Group) {  
        $GroupLader = $Group->GroupLader;
        if($SAN == $GroupLader){
            return 'yes';
        }
        else{
            return 'no';
        }
    } else {
        $Error_handle = "";
        // handle this situation
    }
  
      
       
}
function Student_has_groug(){ 
    $UserId = \Auth::user()->id;
    $SG = ProjectStudent::where('users_id',$UserId)->first();
    $GId = $SG->project_groups_id;
    if($GId == null){
        return 'no';
    }
    else{
        return'yes';
    }
}
function Group_has_depended(){
    $UserId = \Auth::user()->id;
    $SG = ProjectStudent::where('users_id',$UserId)->first();
    $GId = $SG->project_groups_id;
    if($GId == null){
        return 'no';
    }
    else{
        $Group = projectGroup::where('id',$GId)->first();
        if($Group->proposals_id == null){
            return 'no';
        }
        else{
            return'yes'; 
        }
      
    }

}
function Supervisor(){ 
    try{
        $Get_Supervisor = ProjectSupervisor::where('StatuSupervision','1')->get();
        return  $Get_Supervisor;
    }
    catch (\Exception $e) {
        return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بلحنة مشاريع التخرج ، في الداله HomeGPCO.  "); 
    }

}
function Is_FacultyMember_Supervisor(){

    $UserId = \Auth::user()->id;
    $Get_Supervisor = ProjectSupervisor::where('id',$UserId)->first();
    if($Get_Supervisor->StatuSupervision == 1){
        return 'yes';
    }
    elseif($Get_Supervisor->StatuSupervision == 0){
        return 'no';
    }

}

/* Conditions of GPC */

    function AcademicYear_GPC(){ //
        $Calendar=Calendar::where('Current','1')->first();
        $AcademicYear = $Calendar->AcademicYear;
        return $AcademicYear;
    }

    function Semester_GPC(){ //
        $Calendar=Calendar::where('Current','1')->first();
        $Semester = $Calendar->Semester;
        return $Semester;
    }

    function EndTimeSubmitProposal(){
        $Calendar=Calendar::where('Current','1')->first();
        if($Calendar){
            $SubmissionProposals = $Calendar->EndSubmissionProposals;
            return $SubmissionProposals;
        }
        return 'null';
    }

    function Max_NumberAddProposal_Student(){
        $id='1';
        $Calendar=Constraint::findOrfail($id);
        $Number_AddProposalStudent = $Calendar->Number_AddProposalStudent;
        return $Number_AddProposalStudent;
     
    }

    function Max_NumberAddProposal_FacultyMember(){
        $id='1';
        $Calendar=ProjectCalendar::findOrfail($id);
        $Number_AddProposalTeacher = $Calendar->Number_AddProposalTeacher;
        return $Number_AddProposalTeacher;
     
    }

    function End_TimeChooseWishes(){
        $Calendar=Calendar::where('Current','1')->first();
        if($Calendar){
            $EndChooseWishes = $Calendar->EndChooseWishes;
            return $EndChooseWishes;

        }
        return 'null';
    }

    function Min_NumberofStudentinGroups(){
        $id='1';
        $Calendar=Constraint::findOrfail($id);
        $Min_Number_StudentinGroup = $Calendar->Min_Number_StudentinGroup;
        return $Min_Number_StudentinGroup;

    }

    function Max_NumberofStudentinGroups(){
        $id='1';
        $Calendar=Constraint::findOrfail($id);
        $Number_StudentinGroup = $Calendar->Max_Number_StudentinGroup;
        return $Number_StudentinGroup;

    }

    function Number_Wishes(){
        $id='1';
        $Constraint=Constraint::findOrfail($id);
        $Number_chooseWishes = $Constraint->Number_chooseWishes;
        return $Number_chooseWishes;

    }

    function End_TimeCreateGroup(){
        $Calendar=Calendar::where('Current','1')->first();
        if($Calendar){
            $EndCreateGroup = $Calendar->EndCreateGroup;
            return $EndCreateGroup;

        }
        return 'null';
    }

    function Max_Certified_Project_GroupB(){
        $id='1';
        $Calendar=ProjectCalendar::findOrfail($id);
        $Max_Certified_Project_GroupB = $Calendar->Max_Certified_Project_GroupB;
        return $Max_Certified_Project_GroupB;

    }

    function Max_Certified_Project_GroupG(){
        $id='1';
        $Calendar=ProjectCalendar::findOrfail($id);
        $Max_Certified_Project_GroupG = $Calendar->Max_Certified_Project_GroupG;
        return $Max_Certified_Project_GroupG;

    }

    function Max_Supervisor_GroupsB(){
        $id='1';
        $Calendar=ProjectCalendar::findOrfail($id);
        $Max_Supervisor_GroupsB = $Calendar->Max_Supervisor_GroupsB;
        return $Max_Supervisor_GroupsB;

    }

    function Max_Supervisor_GroupsG(){
        $id='1';
        $Calendar=ProjectCalendar::findOrfail($id);
        $Max_Supervisor_GroupsG = $Calendar->Max_Supervisor_GroupsG;
        return $Max_Supervisor_GroupsG;

    }

    function Deliveries(){
        
        $deliveries=TypeDeliv::where('time_open','<',Time_Now())->where('time_close','>',Time_Now())->get();
       
        return $deliveries;

    }

    function Grades(){
        try{
            $id='1';
            $Grade=Grade::findOrfail($id);
            return $Grade;
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في ملف helper في الدالة Grades."); 
        }
    }

/* End Conditions of GPC */  