<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

/* Welcome */
Route::get('/', function () {
    return view('welcome');

});
Route::get('error', function () {
    return view('layouts.Error.404');

});
/*  Under construction*/
Route::get('under-construction', function () {
    session()->push('m', 'info');
    session()->push('m', 'عذراَ قيد الانشاء... Sorry, this page is under construction');   
    return redirect()->back();
});



/* login */
Route::get('login','SessionsController@create');
Route::post('login','SessionsController@store');

/* logout */
Route::get('logout','SessionsController@destroy');



/* Administrator */
//Route::group(['middleware'=>['web','admin']],function(){

    // Home 
    Route::get('administrator/home','Administrator@GetHome');

    // Configuration
    Route::get('administrator/configuration/public','Administrator@GetPublicIndex');
    Route::get('administrator/configuration/data','Administrator@GetDataIndex');

    // Users
    Route::get('administrator/users', 'Administrator@index_users');
    Route::post('administrator/users/add','Administrator@add_user');
    Route::post('administrator/users/add/{user_role}', 'Administrator@user_save');


    Route::get('administrator/users/{id}/show','Administrator@GetUsersShow');
    Route::get('administrator/users/{id}/edit','Administrator@GetUsersEdit');
    Route::PATCH('administrator/users/{id}/update','Administrator@UpdateUser');
    Route::DELETE('administrator/users/{id}/delete', 'Administrator@destroy');


////////////////////////////////////////////////////////////////////////////////////
    Route::get('administrator/users/add/manger','Administrator@GetAddManger');
    Route::post('administrator/users/add/manger','Administrator@PostAddManger');

    Route::get('administrator/users/add/student','Administrator@GetAddStudnet');
    Route::post('administrator/users/add/student','Administrator@PostAddStudent');

    Route::get('administrator/users/add/ProjectCommittee','Administrator@GetAddProjectCommittee');
    Route::post('administrator/users/add/ProjectCommittee','Administrator@PostAddProjectCommittee');

    Route::get('administrator/users/add/FacultyMember','Administrator@GetAddFacultyMember');
    Route::post('administrator/users/add/FacultyMember','Administrator@PostAddFacultyMember');


/////////////////////////////////////////////////////////////////////////////////////////////

    Route::get('administrator/users/import/student','Administrator@GetImportStudent');
    Route::post('administrator/users/import/studen','Administrator@PostImportStudent');

    Route::get('administrator/users/import/FacultyMember', 'Administrator@GetImportFacultyMember');
    Route::post('administrator/users/import/FacultyMember', 'Administrator@PostImportFacultyMember');


    /*  Reports  */

    Route::get('administrator/users/{id}/pdf','ReportsController@export_user_as_pdf');
    Route::get('administrator/users/print-excle-all-users', 'ReportsController@export_users_as_excle');


//});

/* GPCO */
Route::group(['middleware'=>['web','gpco']],function(){

    Route::get('home/GPCO','GpcoController@HomeGPCO');

    //Configuration 
    Route::get('home/GPCO','GpcoController@HomeGPCO');
    
    // Configuration
    Route::get('configuration/conditions','GpcoController@Conditions');
    Route::PATCH('configuration/conditions/{id}/update','GpcoController@UpdateConditions');

    Route::get('configuration/grades','GpcoController@Grades');
    Route::PATCH('configuration/grades/{id}/update','GpcoController@UpdateGrades');

    Route::get('appointments/deliveries','GpcoController@Deliveries');
    Route::post('appointments/deliveries','GpcoController@AddDeliveries');

   

    Route::get('students-data','GpcoController@PageIndexStudentData');
    Route::get('student-data/details/{id}','GpcoController@PageStudentDetails');
    Route::get('student-data/show/{AcdameicNumber}','GpcoController@StudentDataShow');

    Route::get('supervisors-data','GpcoController@PageIndexSupervisorsData');
    Route::get('supervisors-data/details/{id}','GpcoController@PageSupervisorDetails');
    Route::get('supervisors-data/show/{FunctionalNumber}','GpcoController@SupervisorsDataShow');

    //Route::resource('Proposal','ProposalController');
    Route::get('review/{id}','ProposalController@Review');
    Route::get('review/proposal/{id}/show','ProposalController@show');
    Route::get('review/proposal/{id}/edit','ProposalController@edit');
    Route::get('review/proposal/{id}/approval','ProposalController@Approval'); 
    Route::get('review/proposal/{id}/cancellation-accreditation','ProposalController@CancellationOfAccreditation'); 
    Route::get('review/proposal/{id}/destroy','ProposalController@destroy');

    Route::get('manage/groups','GpcoController@Page_Manage_Groups');
    Route::post('manage/groups','GpcoController@ProcedureType');
    Route::get('approval-as-project','GpcoController@IndexPage_Approval_As_Project');  
    Route::get('groups-choice-project/{id}','GpcoController@All_Groups_Choice_Project');
    Route::get('approval-as-primacy','GpcoController@IndexPage_Approval_As_Primacy');
    Route::get('details-group/{id}','GpcoController@Details_Groups_Primacy'); 
    Route::post('approval/project/{Id_Group}/{Id_Proposal}','GpcoController@Approval_Project_for_Group');
    Route::get('supervisor-distribution','GpcoController@Page_Distribution_Supervisor');
    Route::get('supervisor-distribution/{id}','GpcoController@DistributionSupervisor');
    Route::get('supervisor-distribution/{Id_Groups}/{Id_Supervisor}','GpcoController@Select_Supervisor_ForGroups');
    Route::post('supervisor-distribution/{Id_Groups}','GpcoController@Select_AntherSupervisor_ForGroups');
    Route::get('statistics-groups/{id}','GpcoController@StatisticsGroups');
    Route::get('statistics-groups/{id}/show','GpcoController@ShowGroups');

    Route::get('follow/groups','GpcoController@Page_Follow_Groups');
    Route::get('follow-up/boys/{id}','GpcoController@Follow_Up_Boys');
    Route::get('follow-up/grils/{id}','GpcoController@Follow_Up_Grils');

    Route::get('follow-up/group/{Type_Group}/{Id_Group}/meetings','GpcoController@Follow_Up_Group_Meetings');
    Route::get('follow-up/group/{Type_Group}/{Id_Group}/attendance','GpcoController@Follow_Up_Group_Attendance');
    Route::get('follow-up/group/{Type_Group}/{Id_Group}/deliveries','GpcoController@GPCOX');

    Route::get('GPCO/grades','GpcoController@StudentGrades');
    Route::get('GPCO/grades/{AcdameicNumber}/edit','GpcoController@EditGrades');
    Route::post('GPCO/grades/{AcdameicNumber}/add','GpcoController@AddGradesStudent');

    Route::PATCH('GPCO/grades/{AcdameicNumber}/update','GpcoController@UpdateGradesStuents');


   

   



    Route::get('GPCO/X','GpcoController@GPCOX');
});

/* Student */
Route::group(['middleware'=>['web','student']],function(){

    Route::get('home/student','StudentController@Home');
    // Proposals
    Route::get('student/my-proposals','StudentController@MyProposals');

    Route::get('student/create/proposals','StudentController@CreateProposals')->middleware('ETSP');
    Route::post('student/create/proposals','StudentController@StoreProposals');
    Route::get('student/selection/proposals','StudentController@SelectionProposals');    
    Route::get('student/proposals/{id}/details','StudentController@DetailsProposal');
    Route::get('student/proposals/{id}/edit','StudentController@EditProposal');
    Route::PATCH('student/proposals/{id}/update','StudentController@UpdateProposal');
    Route::post('student/proposals/{id}/delete','StudentController@DeleteProposal');
  
    Route::get('student/my-group','StudentController@MyGroup');
    Route::get('student/group','StudentController@Groups');
    Route::get('student/group/{id}/details','StudentController@DetailsGroup');
    Route::get('student/create/group','StudentController@PageCreateGroup')->middleware('ETCG');
    Route::post('student/create/group','StudentController@CreateGroup'); 
    Route::post('student/group/join/{id}','StudentController@JoinGroup');
    Route::get('student/group/log-out','StudentController@LogOutGroup');
    
    Route::post('student/add/wish/{id}','StudentController@AddWish')->middleware('ETAW');
    Route::get('student/delete/wish/{id}','StudentController@DeleteWish');
    Route::post('student/select/priority/{Id_WisheNumber}/{Id_Priority}/{Id_Group}','StudentController@SelectPriority');

    Route::get('student/meetings','StudentController@Meetings');
    Route::get('student/meeting/{id}/details','StudentController@MeetingDetails');

    Route::get('student/deliveries','StudentController@Deliveries');
    Route::get('student/deliveries/{id}/submit','StudentController@DeliveriesSubmit');
    Route::post('student/deliveries/{id}/submit','StudentController@DeliveriesUpload');
    //Route::get('student/deliveries/{id}/download','StudentController@DeliveriesDownload');

    Route::get(' student/attendance','StudentController@Attendance');
    Route::get(' student/grades','StudentController@Grades');
    
    
    Route::get('download/pdf','StudentController@PdfProposal');
    
    Route::get('student/x','StudentController@StudentX');

}); 

/* Faculty Member */
Route::group(['middleware'=>['web','facultyMember']],function(){
    
    Route::get('home/FacultyMember','FacultyMember@home');
    
    Route::get('Registration/FacultyMember','FacultyMember@pageRegistration');
    Route::post('Registration/FacultyMember','FacultyMember@NewRegistration');

    Route::get('create/proposal/FacultyMember','FacultyMember@PageProposal')->middleware('ETSP'); 
    Route::post('create/proposal/FacultyMember','FacultyMember@CreateProposal');


    Route::get('FacultyMember/proposal/show/{id}','FacultyMember@ShowProposal');
    Route::post('FN-proposal/{id}/delete','FacultyMember@DeleteProposal');

    Route::get('FN-Proposal/{id}/edit','FacultyMember@PageEditProposal');
    Route::PATCH('update/{id}/FN-Proposal','FacultyMember@UpdateProposal');
    Route::get('all-proposals','FacultyMember@Page_Proposal');  
    
    Route::get('FacultyMember/my-proposal','FacultyMember@IndexProposal');

    Route::get('FacultyMember/my-student/group','FacultyMember@IndexGroup');

    Route::get('FacultyMember/my-student/group/{id}','FacultyMember@ShowGroup');
    Route::get('FacultyMember/meetings','FacultyMember@Meetings');

    Route::get('FacultyMember/meeting/{id}/details','FacultyMember@MeetingDetails');
    Route::get('FacultyMember/meeting/{id}/show','FacultyMember@MeetingShow');


    Route::get('FacultyMember/meetings/create/{id}','FacultyMember@PageCreateMeetings');
    Route::post('FacultyMember/meetings/create/{id}/{NumberOfMeetingsNow}','FacultyMember@CreateMeetings');

    Route::get('FacultyMember/follow-up/group/{id}','FacultyMember@ShowFollowUpGroup');

    Route::get('student/grades','FacultyMember@StudentGrades')->middleware('IsTehReg');
    Route::get('student/grades/{id}','FacultyMember@ShowStudentGrades');

    Route::get('FacultyMember/deliveries','FacultyMember@Deliveries');
    Route::get('FacultyMember/deliveries/{id_group}','FacultyMember@DeliveriesGroup');
    Route::post('FacultyMember/deliveries/{id_deliver}/{num_statu}','FacultyMember@DeliverChangeStatu');


    Route::get('FacultyMember/grades','FacultyMember@StudentGrades');
    Route::post('FacultyMember/grades/{AcdameicNumber}/add','FacultyMember@AddStudentGrades');


   

  

    Route::get('FacultyMember/x','FacultyMember@X');
});

/*  Reports  */
Route::get('pdf/proposal/{id}','GpcoController@PDFProposal');
Route::get('ViewDetails/excel/all/students','ReportsController@ExcelAllStudents');
Route::get('ViewDetails/excel/all/supervisor','ReportsController@ExcelAllSupervisor');
Route::get(' MyStudent/group/{id}/pdf','ReportsController@MyStudentGroup');

/* New project project-committee */
    Route::get('project-committee/home','PojectCmmittee@Home');

    /* Configuration */
  
    Route::get('project-committee/configuration/constraint','PojectCmmittee@Constraint');
    Route::post('project-committee/configuration/constraint/under-supervisions','PojectCmmittee@AddUnderSupervisions');
    Route::get('project-committee/configuration/constraint/under-supervisions/{id}/delete','PojectCmmittee@DeleteUnderSupervisions');
    Route::PATCH('project-committee/configuration/constraint/{id}/update','PojectCmmittee@UpdateConstraint');

    Route::get('project-committee/configuration/grades','PojectCmmittee@Grades');
    Route::PATCH('project-committee/configuration/grades/{id}/update','PojectCmmittee@UpdateGrades');

    Route::get('project-committee/calendar','PojectCmmittee@CalendarIndex');
    Route::post('project-committee/calendar','PojectCmmittee@CalendarIndex');

    Route::get('project-committee/calendar/create','PojectCmmittee@CalendarCreate');
    Route::post('project-committee/calendar/create','PojectCmmittee@CalendarStore');

    Route::get('project-committee/calendar/{id}/show','PojectCmmittee@CalendarShow');
    Route::get('project-committee/calendar/{id}/edit','PojectCmmittee@CalendarEdit');
    Route::PATCH('project-committee/calendar/{id}/update','PojectCmmittee@CalendarUpdate');
    Route::get('project-committee/calendar/{id}/delete','PojectCmmittee@CalendarDelete');
   
    Route::get('project-committee/calendar/appointments/create','PojectCmmittee@AppointmentsCreate');
    Route::post('project-committee/calendar/appointments/create','PojectCmmittee@AppointmentsStore');

    Route::get('project-committee/appointments/{id}/edit','PojectCmmittee@AppointmentsEdit');
    Route::PATCH('project-committee/appointments/{id}/update','PojectCmmittee@AppointmentsUpdate');
    Route::get('project-committee/appointments/{id}/delete','PojectCmmittee@AppointmentsDelete');


    Route::get('project-committee/proposal','PojectCmmittee@ProposalIndex');
    Route::post('project-committee/proposal','PojectCmmittee@ProposalIndex');

    Route::get('project-committee/proposal/create','PojectCmmittee@ProposalCreate');
    Route::post('project-committee/proposal/create','PojectCmmittee@ProposalStore');

    Route::get('project-committee/proposal/{id}/{filter}','PojectCmmittee@ProposalFilter');

    Route::get('project-committee/proposal/{id}','PojectCmmittee@ProposalShow');
    Route::get('projectCommittee/proposal/{id}/edit','PojectCmmittee@ProposalEdit');
    Route::get('projectCommittee/proposal/{id}/approval','PojectCmmittee@ProposalApproval');
    Route::get('projectCommittee/proposal/{id}/cancellation-accreditation','PojectCmmittee@ProposalCancellationOfAccreditation');
 
    Route::get('project/committee/proposal/{id}/delete','PojectCmmittee@ProposalDelete');
    Route::PATCH('project/committee/proposal/{id}/update','PojectCmmittee@ProposaUpdate');

    Route::get('project-committee/approval-projects','PojectCmmittee@ApprovalProjects');
    Route::post('project-committee/add/supervisor/{id}','PojectCmmittee@AddSupervisor');


    Route::get('project-committee/approval-projects/bydate/{id}','PojectCmmittee@ApprovalProjectsAsDate');
    Route::post('project-committee/approval-projects/bydate/{id}/submit','PojectCmmittee@ApprovalProjectsAsDatesubmit');
    Route::get('project-committee/approval-projects/delete/supervisor/{supervisor}/{proposal}','PojectCmmittee@DeleteSupervisor');
    Route::get('project-committee/approval-projects2','PojectCmmittee@ApprovalProjects2');

    Route::get('project-committee/approval-projects2/{group}','PojectCmmittee@ApprovalProjectsAsPriority');

    Route::get('project-committee/approval-projects2/asprioirty/{group}/{proposal}','PojectCmmittee@Getsuper');
    Route::post('project-committee/approval-projects2/asprioirty/{group}/{proposal}','PojectCmmittee@ApprovalProjectsAsPrioirty');

    Route::get('project-committee/approval-projects3','PojectCmmittee@ApprovalAll');
    Route::post('project-committee/approval-projects3','PojectCmmittee@ApprovalFinel');

    Route::get('project-committee/groups','PojectCmmittee@GetIndexGroups');
    Route::post('project-committee/groups','PojectCmmittee@GetIndexGroups');
    Route::get('project-committee/groups/{id}','PojectCmmittee@GetIndexGroups');

    Route::get('project-committee/groups/{id}/show','PojectCmmittee@GetShowGroup');
    Route::get('project-committee/group/create','PojectCmmittee@GetCreateGroup');
    
    Route::get('project-committee/follow','PojectCmmittee@GetIndexFollow');
    Route::post('project-committee/follow','PojectCmmittee@GetIndexFollow');

    Route::get('project-committee/data/students', 'PojectCmmittee@Students_data');
    Route::post('project-committee/data/students', 'PojectCmmittee@Students_data');

    Route::get('project-committee/data/supervisors', 'PojectCmmittee@Supervisors_data');
    Route::post('project-committee/data/supervisors', 'PojectCmmittee@Supervisors_data');

    Route::get('project-committee/reports', 'PojectCmmittee@Reports');




    /*  Reports  */
    Route::get('project-committee/data/students/excle', 'ReportsController@export_students_as_excle');
    Route::get('project-committee/data/student/pdf/{id}', 'ReportsController@export_user_as_pdf');

    Route::get('project-committee/data/supervisors/excle', 'ReportsController@export_supervisors_as_excle');
    Route::get('project-committee/data/supervisors/pdf/{id}', 'ReportsController@export_user_as_pdf');
    
    


    







    
/* end */

    
    
    
    
   

   
 
   
