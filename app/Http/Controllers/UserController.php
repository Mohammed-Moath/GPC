<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request,
            [
                'Name'=>'required|max:99|min:2',
                'Gender'=>'required',
                'username'=>'required|unique:users',
                'password'=>'required',
                'Email'=>'required|unique:users',
                'PhoneNumber'=>'required|unique:users|numeric|digits_between:7,15',
                'user_roles_id'=>'required',
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
            $New_User->Roles =$request->user_roles_id; 
            $New_User->IsActive =$request->IsActive; 
            $New_User->save();
    
            session()->push('m','success');
            session()->push('m','تم تسجيل المستخدم بنجاح.');
            $user = $New_User; 
            return view('admin.users.details',compact('user'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بالمستخدمين UserController، في الداله store.  "); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::findOrfail($id);
            return view('admin.users.details',compact('user'));
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بالمستخدمين UserController، في الداله show.  "); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $user = User::findOrfail($id);
            return view('admin.users.edit',compact('user'));
        }
        
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بالمستخدمين UserController، في الداله edit.  "); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       try{
            $userOld = User::findOrfail($id);
            $input = $request->all();
            $pass = $input['password'];
            if(isset($pass)){
                $input['password'] =bcrypt($pass); 
            }
            else{
                $input['password'] =bcrypt($userOld->password); 
            }
            $userUpdate = User::findOrfail($id)->update($input);
            session()->push('m','success');
            session()->push('m','تم تعديل بيانات المستخدم بنجاح.');
            $user = User::findOrfail($id);
            return view('admin.users.details',compact('user'));
       }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بالمستخدمين UserController، في الداله update.  "); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::findOrfail($id)->delete();
            session()->push('m','success');
             session()->push('m','تم حذف بيانات المستخدم بنجاح.');
            return redirect('users');
        }
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بالمستخدمين UserController، في الداله destroy.  "); 
        }
    }

    public function UserShow(){

        try{
            $user = User::paginate(5);  
            return view('admin.users.show',compact('user'));
        }
         
        catch (\Exception $e) {
            return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في الكنترول الخاص بالمستخدمين UserController، في الداله UserShow.  "); 
        }
    }
}
