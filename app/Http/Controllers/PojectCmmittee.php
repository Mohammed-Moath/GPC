<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Constraint;
use App\ProjectCalendar;
use App\Appointments;
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
use App\Approval;
use App\Deliv;
use App\Calendar;
use App\UnderSupervision;
use PDF;
use Excel;
use DB;
use App\SupervisorExpected;
use Carbon;


class PojectCmmittee extends Controller
{
    /* Home */
    Public function Home(){ // Page Home of Project Committee.blade
        try{
            return view('layouts.Home.Project-Committee');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله Home."); 
        }
    }

    /* Start Configuration */

        // Constraint
        Public function Constraint(){// Call page index of Constraint
            try{
                $UndrSup = UnderSupervision::get(); 
                return view('Project-Committee.Configuration.Constraint.index',compact('UndrSup'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله Constraint.  "); 
            }
        }
        Public function AddUnderSupervisions(Request $request){// Add Under Supervisions
             
            $this->validate($request,
                [
                'scientific_degrees_id'=>'required',
                'program_types_id'=>'required',
                'Boys'=>'required',
                'Grilys'=>'required',],
                ['required'=>'يرجي أضافة البيانات']
            );  
            try{
                $validate=UnderSupervision::where('scientific_degrees_id',$request->scientific_degrees_id)->where('program_types_id',$request->program_types_id)->count();
                if($validate >= 1){
                    session()->push('m','error');
                    session()->push('m','هذا القيد مضاف !');   
                    return redirect()->back();

                }
                $input = $request->all();
                UnderSupervision::create($input); 
                return redirect()->back();
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله AddUnderSupervisions.  "); 
            }
        }
        Public function DeleteUnderSupervisions($id){// Delete Under Supervisions
            try{
               UnderSupervision::findOrfail($id)->delete(); 
               return redirect()->back();
           }
           catch (\Exception $e) {
               return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله DeleteUnderSupervisions.  "); 
           }
        }
        Public function UpdateConstraint(Request $request,$id){// Call page index of Constraint
            try{
                $input = $request->all();  
                Constraint::findOrfail($id)->update($input);
                session()->push('m','success');
                session()->push('m','تم حفظ الاعدادات بنجاح');   
                return redirect()->back();
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله UpdateConstraint.  "); 
            }
        }  
        // Grades
        Public function Grades(){// Call page index grades
            try{
                return view('Project-Committee.Configuration.Grades.index');
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله Grades.  "); 
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
                    session()->push('m','تم الحفظ بنجاح');   
                    return redirect()->back(); 
                }
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله UpdateGrades.  "); 
            }
        }

    /* End Configuration */

    /* Start Calendar */

        Public function CalendarIndex(Request $request){// Call page index of calendar
            try{
                if($request->filter == null){
                    $Calendars = Calendar::where('Current','1')->paginate(20);
                    $CF = '1'; //calendar filter
                    return view('Project-Committee.Calendar.index',compact('Calendars','CF'));
                }
                if($request->filter == 1){
                    $Calendars = Calendar::where('Current','1')->get();
                    $CF = '1'; //calendar filter
                    return view('Project-Committee.Calendar.index',compact('Calendars','CF'));
                }
                if($request->filter == 2){
                    $Calendars = Calendar::where('Active','1')->get();
                    $CF = '2'; //calendar filter
                    return view('Project-Committee.Calendar.index',compact('Calendars','CF'));
                }
                if($request->filter == 3){
                    $Calendars = Calendar::where('Active','0')->get();
                    $CF = '3'; //calendar filter
                    return view('Project-Committee.Calendar.index',compact('Calendars','CF'));
                }
                if($request->filter == 4){
                    $Calendars = Calendar::where('Active','2')->get();
                    $CF = '4'; //calendar filter
                    return view('Project-Committee.Calendar.index',compact('Calendars','CF'));
                }
                if($request->filter == 5){
                    $Calendars = Calendar::get();
                    $CF = '5';
                    return view('Project-Committee.Calendar.index',compact('Calendars','CF'));
                }
                return redirect('project-committee/calendar');   
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarIndex.  "); 
            }
        }
        Public function CalendarShow($id){// Call page show of calendar
            try{
                $Calendar = Calendar::findOrfail($id);
                return view('Project-Committee.Calendar.show',compact('Calendar'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarShow."); 
            }
        }
        Public function CalendarEdit($id){// Call page edit of calendar
            try{
                $Calendar = Calendar::findOrfail($id);
                return view('Project-Committee.Calendar.edit',compact('Calendar'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarEdit."); 
            }
        }
        Public function CalendarUpdate(Request $request ,$id){// Call page edit of calendar
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
                $lastCalendar = Calendar::findOrfail($id);
                if($lastCalendar->AcademicYear != $request->AcademicYear || $lastCalendar->Semester != $request->Semester ){
                    $Get_Calendar = Calendar::where('AcademicYear',$request->AcademicYear)->where('Semester',$request->Semester)->count();
                    if($Get_Calendar >= 1){
                        session()->push('m','error');
                        session()->push('m','لقد قمت بأضافة العام الجامعي والفصل الدراسي لتقويم مشابهة');   
                        return redirect('project-committee/calendar/create');
                    }

                }
              
                if(Time_Now() > $request->StartDate){
                    $Active='1';
                }
                if($request->StartDate > Time_Now()){
                    $Active='0';
                }
                if(Time_Now() > $request->EndDate){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة تاريخ قد فات لنهاية التقويم ');   
                    return redirect('project-committee/calendar/create');
                }
                if($request->StartDate > $request->EndDate){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة تاريخ بداية التقويم أكبر من نهايته ');   
                    return redirect('project-committee/calendar/create');
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
                    $get_calendar= Calendar::where('Current','1')->get();
                    if(count($get_calendar) == 0){
                        session()->push('m','error');
                        session()->push('m','لا يوجد لديك تقويم حالي ، قم بتحديد التقويم الحالي');   
                        return redirect('project-committee/calendar/create');
                    
                    }
                    if(count($get_calendar) > 1){
                        session()->push('m','error');
                        session()->push('m','يوجد في النظام اكثر من (1) تقويم حالي ، يرجي مراجع التقويم ،وتصحيح النظام.');   
                        return redirect('project-committee/calendar');
                    
                    }
                    $Current = '0';
                }
                $Calendar = Calendar::findOrfail($id);
                $input = $request->all();
          
                $Calendar->update($input);
                session()->push('m','success');
                session()->push('m','تم تعديل البيانات بنجاح');   
                return redirect()->back();   
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarUpdate."); 
            }
        
        }
        Public function CalendarCreate(){// Call page create of calendar
            try{
                return view('Project-Committee.Calendar.create');
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarCreate.  "); 
            }
        }
        Public function CalendarStore(Request $request){// Call page create of calendar

                  /* dd(
                $request->AcademicYear,
                $request->Semester,
                $request->name,
                $request->StartDate,
                $request->EndDate,
                $request->EndSubmissionProposals,
                $request->EndCreateGroup,
                $request->EndChooseWishes,
                $request->Active,
                $request->note,
                $request->Current,
                \Auth::user()->id,
                Time_Now()
            );*/
    
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
            
                $Get_Calendar = Calendar::where('AcademicYear',$request->AcademicYear)->where('Semester',$request->Semester)->count();
                if($Get_Calendar >= 1){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة العام الجامعي والفصل الدراسي لتقويم مشابهة');   
                    return redirect('project-committee/calendar/create');
                }
                if($request->Name ==null){
                    $name = " تقويم مشاريع التخرج للفصل الدراسي '$request->Semester' من العام الجامعي '$request->AcademicYear'";
                }
                /*if($request->Name !=null){
                    $name = $request->Name;
                }*/
                if(Time_Now() >= $request->StartDate){
                    $Active='1';
                }else{$Active='0';}
                if(Time_Now() > $request->EndDate){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة تاريخ قد فات لنهاية التقويم ');   
                    return redirect('project-committee/calendar/create');
                }
                if($request->StartDate > $request->EndDate){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة تاريخ بداية التقويم أكبر من نهايته ');   
                    return redirect('project-committee/calendar/create');
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
                    $get_calendar= Calendar::where('Current','1')->get();
                    if(count($get_calendar) == 0){
                        session()->push('m','error');
                        session()->push('m','لا يوجد لديك تقويم حالي ، قم بتحديد التقويم الحالي');   
                        return redirect('project-committee/calendar/create');
                    
                    }
                    if(count($get_calendar) > 1){
                        session()->push('m','error');
                        session()->push('m','يوجد في النظام اكثر من (1) تقويم حالي ، يرجي مراجع التقويم ،وتصحيح النظام.');   
                        return redirect('project-committee/calendar');
                    
                    }
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
                $New_Callendar->Active =  $Active;
                $New_Callendar->note = $request->note;
                $New_Callendar->Current = $Current;
                $New_Callendar->created_by = \Auth::user()->id;
                $New_Callendar->save();

                session()->push('m','success');
                session()->push('m','تم أنشاء التقويم بنجاح');   
                return redirect('project-committee/calendar');
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarStore.  "); 
            }
        }
        Public function CalendarDelete($id){// Call page edit of calendar
            try{
                $Calendar = Calendar::findOrfail($id);
          
                if($Calendar->StartDate > Time_Now()){
                    $Calendar->delete($id);
                    session()->push('m','success');
                    session()->push('m','تم حذف التقويم بنجاح');   
                    return redirect('project-committee/calendar');   
                }
                session()->push('m','error');
                session()->push('m','لايمكنك الحذف هذا التقويم نشط');   
                return redirect()->back();   
              
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarDelete."); 
            }
        
        }
        
        Public function AppointmentsCreate(){// Call page create of appointments
            try{
                if(count(Calendars()) == 0){
                session()->push('m', 'info');
                session()->push('m', ' لايوجد تقويم .. قم بأنشاء تقويم واحد على الاقل !');
                return redirect()->back();
                }
                else{
                     return view('Project-Committee.Calendar.Appointments.create');
                }
                
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarStore.  "); 
            }
        }
        Public function AppointmentsStore(Request $request){// Deliveries Store
            $this->validate($request,
                [
                'calendar_id'=>'required',
                'type'=>'required',
                'name'=>'required',
                'time_open'=>'required',
                'time_close'=>'required',],
                ['required'=>'يرجي أضافة البيانات']
            ); 
              
            try{ 
                if(Time_Now() > $request->time_close){
                    session()->push('m','error');
                    session()->push('m','لقد قمت بأضافة تاريخ قد فات لانتهاء مدة التسليم');   
                    return redirect()->back();
                }
    
                $input = $request->all();
                $input['created_by'] =\Auth::user()->id;
                $Deliveries = Appointments::create($input);
               
                session()->push('m','success');
                session()->push('m','تم أنشاء الموعد بنجاح');   
                return redirect('project-committee/calendar');
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله AppointmentsStore.  "); 
            }
        }
        Public function AppointmentsEdit($id){// Call page create of appointments
            try{
                $Appointment = Appointments::findOrfail($id);
                return view('Project-Committee.Calendar.Appointments.edit',compact('Appointment'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله AppointmentsEdit.  "); 
            }
        }
        Public function AppointmentsUpdate(Request $request,$id){// Call page create of appointments
            $this->validate($request,
                [
                'type'=>'required',
                'name'=>'required',
                'time_open'=>'required',
                'time_close'=>'required',],
                ['required'=>'يرجي أضافة البيانات']
            ); 
            try{
                $Appointment = Appointments::findOrfail($id);
                $input = $request->all();
          
                $Appointment->update($input);
                session()->push('m','success');
                session()->push('m','تم تعديل البيانات بنجاح');   
                return redirect()->back();   
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله AppointmentsUpdate.  "); 
            }
        }
        Public function AppointmentsDelete($id){// Call page edit of calendar
            try{
                $Appointments = Appointments::findOrfail($id);
          
                if($Appointments->time_open > Time_Now()){
                    $Appointments->delete($id);
                    session()->push('m','success');
                    session()->push('m','تم حذف الموعد بنجاح');   
                    return redirect()->back();   
                }
                session()->push('m','error');
                session()->push('m','لايمكنك الحذف هذا الموعد نشط');   
                return redirect()->back();   
              
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarDelete."); 
            }
        
        }
        

    /* End Calendar */
    
    /* Start Proposal */
        Public function ProposalIndex(Request $request){// Call page index of proposal
            try{        
                if($request->filter == null){
                    $CF = '1'; // calendars filter
                    $Proposal = Proposal::whereHas('calendars', function ($query) {
                        $query->where('Current','1');
                    })->get();
                    $New=$Proposal->where('References',0)->where('Certified',0)->where('Selected',0)->count();
                    $Certified=$Proposal->where('References',1)->where('Certified',1)->count();
                    $Selected= $Proposal->where('References',1)->where('Certified',1)->where('Selected','>',0)->count();       
                    $All= $Proposal->count();
                    return view('Project-Committee.Proposal.index',compact('New','Certified','Selected','All','CF'));
                }
                if($request->filter == 1){
                    $CF = '1'; // calendars filter
                    $Proposal = Proposal::whereHas('calendars', function ($query) {
                        $query->where('Current','1');
                    })->get();
                    $New=$Proposal->where('References',0)->where('Certified',0)->where('Selected',0)->count();
                    $Certified=$Proposal->where('References',1)->where('Certified',1)->count();
                    $Selected= $Proposal->where('References',1)->where('Certified',1)->where('Selected','>',0)->count();
                    $All= $Proposal->count();
                    return view('Project-Committee.Proposal.index',compact('New','Certified','Selected','All','CF'));
                }
                if($request->filter == 2){
                    $CF = '2'; // calendars filter
                    $Proposal = Proposal::whereHas('calendars', function ($query) {
                        $query->where('Active','1');
                    })->get();
                    $New=$Proposal->where('References',0)->where('Certified',0)->where('Selected',0)->count();
                    $Certified=$Proposal->where('References',1)->where('Certified',1)->count();
                    $Selected= $Proposal->where('References',1)->where('Certified',1)->where('Selected','>',0)->count();
                    $All= $Proposal->count();
                    return view('Project-Committee.Proposal.index',compact('New','Certified','Selected','All','CF'));
                }
                if($request->filter == 3){
                    $CF = '3'; // calendars filter
                    $Proposal = Proposal::whereHas('calendars', function ($query) {
                        $query->where('Active','2');
                    })->get();
                    $New=$Proposal->where('References',0)->where('Certified',0)->where('Selected',0)->count();
                    $Certified=$Proposal->where('References',1)->where('Certified',1)->count();
                    $Selected= $Proposal->where('References',1)->where('Certified',1)->where('Selected','>',0)->count();
                    $All= $Proposal->count();
                    return view('Project-Committee.Proposal.index',compact('New','Certified','Selected','All','CF'));
                }
                if($request->filter == 4){
                    $CF = '4'; // calendars filter
                    $Proposal = Proposal::all();
                    $New=$Proposal->where('References',0)->where('Certified',0)->where('Selected',0)->count();
                    $Certified=$Proposal->where('References',1)->where('Certified',1)->count();
                    $Selected= $Proposal->where('References',1)->where('Certified',1)->where('Selected','>',0)->count();
                    $All= $Proposal->count();
                    return view('Project-Committee.Proposal.index',compact('New','Certified','Selected','All','CF'));
                }
                return redirect('project-committee/proposal');
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalIndex.  "); 
            }
        }
        public function ProposalCreate(){ // Call page create proposal 
            try{ 
                
                if (count(Calendars()) == 0) {
                    session()->push('m', 'info');
                    session()->push('m', ' لايوجد تقويم .. قم بأنشاء تقويم واحد على الاقل !');
                    return redirect()->back();
                }else{
                    return view('Project-Committee.Proposal.create');}
        
            }catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalCreate."); 
            }

        }
        public function ProposalStore(Request $request){ // Call page create proposal 
        
            $this->validate($request,
                [
                    'calendar_id'=>'required',
                    'ProjectProposalTitle'=>'required|max:150|min:10',
                    'descrdiption'=>'required|min:100',
                    'scope'=>'required|min:50',
                    'Outputs'=>'required|min:50',
                    'ImportanceProposal'=>'required|min:50',
                    'Program'=>'required',
                    'Tools'=>'required|min:50',
                    'NumberOfStudents'=>'required|numeric|digits_between:1,2|max:5|min:1',
                    'Supervisor'=>'required',
                ],
                [   'required'=>'مطلوب اضافة بيانات !.',
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
                $input =$request->all();
                
                $NewProposal = new Proposal;
                $NewProposal->calendar_id =$request->calendar_id;
                $NewProposal->ProjectProposalTitle = $request->ProjectProposalTitle;
                $NewProposal->descrdiption = $request->descrdiption;
                $NewProposal->scope = $request->scope;
                $NewProposal->Outputs = $request->Outputs;
                $NewProposal->ImportanceProposal = $request->ImportanceProposal;
                $NewProposal->Tools = $request->Tools;
                $NewProposal->NumberOfStudents = $request->NumberOfStudents;
                $NewProposal->PropertyRight = 5;
                $NewProposal->users_id =\Auth::user()->id;
                $NewProposal->References =1;
                $NewProposal->Certified =1;
                $NewProposal->save();
        
                foreach($input['Program'] as $Program){
                    Proposal_Program::create(['proposal_id'=>$NewProposal->id,'program_id'=>$Program]);   
                }

                foreach($input['Supervisor'] as $Supervisor){
                    SupervisorExpected::create(['proposal_id'=>$NewProposal->id,'FunctionalNumber'=>$Supervisor]);  
                }
                session()->push('m','success');
                session()->push('m',"تم أضافة المقترح بنجاح");  
                return redirect("project-committee/proposal");
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalStore."); 
            }

        }
        Public function ProposalFilter($id,$filter){// Call page index of proposal 
            try{
            
                if($id == 1 && $filter == 1){
                    $Proposal = Proposal::where('References',0)->where('Certified',0)->where('Selected',0)->whereHas('calendars', function ($query) {
                        $query->where('Current','1');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "الجديد";
                    $calendar = "الحالي";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 2 && $filter == 1){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->whereHas('calendars', function ($query) {
                        $query->where('Current','1');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المعتمد";
                    $calendar = "الحالي";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 3 && $filter == 1){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->where('Selected','>','0')->whereHas('calendars', function ($query) {
                        $query->where('Current','1');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المختار";
                    $calendar = "الحالي";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 4 && $filter == 1){
                    $Proposal = Proposal::orderBy('id','desc')->paginate(20);
                    $Type_pro = "الكل";
                    $calendar = "الحالي";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }

                if($id == 1 && $filter == 2){
                    $Proposal = Proposal::where('References',0)->where('Certified',0)->where('Selected',0)->whereHas('calendars', function ($query) {
                        $query->where('Active','1');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "الجديد";
                    $calendar = "نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 2 && $filter == 2){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->whereHas('calendars', function ($query) {
                        $query->where('Active','1');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المعتمد";
                    $calendar = "نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 3 && $filter == 2){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->where('Selected','>','0')->whereHas('calendars', function ($query) {
                        $query->where('Active','1');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المختار";
                    $calendar = "نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 4 && $filter == 2){
                    $Proposal = Proposal::orderBy('id','desc')->paginate(20);
                    $Type_pro = "الكل";
                    $calendar = "نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }

                if($id == 1 && $filter == 3){
                    $Proposal = Proposal::where('References',0)->where('Certified',0)->where('Selected',0)->whereHas('calendars', function ($query) {
                        $query->where('Active','0');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "الجديد";
                    $calendar = "غير نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 2 && $filter == 3){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->whereHas('calendars', function ($query) {
                        $query->where('Active','0');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المعتمد";
                    $calendar = "غير نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 3 && $filter == 3){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->where('Selected','>','0')->whereHas('calendars', function ($query) {
                        $query->where('Active','0');
                    })->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المختار";
                    $calendar = "غير نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 4 && $filter == 3){
                    $Proposal = Proposal::orderBy('id','desc')->paginate(20);
                    $Type_pro = "الكل";
                    $calendar = "غير نشط";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 1 && $filter == 4){
                    $Proposal = Proposal::where('References',0)->where('Certified',0)->where('Selected',0)->orderBy('id','desc')->paginate(20);
                    $Type_pro = "الجديد";
                    $calendar = "الجميع";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 2 && $filter == 4){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المعتمد";
                    $calendar = "الجميع";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 3 && $filter == 4){
                    $Proposal = Proposal::where('References','1')->where('Certified','1')->where('Selected','>','0')->orderBy('id','desc')->paginate(20);
                    $Type_pro = "المختار";
                    $calendar = "الجميع";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                if($id == 4 && $filter == 4){
                    $Proposal = Proposal::orderBy('id','desc')->paginate(20);
                    $Type_pro = "الكل";
                    $calendar = "الجميع";
                    return view('Project-Committee.Proposal.details',compact('Proposal','Type_pro','calendar'));
                }
                return redirect('project-committee/proposal');   
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalFilter.  "); 
            }
        }
        Public function ProposalShow($id){// Call page show of proposal
            try{
                $Proposal= Proposal::findOrfail($id);
                $SP =  SupervisorExpected::where('proposal_id',$id)->get();
                return view('Project-Committee.Proposal.show',compact('Proposal','SP'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalShow.  "); 
            }
        }
        public function ProposalDelete($id){
            try{
                $Proposal=Proposal::findOrfail($id);
                if($Proposal->Selected > 0){
                    session()->push('m','error');
                    session()->push('m',"هذا المقترح قد تم أختياره ، لا يمكنك حذفه !");  
                    return redirect()->back();
                }
                else{
                    $Proposal->delete();
                    session()->push('m','success');
                    session()->push('m',"تم حذف المقترح بنجاح");  
                    return redirect('project-committee/proposal');
                } 
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalDelete.  "); 
            }
           
        }
        public function ProposalEdit($id){
            try{
                $Proposal=Proposal::findOrfail($id);
                if($Proposal->Selected > 0){
                    session()->push('m','error');
                    session()->push('m',"هذا المقترح قد تم أختياره ، لا يمكن التعديل عليه !");  
                   
                    return redirect()->back();
                }
                else{
                    $ProgramID = array();
                    foreach( $Proposal->programs  as $p){
                        $ProgramID[]= $p->id;
                    }
                    $SupervisorID = array();
                    $Supervisor_Expected = SupervisorExpected::where('proposal_id',$id)->get();
                    foreach( $Supervisor_Expected  as $s){
                        $SupervisorID[]= $s->FunctionalNumber;
                    }
                    return view('Project-Committee.Proposal.edit',compact('Proposal','SupervisorID','ProgramID'));
                } 
               
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalEdit.  "); 
            }
           
        }
        public function ProposaUpdate(Request $request, $id){
            $this->validate($request,
                [
                    'calendar_id'=>'required',
                    'ProjectProposalTitle'=>'required|max:150|min:10',
                    'descrdiption'=>'required|min:100',
                    'scope'=>'required|min:50',
                    'Outputs'=>'required|min:50',
                    'ImportanceProposal'=>'required|min:50',
                    'Program'=>'required',
                    'Tools'=>'required|min:50',
                    'NumberOfStudents'=>'required|numeric|digits_between:1,2|max:5|min:1',
                    'Supervisor'=>'required',
                ],
                [   'required'=>'مطلوب اضافة بيانات هنا !.',
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
                $input = $request->all();
                $input['References'] = '1';
                $Proposal = Proposal::findOrfail($id);// 
                $Proposal->update($input);
                
                Proposal_Program::where('proposal_id',$Proposal->id)->delete();
                foreach($input['Program'] as $Program){
                    Proposal_Program::create(['proposal_id'=>$Proposal->id,'program_id'=>$Program]);
                    
                }
                SupervisorExpected::where('proposal_id',$Proposal->id)->delete();
                foreach($input['Supervisor'] as $supervisor){
                    SupervisorExpected::create(['proposal_id'=>$Proposal->id,'FunctionalNumber'=>$supervisor]);
                    
                }
                
                session()->push('m','success');
                session()->push('m',"تم تعديل المقترح بنجاح");  
                return redirect("project-committee/proposal/{$id}");   
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposaUpdate.  "); 
            }
        }
        public function ProposalApproval($id){
            try{
                $Proposal =  Proposal::findOrfail($id); 
          
                if($Proposal->References == 0){
                    session()->push('m','error');
                    session()->push('m',"هذا المقترح لم تتم مراجعته ، يرجئ مراجعته بشكل فعلي واسناد مشرفين مقترحين له.");  
                    return redirect("projectCommittee/proposal/{$id}/edit");
                }
                // if($Proposal->References =1 & $Proposal->Certified =1){
                //     dd("ddd0");
                   
                //     session()->push('m','info');
                //     session()->push('m',"هذا المقترح تم اعتماده مسبقاً");  
                //     return redirect()->back();
                // }       
                else{
                    $except ['References'] =1;
                    $except ['Certified'] =1;
                    $Proposal->update($except);
                    session()->push('m','success');
                    session()->push('m',"تمت العملية بنجاح ، هذا المقترح معتمد");  
                    return redirect()->back();
                }           
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalApproval.  "); 
            }
        }
        public function ProposalCancellationOfAccreditation($id){ 
            try{
                $Proposal =  Proposal::findOrfail($id);
                if($Proposal->Selected > 0){
                    session()->push('m','error');
                    session()->push('m',"هذا المقترح قد تم أختياره ، لا يمكن الغاء اعتمادة!");  
                    return redirect()->back();
                } 
                else{
                    $except ['References'] =1;
                    $except ['Certified'] =0;
                    $Proposal->update($except);
                    session()->push('m','success');
                    session()->push('m',"تم العملية بنجاح ، هذا المقترح غير معتمد.");  
                    return redirect()->back();
                }         
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ProposalCancellationOfAccreditation.  "); 
            }
        }
    
    /* End Proposal */

    /* Start Approval of projects */

        public function ApprovalProjects(){ // Call page Approval of projects
            try{
                $P =  Proposal::all();
                if(count($P) == 0){
                    session()->push('m', 'info');
                    session()->push('m', "لا يوجد اي مقترح");
                    return redirect()->back();   

                }else{
                    $Proposal = GroupWishe::where('status', '0')->whereHas('project_groups', function ($query) {
                        $query->where('calendar_id', Calendar_Current()->id);
                    })->get()->unique('proposals_id');

                    $GroupWishe = GroupWishe::where('status', '0')->whereHas('project_groups', function ($query) {
                        $query->where('calendar_id', Calendar_Current()->id);
                    })->get()->groupBy('groups_id')->count();

                    $Approval = Approval::where('status', '0')->whereHas('project_groups', function ($query) {
                        $query->where('calendar_id', Calendar_Current()->id);
                    })->get()->groupBy('group_id')->count();

                    return view('Project-Committee.ApprovalProjects.index', compact('Proposal', 'Approval', 'GroupWishe'));

                }

            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalProjects."); 
            }

        }
        public function ApprovalProjectsAsDate($id){ // Call page Approval of projects 
            try{
                $Proposal =  Proposal::findOrfail($id);
                $GW = GroupWishe::where('proposals_id',$id)->where('status','0')->whereHas('project_groups', function ($query){
                    $query->where('calendar_id',Calendar_Current()->id);
                })->orderBy('created_at')->get();
                $SE = SupervisorExpected::where('proposal_id',$id)->get();
                return view('Project-Committee.ApprovalProjects.bydate',compact('Proposal','GW','SE'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalProjectsAsDate."); 
            }

        }
        public function AddSupervisor(Request $request, $id){ // add supervisor
            try{
                $Get_Supervisor = SupervisorExpected::where('proposal_id',$id)->where('FunctionalNumber',$request->Supervisor)->count();
                if($Get_Supervisor >= 1){
                    session()->push('m','error');
                    session()->push('m',"المشرف الذي أخترته مضاف فعلا");  
                    return redirect()->back();   
                }
                SupervisorExpected::create(['proposal_id'=>$id,'FunctionalNumber'=>$request->Supervisor]);  
                return redirect()->back();   
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله AddSupervisor."); 
            }

        }
        public function ApprovalProjectsAsDatesubmit(Request $request, $id){ // add supervisor
            try{
               
                if($request->Groups == null && $request->Supervisor == null ){
                    session()->push('m','error');
                    session()->push('m',"لم تقم بإي اجراء");  
                    return redirect()->back();   
                }
                if($request->Groups == null){
                    session()->push('m','error');
                    session()->push('m',"لم تقم بأختيار اي مجموعة !!");  
                    return redirect()->back();   
                }
                if($request->Supervisor  == null ){
                    session()->push('m','error');
                    session()->push('m',"لم تقم بأختيار اي مشرف !!");  
                    return redirect()->back();   
                }
                $Proposal = $id;
                $Supervisor = $request->Supervisor;
                $input = $request->all();  
                foreach($input['Groups'] as $g){
                    Approval::where(['proposals_id'=> $Proposal,'FN_Supervisor'=>$Supervisor ,'group_id'=>$g,'status'=>'0'])->delete();
                    Approval::create(['proposals_id'=> $Proposal,'FN_Supervisor'=>$Supervisor ,'group_id'=>$g,'status'=>'0']);
                    foreach($input['NotesCommittee'] as $key=>$note){ 
                        Approval::where('group_id',$key)->update(['NotesCommittee'=>$note]);
                    } 
                    GroupWishe::where('groups_id',$g)->update(['status'=>'1']);
                    GroupWishe::where('groups_id',$g)->where('proposals_id',$Proposal)->update(['status'=>'2']);
                    
                } 
                session()->push('m','success');
                session()->push('m',"تم عملية الاعتماد بنجاح");  
                return redirect('project-committee/approval-projects'); 
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalProjectsAsDatesubmit."); 
            }

        }
        public function DeleteSupervisor($supervisor,$proposal){ // Call page Approval of projects 
            try{
                $delete = SupervisorExpected::where('proposal_id',$proposal)->where('FunctionalNumber',$supervisor)->delete();
                return redirect()->back();   
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله DeleteSupervisor."); 
            }
        }
        public function ApprovalProjects2(){ // Call page Approval of projects
            try{
                $Groups = GroupWishe::where('status','0')->whereHas('project_groups', function ($query){
                    $query->where('calendar_id',Calendar_Current()->id);
                })->get()->unique('groups_id');

                $GroupWishe = GroupWishe::where('status','0')->whereHas('project_groups', function ($query){
                    $query->where('calendar_id',Calendar_Current()->id);
                })->get()->groupBy('groups_id')->count();
             
                $Approval = Approval::where('status','0')->whereHas('project_groups', function ($query){
                    $query->where('calendar_id',Calendar_Current()->id);
                })->get()->groupBy('group_id')->count();

                return view('Project-Committee.ApprovalProjects.index2',compact('Groups','Approval','GroupWishe'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalProjects2."); 
            }

        }
        public function ApprovalProjectsAsPriority($group){ // Call page Approval of projects
            try{
                $Group = projectGroup::findOrfail($group);
                return view('Project-Committee.ApprovalProjects.aspriority',compact('Group'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalProjectsAsPriority."); 
            }

        }
        public function Getsuper($group,$proposal){ // Call page Approval of projects
            try{
                $Proposal = Proposal::findOrfail($proposal);
                $Group = projectGroup::findOrfail($group);
                return view('Project-Committee.ApprovalProjects.priority',compact('Group','Proposal'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله Getsuper."); 
            }

        }
        public function ApprovalProjectsAsPrioirty(Request $request, $group,$proposal){ // add supervisor
            try{
                if($request->Supervisor  == null ){
                    session()->push('m','error');
                    session()->push('m',"لم تقم بأختيار اي مشرف !!");  
                    return redirect()->back();   
                }

                $Supervisor = $request->Supervisor;
                $NotesCommittee = $request->NotesCommittee;

                Approval::where(['proposals_id'=> $proposal,'FN_Supervisor'=>$Supervisor ,'group_id'=>$group,'status'=>'0'])->delete();
                Approval::create(['proposals_id'=> $proposal,'FN_Supervisor'=>$Supervisor ,'group_id'=>$group,'status'=>'0']);
                GroupWishe::where('groups_id',$group)->update(['status'=>'1']);
                GroupWishe::where('groups_id',$group)->where('proposals_id',$proposal)->update(['status'=>'2']);
          
                session()->push('m','success');
                session()->push('m',"تم عملية الاعتماد بنجاح");  
                return redirect('project-committee/approval-projects2'); 
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalProjectsAsPrioirty."); 
            }

        }
        public function ApprovalAll(){ // Call page Approval of projects
            try{
                $GroupWishe = GroupWishe::where('status','0')->whereHas('project_groups', function ($query){
                    $query->where('calendar_id',Calendar_Current()->id);
                })->get()->groupBy('groups_id')->count();
             
                $Approval = Approval::where('status','0')->whereHas('project_groups', function ($query){
                    $query->where('calendar_id',Calendar_Current()->id);
                })->get();

                return view('Project-Committee.ApprovalProjects.approval',compact('Approval','GroupWishe'));
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalAll."); 
            }

        }
        public function ApprovalFinel(Request $request){ // add supervisor
            try{
                if($request->Groups  == null ){
                    session()->push('m','error');
                    session()->push('m',"قم بأختيار مجموعة على الاقل !");  
                    return redirect()->back();   
                }

                $input = $request->all();  
                foreach($input['Groups'] as $g){
                    $Get_Info = Approval::where('id',$g)->get();
                    foreach($Get_Info as $GI){
                        projectGroup::where('id',$GI->group_id)->update([
                            'proposals_id'=>$GI->proposals_id,
                            'FN_Supervisor'=>$GI->FN_Supervisor,
                            'NotesCommittee'=>$GI->NotesCommittee]
                        );
                    }
                    Approval::where('id',$g)->update(['status'=>'1']);   
                } 
          
                session()->push('m','success');
                session()->push('m',"تم عملية الاعتماد النهائي بنجاح");  
                return redirect('project-committee/approval-projects3'); 
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله ApprovalFinel."); 
            }

        }

    /* End Approval of projects */

    /* Start Groups */
        public function GetIndexGroups(Request $request){ // Call page index of groups
            try{    
                if($request->filter == null){
                    $CF = '1'; // calendar filter
                    $Groups = projectGroup::whereHas('calendars', function ($query){
                        $query->where('Current','1');
                    })->orderBy('id','desc')->paginate(20);
                    return view('Project-Committee.Groups.index',compact('CF','Groups'));     
                }
                if($request->filter == 1){
                    $CF = '1'; // calendar filter
                    $Groups = projectGroup::whereHas('calendars', function ($query){
                        $query->where('Current','1');
                    })->orderBy('id','desc')->paginate(20);
                    return view('Project-Committee.Groups.index',compact('CF','Groups'));    
                }
                if($request->filter == 2){
                    $CF = '2'; // calendar filter
                    $Groups = projectGroup::whereHas('calendars', function ($query){
                        $query->where('Active','1');
                    })->orderBy('id','desc')->paginate(20);
                    return view('Project-Committee.Groups.index',compact('CF','Groups'));       
                }
                if($request->filter == 3){
                    $CF = '3'; // calendar filter
                    $Groups = projectGroup::whereHas('calendars', function ($query){
                        $query->where('Active','0');
                    })->orderBy('id','desc')->paginate(20);
                    return view('Project-Committee.Groups.index',compact('CF','Groups'));  
                }
                if($request->filter == 4){
                    $CF = '4'; // calendar filter
                    $Groups = projectGroup::orderBy('id','desc')->paginate(20);
                    return view('Project-Committee.Groups.index',compact('CF','Groups'));  
                }
                return redirect('project-committee/groups');
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله GetIndexGroups."); 
            }
        }
        public function GetShowGroup($id){ // Call page show of groups
            try{    
                $Group = projectGroup::findOrfail($id);
                return view('Project-Committee.Groups.show',compact('Group'));    
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله GetShowGroup."); 
            }
        }
        public function GetCreateGroup(){ // Call page show of groups
            try{    
                return view('Project-Committee.Groups.create');    
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله GetCreateGroup."); 
            }
        }
        
    /* End Groups */

    /* Start Follow */
        public function GetIndexFollow(Request $request){ // Call page index of groups
            try{    
               
                if($request->filter == null){
                    $CF = '1'; // calendar filter
                    $Groups = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor','>','0')->whereHas('calendars', function ($query){
                        $query->where('Current','1');
                    })->paginate(20);
                    return view('Project-Committee.Follow.index',compact('CF','Groups'));   
                }
                if($request->filter == 1){
                    $CF = '1'; // calendar filter
                    $Groups = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor','>','0')->whereHas('calendars', function ($query){
                        $query->where('Current','1');
                    })->paginate(20);
                    return view('Project-Committee.Follow.index',compact('CF','Groups'));   
                }
                if($request->filter == 2){
                    $CF = '2'; // calendar filter
                    $Groups = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor','>','0')->whereHas('calendars', function ($query){
                        $query->where('Active','1');
                    })->paginate(20);
                    return view('Project-Committee.Follow.index',compact('CF','Groups'));   
                }
                if($request->filter == 3){
                    $CF = '3'; // calendar filter
                    $Groups = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor','>','0')->whereHas('calendars', function ($query){
                        $query->where('Active','2');
                    })->paginate(20);
                    return view('Project-Committee.Follow.index',compact('CF','Groups'));   
                }
                if($request->filter == 4){
                    $CF = '4'; // calendar filter
                    $Groups = projectGroup::where('proposals_id','>','0')->where('FN_Supervisor','>','0')->paginate(20);
                    return view('Project-Committee.Follow.index',compact('CF','Groups'));  
                }
                return redirect('project-committee/groups');
            }
            catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله GetIndexGroups."); 
            }
        }
    /* End Follow */


    /* Start the data */
        public function Students_data(Request $request){
            try {
                if ($request->filter == null || $request->filter <= 1) {
                    $Studets = ProjectStudent::paginate(20);
                    $SF = '1'; //  Students filter
                }
                if ($request->filter == 2) {
                    $Studets = ProjectStudent::where('branches_id', '1')->paginate(20);
                    $SF = '2'; 
            
                }
                if ($request->filter == 3) {
                    $Studets = ProjectStudent::where('branches_id', '2')->paginate(20);
                    $SF = '3'; 
                
                }
                if ($request->filter == 4) {
                    $Studets = ProjectStudent::where('project_groups_id', null)->paginate(20);
                    $SF = '4'; 
                }
                if ($request->filter == 5) {
                    $Studets = ProjectStudent::where('project_groups_id', !null)->paginate(20);
                    $SF = '5';

                }
                return view('Project-Committee.data.Students', compact('Studets', 'SF'));
            } catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarIndex.  ");
            }
        }
        public function Supervisors_data(Request $request){
            try {
            
                if ($request->filter == null || $request->filter <= 1) {
                    $Supervisors = ProjectSupervisor::paginate(20);
                    $SF = '1'; //  Supervisor filter
                    //dd($Supervisors);
                }
                // if ($request->filter == 2) {
                //     $Supervisors = ProjectSupervisor::where('branches_id', '1')->paginate(20);
                //     $SF = '2';
                // }
                // if ($request->filter == 3) {
                //     $Supervisors = ProjectSupervisor::where('branches_id', '2')->paginate(20);
                //     $SF = '3';
                // }
                // if ($request->filter == 4) {
                //     $Supervisors = ProjectSupervisor::where('project_groups_id', null)->paginate(20);
                //     $SF = '4';
                // }
                // if ($request->filter == 5) {
                //     $Supervisors = ProjectSupervisor::where('project_groups_id', !null)->paginate(20);
                //     $SF = '5';
                // }
                return view('Project-Committee.data.Supervisors', compact('Supervisors', 'SF'));
            } catch (\Exception $e) {
                return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله CalendarIndex.  ");
            }
        }

    /* End the data */

    /* Srart the Reports */

    public function Reports(){ 
        try {
            return view('Project-Committee.Report.index');
        } catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}  هذا الخطأ متواجد في الكنترول الخاص بلجنة مشاريع التخرج  'PojectCmmittee' ، في الداله Reports.");
        }
    }
    
    /* End the Reoirts */
}

