<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <title>
        GPC |
        جميع المشرفين المسجلين
    </title>


</head>

<body>
    <table class="table  table-bordered table-hover table-sm  ">
        <caption class="text-left">بيانات المشرفين</caption>
        <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">الرقم الوظيفي</th>
                <th class="text-center" scope="col">الاسم</th>
                <th class="text-center" scope="col">التخصص</th>
                <th class="text-center" scope="col">الدرجة العلمية </th>
                <th>تاريخ التسجيل</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($Supervisors as $sup)
            <tr>
                <td>{{ isset($sup->FunctionalNumber	) !=null ? $sup->FunctionalNumber	 : 'لاتوجد بيانات !'}}</td>
                <td>{{ isset($sup->users->Name) !=null ? $sup->users->Name : 'لاتوجد بيانات !'}}</td>
                <td>{{ isset($sup->programs->ProgramName) !=null ? $sup->programs->ProgramName : 'لاتوجد بيانات !'}}</td>
                <td>{{ isset($sup->scientific_degrees->name) !=null ? $sup->scientific_degrees->name : 'لاتوجد بيانات !'}}</td>
                <td>{{ isset($sup->created_at) !=null ? $sup->created_at : 'لاتوجد بيانات !'}}</td>
            </tr>
            @endforeach
            <tr>

                <td colspan="5" style="  border-top: 1px solid black;">
                    <small>طبع بواسطة : {{ Auth::user()->username }} | {{ Time_Now() }}</small>

                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>