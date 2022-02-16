<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>جميع مستخدمي النظام </title>
    <style>
        body {
            direction: rtl;
        }
    </style>
</head>


<body>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الاسم</th>
                <th scope="col">أسم الاستخدام</th>
                <th scope="col">الجنس</th>
                <th scope="col">رقم التلفون</th>
                <th scope="col">الايميل</th>
                <th scope="col">المجموعة</th>
                <th scope="col">حالة الحساب</th>
                <th scope="col">تاريخ الاضافة</th>
                <th scope="col">تاريخ اخر تعديل</th>
                <th scope="col">تاريخ الحدف</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ isset($user->id) !=null ? $user->id : ''}}</th>
                <td>{{ isset($user->Name) !=null ? $user->Name : 'لاتوجد بيانات !'}}</td>
                <td>{{ ($user->username) !=null ? $user->username : 'لاتوجد بيانات !'}}</td>
                <td>{{ ($user->Gender) !=null ? $user->Gender : 'لاتوجد بيانات !'}}</td>
                <td>{{ ($user->PhoneNumber) !=null ? $user->PhoneNumber : 'لاتوجد بيانات !'}}</td>
                <td>{{ ($user->Email) !=null ? $user->Email : 'لاتوجد بيانات !'}}</td>
                <td>{{ ($user->UserRoles->UserRoleAr) !=null ? $user->UserRoles->UserRoleAr : 'لاتوجد بيانات !'}}</td>
                <td>
                    @if($user->IsActive == 0)
                    <span>غير مفعل</span>
                    @endif
                    @if($user->IsActive == 1)
                    <span> مفعل</span>
                    @endif
                </td>
                <td>{{ ($user->created_at) !=null ? $user->created_at : 'لاتوجد بيانات !'}}</td>
                <td>{{ ($user->updated_at) !=null ? $user->updated_at : 'لاتوجد بيانات !'}}</td>
                <td>{{ ($user->deleted_at) !=null ? $user->deleted_at : 'لاتوجد بيانات !'}}</td>
            </tr>
            @endforeach
            <tr>

                <td colspan="11" style="  border-top: 1px solid black;">
                    <small>طبع بواسطة : {{ Auth::user()->username }} | {{ Time_Now() }}</small>

                </td>
            </tr>
        <tbody>
    </table>





</body>

</html>