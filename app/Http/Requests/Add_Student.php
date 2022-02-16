<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Add_Student extends FormRequest
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
        return
            [
                'AcdameicNumber'=>'required|numeric|unique:project_students|unique:users,username|digits_between:5,20',
                'IDNumber'=>'required|numeric|digits_between:5,50',
                'Name'=>'required|max:99|min:2',
                'Gender'=>'required',
                'Program'=>'required',
                'Branch'=>'required',
                'IsActive'=>'required',
                'HoursCompleted'=>'required|digits_between:2,3',
                'Email'=>'unique:users',
                'PhoneNumber'=>'required|numeric|digits_between:7,15'
            ];
            [   'AcdameicNumber.required'=>'هذا الحقل مطلوب ادخال بيانات فية !',
                'AcdameicNumber.numeric'=>'هذا الحقل يجب ان تكون قيمة بالارقام فقط !',
                'AcdameicNumber.unique'=>'الرقم الاكاديمي الذي ادخلته موجود مسبقاٌ!',
                'AcdameicNumber.digits_between'=>'الرقم الاكاديمي للطالب يجب ان يكون بين 5 ارقام و 20 رقماُ.',
                'IDNumber'=>'هذا الحقل مطلوب ادخال بيانات فيه.',
                'numeric'=>'هذا الحقل يجب ان يدخل قيمته بالارقام فقط.',
                'IDNumber.digits_between'=>'رقم المعرف الشخصي يجب أن تكون قيمته ما بين 5 الى 50 رقماَ.',
                'Name.required'=>'هذا الحقل مطلوب ادخال بيانات فيه.',
                'Name.max'=>'اقصي حروف لاسم الطالب 99 حرف!',
                'Name.min'=>'اقل احرف لاسم الطالب 2 حروف !',
                'HoursCompleted.required'=>'هذا الحقل مطلوب ادخال بيانات فيه !',
                'HoursCompleted.digits_between'=>'أقل رقم لعدد الساعات يجب ان يكون 2 واقصي رقم يجب ان يكون 3',
                'Email.unique'=>'الايميل الذي ادخلته موجود مسبقأ!',
                'PhoneNumber.required'=>'رقم الهاتف مطلوب ',
                'PhoneNumber.numeric'=>'رقم الهاتف يجب ان يكون ارقام فقط.',
                'PhoneNumber.digits_between'=>'رقم الهاتف يجب أن يكون مابين 7 الى 15 رقماً.'
        ];
    }
}
