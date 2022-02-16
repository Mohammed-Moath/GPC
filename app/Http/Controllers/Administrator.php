<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\User;
use App\ProjectStudent;
use App\ProjectSupervisor;

class Administrator extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    Public function GetHome(){
        try{
            return view('layouts.Home.Administrator');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetHome."); 
        }
    }
    Public function GetPublicIndex(){// Call page Public index
        try{
            return view('Administrator.Configuration.Public.index');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetPublicIndex."); 
        }
    }
    Public function GetDataIndex(){// Call page Public index
        try{
            return view('Administrator.Configuration.Data.index');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetDataIndex."); 
        }
    }
    Public function index_users(){
        try{
            $users = User::orderBy('id','desc')->paginate(20);
            return view('Administrator.Users.index',compact('users'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetUsersIndex."); 
        }
    }
    Public function add_user(Request $request){
        try{
            if($request->group_user >0 && $request->group_user <= 5){
                $user_role = $request->group_user;
                if($user_role == 1){
                    $user_role_name = "مدير النظام";
                }
                if ($user_role == 2) {
                    $user_role_name = "ممثل لجنة المشاريع ";
                }
                if ($user_role == 3) {
                    $user_role_name = "طالب";
                }
                if ($user_role == 4) {
                    $user_role_name = "عضو هيئة التدريس";
                }
                if ($user_role == 5) {
                    $user_role_name = "زائر";
                }
                return view('Administrator.Users.add_user', compact('user_role', 'user_role_name'));
            }
            session()->push('m', 'warning');
            session()->push('m', 'خطأ في التوجيه redirect error');
            return redirect()->back(); 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetUserGroups."); 
        }
    }
    public function user_save(Request $request,$user_role){
        try {
            if ($user_role > 0 && $user_role <= 5) {

                if($user_role == 3){
                    $this->validate(
                        $request,
                        [
                            'AcdameicNumber' => 'required|numeric|unique:project_students|unique:users,username|digits_between:5,20',
                            'password' => 'required|numeric|digits_between:5,50',
                            'Name' => 'required|max:99|min:2',
                            'Gender' => 'required',
                            'Program' => 'required',
                            'Branch' => 'required',
                            'IsActive' => 'required',
                            'HoursCompleted' => 'required|numeric|digits_between:2,3|max:140|min:70',
                            'Email' => 'required|unique:users',
                            'PhoneNumber' => 'required|unique:users|numeric|digits_between:7,15'
                        ],
                        [
                            'required' => 'مطلوب أضافة بيانات.',
                            'AcdameicNumber.numeric' => 'هذا الحقل يجب ان تكون قيمة بالارقام فقط !',
                            'AcdameicNumber.unique' => 'الرقم الاكاديمي الذي ادخلته موجود مسبقاٌ!',
                            'AcdameicNumber.digits_between' => 'الرقم الاكاديمي للطالب يجب ان يكون بين 5 ارقام و 20 رقماُ.',
                            'password.numeric' => 'هذا الحقل يجب ان يدخل قيمته بالارقام فقط.',
                            'password.digits_between' => 'رقم المعرف الشخصي يجب أن تكون قيمته ما بين 5 الى 50 رقماَ.',
                            'Name.max' => 'اقصي حروف لاسم الطالب 99 حرف!',
                            'Name.min' => 'اقل احرف لاسم الطالب 2 حروف !',
                            'HoursCompleted.digits_between' => 'يجب أن لا تتعدا خانة المئات',
                            'HoursCompleted.max' => 'اقصي قيمة لعدد الساعات يمكن ادخالها هي 140',
                            'HoursCompleted.min' => 'اقل قيمة لعدد الساعات يمكن ادخالها هي 70',
                            'Email.unique' => 'الايميل الذي ادخلته موجود مسبقأ!',
                            'PhoneNumber.unique' => 'هذا الرقم قد تم أضافته من قبل ',
                            'PhoneNumber.numeric' => 'رقم الهاتف يجب ان يكون ارقام فقط.',
                            'PhoneNumber.digits_between' => 'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
                        ]
                    );
                }
                if($user_role == 4){
                   
                    $this->validate(
                        $request,
                        [
                            'FunctionalNumber' => 'required|numeric|unique:project_supervisors|unique:users,username|digits_between:5,20',
                            'password' => 'required|numeric|digits_between:5,50',
                            'Name' => 'required|max:99|min:2',
                            'username' => 'required|unique:users',
                            'Gender' => 'required',
                            'IsActive' => 'required',
                            'Email' => 'required|unique:users',
                            'PhoneNumber' => 'required|unique:users|numeric|digits_between:7,15'
                        ],
                        [
                            'required' => 'هذا الحقل اجباري',
                            'FunctionalNumber.numeric' => 'هذا الحقل يجب ان تكون قيمة بالارقام فقط !',
                            'FunctionalNumber.unique' => 'الرقم الوظيفي الذي ادخلته موجود مسبقاٌ!',
                            'FunctionalNumber.digits_between' => 'الرقم الوظيفي  يجب ان يكون بين 5 ارقام و 20 رقماُ.',
                            'password.numeric' => 'هذا الحقل يجب ان يدخل قيمته بالارقام فقط.',
                            'password.digits_between' => 'رقم المعرف الشخصي يجب أن تكون قيمته ما بين 5 الى 50 رقماَ.',
                            'Name.max' => 'اقصي حروف لاسم عضو هيئة التدريس 99 حرف!',
                            'Name.min' => 'اقل احرف لاسم عضو هيئة التدريس 2 حروف !',
                            'Email.unique' => 'الايميل الذي ادخلته موجود مسبقأ!',
                            'PhoneNumber.unique' => 'هذا الرقم قد تم أضافته من قبل ',
                            'PhoneNumber.numeric' => 'رقم الهاتف يجب ان يكون ارقام فقط.',
                            'PhoneNumber.digits_between' => 'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
                        ]
                    );
                }
                $this->validate(
                    $request,
                    [
                        'Name' => 'required|max:99|min:2',
                        'Gender' => 'required',
                        'username' => 'required|unique:users',
                        'password' => 'required',
                        'Email' => 'required|unique:users',
                        'PhoneNumber' => 'required|unique:users|numeric|digits_between:7,15',
                        'IsActive' => 'required',
                    ],
                    [

                        'required' => 'مطلوب أضافة بيانات',
                        'Name.max' => 'اقصي حروف يمكنك ادخالها  99 حرف!',
                        'Name.min' => 'اقل احرف يمكنك ادخالها  2 حروف !',
                        'Email.unique' => 'الايميل الذي ادخلته موجود مسبقأ!',
                        'PhoneNumber.unique' => 'هذا الرقم قد تم أضافته من قبل ',
                        'PhoneNumber.numeric' => 'رقم الهاتف يجب ان يكون ارقام فقط.',
                        'PhoneNumber.digits_between' => 'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
                    ]
                );
                 
               
            
                
                $new_user =  new User;
                $new_user->Name = $request->Name;
                $new_user->username = $request->username;
                $new_user->Gender = $request->Gender;
                $new_user->password = bcrypt($request->password);
                $new_user->PhoneNumber = $request->PhoneNumber;
                $new_user->Email = $request->Email;
                $new_user->PresonalPicture = 'uploads\user.png';
                $new_user->Roles = $user_role;
                $new_user->IsActive = $request->IsActive;
                $new_user->save();

                if($user_role == 3){
                    $AN = new ProjectStudent;
                    $AN->AcdameicNumber = $request->AcdameicNumber;
                    $AN->HoursCompleted = $request->HoursCompleted;
                    $AN->programs_id = $request->Program;
                    $AN->branches_id = $request->Branch;
                    $AN->Complete_FeldTraining = $request->Training;
                    $AN->users_id = $new_user->id;
                    $AN->save();
                }
                if($user_role == 4){
                    $FN = new ProjectSupervisor;
                    $FN->FunctionalNumber = $request->FunctionalNumber;
                    $FN->scientific_degrees_id = $request->scientific_degrees_id;
                    $FN->programs_id = $request->Program;
                    $FN->users_id = $new_user->id;
                    $FN->save();
                }

                session()->push('m', 'success');
                session()->push('m', 'تم أضافة البيانات بنجاح');
                return redirect('administrator/users'); 
             
            }

  
            session()->push('m', 'warning');
            session()->push('m', 'خطأ في مجموعة المتخدم users group');
            return redirect()->back(); 
        } catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة user_save.");
        }
    }
    Public function GetUsersShow($id){
        try{
            $user = User::findOrfail($id);
            return view('Administrator.Users.show',compact('user'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetUsersShow."); 
        }
    }
    Public function PostAddStudent(Request $request){
        $this->validate($request,
            [
                'AcdameicNumber'=>'required|numeric|unique:project_students|unique:users,username|digits_between:5,20',
                'IDNumber'=>'required|numeric|digits_between:5,50',
                'Name'=>'required|max:99|min:2',
                'Gender'=>'required',
                'Program'=>'required',
                'Branch'=>'required',
                'IsActive'=>'required',
                'HoursCompleted'=>'required|numeric|digits_between:2,3|max:140|min:70',
                'Email'=>'required|unique:users',
                'PhoneNumber'=>'required|unique:users|numeric|digits_between:7,15'
            ],
            [   'required'=>'مطلوب أضافة بيانات.',
                'AcdameicNumber.numeric'=>'هذا الحقل يجب ان تكون قيمة بالارقام فقط !',
                'AcdameicNumber.unique'=>'الرقم الاكاديمي الذي ادخلته موجود مسبقاٌ!',
                'AcdameicNumber.digits_between'=>'الرقم الاكاديمي للطالب يجب ان يكون بين 5 ارقام و 20 رقماُ.',
                'IDNumber.numeric'=>'هذا الحقل يجب ان يدخل قيمته بالارقام فقط.',
                'IDNumber.digits_between'=>'رقم المعرف الشخصي يجب أن تكون قيمته ما بين 5 الى 50 رقماَ.',
                'Name.max'=>'اقصي حروف لاسم الطالب 99 حرف!',
                'Name.min'=>'اقل احرف لاسم الطالب 2 حروف !',
                'HoursCompleted.digits_between'=>'يجب أن لا تتعدا خانة المئات',
                'HoursCompleted.max'=>'اقصي قيمة لعدد الساعات يمكن ادخالها هي 140',
                'HoursCompleted.min'=>'اقل قيمة لعدد الساعات يمكن ادخالها هي 70',
                'Email.unique'=>'الايميل الذي ادخلته موجود مسبقأ!',
                'PhoneNumber.unique'=>'هذا الرقم قد تم أضافته من قبل ',
                'PhoneNumber.numeric'=>'رقم الهاتف يجب ان يكون ارقام فقط.',
                'PhoneNumber.digits_between'=>'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
            ]
        );
        try{
            $NewUser = new User;
            $NewUser->Name = $request->Name;
            $NewUser->username= $request->AcdameicNumber;
            $NewUser->Gender = $request->Gender;
            $NewUser->password = bcrypt($request->IDNumber);
            $NewUser->PhoneNumber = $request->PhoneNumber;
            $NewUser->Email = $request->Email;
            $NewUser->PresonalPicture = 'uploads\user.png';
            $NewUser->Roles = "3";
            $NewUser->IsActive = $request->IsActive;
            $NewUser->save();

            $AN = new ProjectStudent; 
            $AN->AcdameicNumber = $request->AcdameicNumber;
            $AN->HoursCompleted = $request->HoursCompleted;
            $AN->programs_id = $request->Program;
            $AN->branches_id = $request->Branch; 
            $AN->Complete_FeldTraining = $request->Training; 
            $AN->users_id = $NewUser->id;
            $AN->save();

            session()->push('m','success');
            session()->push('m','تم أضافة بيانات الطالب بنجاح');   
            return redirect()->back(); 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة AddStudent."); 
        }
    }
    Public function PostAddManger(Request $request){
        $this->validate($request,
            [
                'Name'=>'required|max:99|min:2',
                'Gender'=>'required',
                'username'=>'required|unique:users',
                'password'=>'required',
                'Email'=>'required|unique:users',
                'PhoneNumber'=>'required|unique:users|numeric|digits_between:7,15',
                'IsActive'=>'required',
            ],
            [  
               
                'required'=>'مطلوب أضافة بيانات',
                'Name.max'=>'اقصي حروف يمكنك ادخالها  99 حرف!',
                'Name.min'=>'اقل احرف يمكنك ادخالها  2 حروف !',
                'Email.unique'=>'الايميل الذي ادخلته موجود مسبقأ!',
                'PhoneNumber.unique'=>'هذا الرقم قد تم أضافته من قبل ',
                'PhoneNumber.numeric'=>'رقم الهاتف يجب ان يكون ارقام فقط.',
                'PhoneNumber.digits_between'=>'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
            ]
        );
        try{
           
            //create user
            $New_User =  new User;
            $New_User->Name = $request->Name;
            $New_User->username = $request->username;
            $New_User->Gender = $request->Gender;
            $New_User->password = bcrypt($request->password);
            $New_User->PhoneNumber = $request->PhoneNumber;
            $New_User->Email = $request->Email;
            $New_User->PresonalPicture = 'uploads\user.png';
            $New_User->Roles ='1';
            $New_User->IsActive =$request->IsActive; 
            $New_User->save();
    
            session()->push('m','success');
            session()->push('m','تم أضافة البيانات بنجاح');   
            return redirect()->back(); 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة PostAddManger."); 
        }
    }
    Public function PostAddProjectCommittee(Request $request){
        $this->validate($request,
            [
                'Name'=>'required|max:99|min:2',
                'Gender'=>'required',
                'username'=>'required|unique:users',
                'password'=>'required',
                'Email'=>'required|unique:users',
                'PhoneNumber'=>'required|unique:users|numeric|digits_between:7,15',
                'IsActive'=>'required',
            ],
            [  
               
                'required'=>'مطلوب أضافة بيانات',
                'Name.max'=>'اقصي حروف يمكنك ادخالها  99 حرف!',
                'Name.min'=>'اقل احرف يمكنك ادخالها  2 حروف !',
                'Email.unique'=>'الايميل الذي ادخلته موجود مسبقأ!',
                'PhoneNumber.unique'=>'هذا الرقم قد تم أضافته من قبل ',
                'PhoneNumber.numeric'=>'رقم الهاتف يجب ان يكون ارقام فقط.',
                'PhoneNumber.digits_between'=>'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
            ]
        );
        try{
           
            //create user
            $New_User =  new User;
            $New_User->Name = $request->Name;
            $New_User->username = $request->username;
            $New_User->Gender = $request->Gender;
            $New_User->password = bcrypt($request->password);
            $New_User->PhoneNumber = $request->PhoneNumber;
            $New_User->Email = $request->Email;
            $New_User->PresonalPicture = 'uploads\user.png';
            $New_User->Roles ='2';
            $New_User->IsActive =$request->IsActive; 
            $New_User->save();
    
            session()->push('m','success');
            session()->push('m','تم أضافة البيانات بنجاح');   
            return redirect()->back(); 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة PostAddProjectCommittee."); 
        }
    }
    Public function PostAddFacultyMember(Request $request){
        $this->validate($request,
            [
                'FunctionalNumber'=>'required|numeric|unique:project_supervisors|unique:users,username|digits_between:5,20',
                'IDNumber'=>'required|numeric|digits_between:5,50',
                'Name'=>'required|max:99|min:2',
                'Gender'=>'required',
                'scientific_degrees_id'=>'required',
                'IsActive'=>'required',
                'Email'=>'required|unique:users',
                'PhoneNumber'=>'required|unique:users|numeric|digits_between:7,15'
            ],
            [ 
                'required'=>'هذا الحقل اجباري',
                'FunctionalNumber.numeric'=>'هذا الحقل يجب ان تكون قيمة بالارقام فقط !',
                'FunctionalNumber.unique'=>'الرقم الوظيفي الذي ادخلته موجود مسبقاٌ!',
                'FunctionalNumber.digits_between'=>'الرقم الوظيفي  يجب ان يكون بين 5 ارقام و 20 رقماُ.',
                'IDNumber.numeric'=>'هذا الحقل يجب ان يدخل قيمته بالارقام فقط.',
                'IDNumber.digits_between'=>'رقم المعرف الشخصي يجب أن تكون قيمته ما بين 5 الى 50 رقماَ.',
                'Name.max'=>'اقصي حروف لاسم عضو هيئة التدريس 99 حرف!',
                'Name.min'=>'اقل احرف لاسم عضو هيئة التدريس 2 حروف !',
                'Email.unique'=>'الايميل الذي ادخلته موجود مسبقأ!',
                'PhoneNumber.unique'=>'هذا الرقم قد تم أضافته من قبل ',
                'PhoneNumber.numeric'=>'رقم الهاتف يجب ان يكون ارقام فقط.',
                'PhoneNumber.digits_between'=>'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
            ]
        );

        try{
            $NewUser = new User;
            $NewUser->Name = $request->Name;
            $NewUser->username = $request->FunctionalNumber;
            $NewUser->Gender = $request->Gender;
            $NewUser->password = bcrypt($request->IDNumber);
            $NewUser->PhoneNumber = $request->PhoneNumber;
            $NewUser->Email = $request->Email;
            $NewUser->PresonalPicture = 'uploads\user.png';
            $NewUser->Roles = "4";
            $NewUser->IsActive = $request->IsActive;
            $NewUser->save();

            $FN = new ProjectSupervisor; 
            $FN->FunctionalNumber = $request->FunctionalNumber;
            $FN->scientific_degrees_id = $request->scientific_degrees_id;
            $FN->programs_id = $request->Program; 
            $FN->users_id = $NewUser->id;
            $FN->save();
            session()->push('m','success');
            session()->push('m','تم أضافة بيانات عضو هيئة التدريس بنجاح');   
            return redirect()->back();

        }

        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة PostAddFacultyMember."); 
        }
    }
    Public function GetImportStudent(){
        try{
            return view('Administrator.Users.ImportStudent');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetImportStudent."); 
        }
    }
    Public function GetImportFacultyMember(){
        try {
            return view('Administrator.Users.ImportFacultyMember');
          //  return view('Administrator.Users.ImportStudent');
        } 
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetImportFacultyMember.");
        }
    }
    Public function PostImportStudent(Request $request){
        $this->validate($request,[
            'import_file'=>'required',
            'Branch'=>'required',
        ]);
        try{
           

            if($request->Branch == 1){
                $Gender = 'ذكر';
            }
            elseif($request->Branch == 2){
                $Gender = 'انثي'; 
            }
            if(Input::hasFile('import_file'))
            {
                $file = Input::file('import_file');
                $path = $file->getClientOriginalName();
                $file->move('uploads',$path);
                $data = Excel::load('uploads/'.$path, function($reader) 
                {
                    $reader->all();
                })->get();
                
                if(!empty($data) && $data->count())
                {
                    foreach ($data as $key => $value) 
                    {   
                        if($value->acdameicnumber != null){
                            $num = $value->acdameicnumber;
                            $int_ac = (int)$num;                    
                            $findUser = User::where('username',$value->acdameicnumber)->first();            
                            $findStudent = ProjectStudent::where('AcdameicNumber',$int_ac)->first();
                            if(count($findUser) == 0 && count($findStudent) == 0 && $value->studentname !=null){  
                                $NewUser = new User;
                                $NewUser->Name = $value->studentname;
                                $NewUser->username = $value->acdameicnumber;
                                $NewUser->Gender = $Gender;
                                $NewUser->password = bcrypt($value->id);
                                $NewUser->PresonalPicture = 'uploads\user.png';
                                $NewUser->Roles = "3";
                                $NewUser->IsActive = "1";
                                $NewUser->save();
                                $AN = new ProjectStudent; 
                                $AN->AcdameicNumber = $value->acdameicnumber;
                                $AN->HoursCompleted = $value->number_hourscompleted;
                                $AN->programs_id = $value->programs;
                                $AN->branches_id = $request->Branch; 
                                $AN->users_id = $NewUser->id;
                                $AN->save();   
                            }
                            // elseif(count($findUser) != 0 || count($findStudent) != 0){
                                
                            //     if(count($findUser) !=0) {
                            //         $findUser->delete();
                            //         //$findUser->ProjectStudent()->delete();
                            //     }
                            //     //dd($value->acdameicnumber);
                            //     if(count($findStudent) != 0){$findStudent->delete();}
                                
                            //     $NewUser = new User;
                            //     $NewUser->Name = $value->studentname;
                            //     $NewUser->username = $value->acdameicnumber;
                            //     $NewUser->Gender = $Gender;
                            //     $NewUser->password = bcrypt($value->id);
                            //     $NewUser->PresonalPicture = 'uploads\user.png';
                            //     $NewUser->Roles = "3";
                            //     $NewUser->IsActive = "1";
                            //     $NewUser->save();
                            //     $AN = new ProjectStudent; 
                            //     $AN->AcdameicNumber = $value->acdameicnumber;
                            //     $AN->HoursCompleted = $value->number_hourscompleted;
                            //     $AN->programs_id = $value->programs;
                            //     $AN->branches_id = $request->Branch;  
                            //     $AN->users_id = $NewUser->id;
                            //     $AN->save();
                            // }
                            
                        }

                        // else{
                        //     session()->push('m', 'error');
                        //     session()->push('m','خطأ بالملف');   
                        //      return redirect()->back();

                        // }
                        // elseif($value->acdameicnumber == null && $value->studentname !=null || $value->acdameicnumber == null && $value->studentname == null){
                        //     //$conter= ++$value->acdameicnumber;
                        //     // dd("هلا شباب نحن في "); 
                        //     // dd($value->acdameicnumber);
                        //     // session()->push('m','error');
                        //     // session()->push('m','يوجد حقل أكاديمي فارغ في الملف ، حال دون اكمال عملية الاستيراد');   
                        //     // return redirect()->back();
                        // }    
                    }
                    session()->push('m', 'success');
                    session()->push('m', 'تمت عملية الإستيراد بنجاح');
                    return redirect('administrator/users');
                }
                //DB::table('students')->insert($insert);
                //s $New_Users = DB::table('users')->insert($InsertUser);
                //
                
            }
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة PostImportStudent."); 
        }
    }
    public function PostImportFacultyMember(Request $request){
        try {
            $this->validate($request, ['import_file' => 'required',]);
            if (Input::hasFile('import_file')) {
                $file = Input::file('import_file');
                $path = $file->getClientOriginalName();
                $file->move('uploads', $path);
                $data = Excel::load('uploads/' . $path, function ($reader) {
                    $reader->all();
                })->get();        
                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {              
                        $num = $value->functionalnumber;
                        $int_fn = (int)$num;
                        if($value->functionalnumber !=null){
                            $findUser = User::where('username', $value->functionalnumber)->first();
                            $findfunctionalnmber = ProjectSupervisor::where('FunctionalNumber', $int_fn)->first();
                            if (count($findUser) == 0 && count($findfunctionalnmber) == 0 && $value->name !=null ) {
                                $NewUser = new User;
                                $NewUser->Name = $value->name;
                                $NewUser->username = $value->functionalnumber;
                                $NewUser->Gender = $value->gender;
                                $NewUser->password = bcrypt($value->functionalnumber);
                                $NewUser->PresonalPicture = 'uploads\user.png';
                                $NewUser->Roles = "4";
                                $NewUser->IsActive = "1";
                                $NewUser->save();
                                $FN = new ProjectSupervisor;
                                $FN->FunctionalNumber = $value->functionalnumber;
                                $FN->users_id = $NewUser->id;
                                // $FN->HoursOfService = $value->number_hourscompleted;
                                // // $FN->programs_id = $value->programs;
                                // // $FN->StatuSupervision = $value->StatuSupervision;
                                $FN->save();
                            }  
                        } 
                        // else {
                        //     session()->push('m', 'error');
                        //     session()->push('m', 'خطأ بالملف');
                        //     return redirect()->back();
                        // }
                    }
                    session()->push('m', 'success');
                    session()->push('m', 'تمت عملية الإستيراد بنجاح');
                    return redirect('administrator/users');
                }
                
            }                 
        } catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة PostImportFacultyMember.");
        }
    }
    Public function GetUsersEdit($id){// Call page Edit
        try{
            $user = User::findOrfail($id);
            return view('Administrator.Users.edit',compact('user'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة GetUsersEdit."); 
        }
    }
    Public function UpdateUser(Request $request ,$id){// Upadate User
        try{
            
            $input = $request->all();
            if(isset($input['password'])){
                $pass = $input['password'];
                $input['password'] =bcrypt($pass); 
            }
     
            User::findOrfail($id)->update($input);
            session()->push('m','success');
            session()->push('m','تم تعديل بيانات المستخدم بنجاح.');
            return redirect()->back(); 
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}هذا الخطأ متواجد في الكنترول الخاص بأدارة النظام 'Administrator' في الدالة UpdateUser."); 
        }
    }
    public function destroy($id){
        try {
            $user = User::findOrfail($id)->delete();
            session()->push('m', 'success');
            session()->push('m', 'تم حذف بيانات المستخدم بنجاح.');
            return redirect('administrator/users');
        } catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بالمستخدمين UserController، في الداله destroy.  ");
        }
    }   
}
