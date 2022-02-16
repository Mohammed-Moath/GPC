<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class add_students extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
      'First_Name'=>'required|string|min:2|max:20',
      'Second_Name'=>'required|string|min:2|max:20',
      'Third_Name'=>'required|string|min:2|max:20',
      'list_Name'=>'required|string|min:2|max:20',
      'gender'=>'required',
      'PhoneNumber'=>'required|min:9|max:11|',
      'email'=>'required|email|min:2|max:150|unique:users',
      'UserName'=>'required|string|min:5|max:50|unique:users',
      'Password'=>'required|string|min:4|max:250'];   

        /*          
        $this->validate($request,
        [ 'FirstName'=>'required|string|max:20|min:2',
         'SecondName'=>'required|string|max:20|min:2',
         'TirdName'=>'required|string|max:20|min:2',
        'NickName'=>'required|string|max:20|min:2',
         'Gender'=>'required',
         'PhoneNumber'=>'required|string|max:11',
         'Email' => 'required|string|Email|max:150|unique:users',
          'username' => 'required|string|max:50|unique:users',
         'password' => 'required|string|min:6',
        ]

       /* [   'FirstName.required'=>"حقل أسمك مطلوب",
            'FirstName.max'=>"لا يسمح لك بأدخال أكثر من 20 حرفاُ في هذا الحقل ",
            'FirstName.min'=>"لا يسمح لك بأدخال أقل من 2 حروف في هذا الحقل ",

            'SecondName.required'=>"هذا الحقل مطلوب",
            'SecondName.max'=>"يبغي ان لا يكون حقل اضافة الرقم الاكاديمي فارغاً ،لكي تستطيع ان تواصل",
            'SecondName.min'=>"لا يسمح لك بأدخال أقل من 2 حروف في هذا الحقل",

            'TirdName.required'=>"حقل أسمك مطلوب",
            'TirdName.max'=>"لا يسمح لك بأدخال أكثر من 20 حرفاُ في هذا الحقل ",
            'TirdName.min'=>"لا يسمح لك بأدخال أقل من 2 حروف في هذا الحقل ",

            'NickName.required'=>"حقل أسمك مطلوب",
            'NickName.max'=>"لا يسمح لك بأدخال أكثر من 20 حرفاُ في هذا الحقل ",
            'NickName.min'=>"لا يسمح لك بأدخال أقل من 2 حروف في هذا الحقل ",

            'Gender.required'=>"حقل أسمك مطلوب",

            'PhoneNumber.required'=>"حقل أسمك مطلوب",
            'PhoneNumber.max'=>"لا يسمح لك بأدخال أكثر من 20 حرفاُ في هذا الحقل ",
            'PhoneNumber.min'=>"لا يسمح لك بأدخال أقل من 2 حروف في هذا الحقل ",

            'Email.required'=>"حقل أسمك مطلوب",
            'Email.max'=>"لا يسمح لك بأدخال أكثر من 20 حرفاُ في هذا الحقل ",
            'Email.unique'=>"الإيميل الذي ادخلته موجود فعلاُ، يرجى ادخال بريد الكترونية غير قابل للتكرار ",

            'username.required'=>"حقل أسمك مطلوب",
            'username.max'=>"لا يسمح لك بأدخال أكثر من 20 حرفاُ في هذا الحقل ",
            'username.unique'=>"اسم المستخدم الذي ادخلته موجود فعلاُ، يرجى ادخال اسم مستخدم غير قابل للتكرار ",

            'password.required'=>"هذا الحقل مطلوب",
            'password.min'=>"لا يسمح لك بأدخال أقل من 6 حروف في هذا الحقل ",
          
         
        ]);//Validate*/ 
    }
}
