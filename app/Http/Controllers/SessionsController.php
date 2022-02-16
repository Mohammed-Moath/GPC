<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SessionsController extends Controller
{
  public function create()// Page login
  {
    return view('Register.login');
  }

  public function store(Request $request)// login
  { 
    $this->validate($request,
      ['username'=>'required',
          'password' => 'required',
      ],
      ['username.required'=>"يجب أدخال اسم المستخدم",
          'password.required'=>"يجب أدخال كلمة السر",
    ]);//Validate
    try{
      $username = User::where('username',$request->username)->first();
      if($username == null){
        session()->push('m','error');
        session()->push('m','اسم المستخدم غير متواجد في قاعدة بيانات GPC !! الرجاء مراجع لجنة المشاريع .');
        return redirect()->back();
      }
      else{
        //auth()->login($username);
        if(!auth()->attempt(request(['username','password']))) {
          return back()->withErrors([
            'massage'=>'يبدو أن هناك خطأ في كلمة السر أو اسم المستخدم !! الرجاء التحقق من مدخلاتك . ']);
        }
        elseif(auth()->user()->Roles === 1){
          return redirect('administrator/home');
        }
        elseif(auth()->user()->Roles === 2){
          return redirect('home/GPCO');
        }
        elseif(auth()->user()->Roles === 3){
          return redirect('home/student');
        }
        elseif(auth()->user()->Roles === 4){
          return redirect('home/FacultyMember');
        }    
      }
      return redirect('/');

    }
    catch (\Exception $e) {
      return redirect('error')->withFlashMessage("{$e->getMessage()}, هذا الخطأ متواجد في SessionsController ، في الداله store.  "); 
  }
   
    
  }

  public function destroy()// logout
  {
    auth()->logout();
    return redirect('/');
  }

}
