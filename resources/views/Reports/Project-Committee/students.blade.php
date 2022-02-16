<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">



</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th>الرقم الاكاديمي للطالب</th>
                <th>اسم الطالب</th>
                <th>الجنس</th>
                <th>التخصص</th>
                <th>المركز الدراسي</th>
                <th>المجموعة</th>
                <th>تاريخ التسجيل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($PS as $p) 
            <tr>
                <td>{{ ($p->AcdameicNumber) !=null ? $p->AcdameicNumber:'لاتوجد بيانات !' }}</td>
                <td>{{ ($p->users->Name) !=null ? $p->users->Name:'لاتوجد بيانات !' }}</td>
                <td>{{ ($p->users->Gender) !=null ? $p->users->Gender:'لاتوجد بيانات !' }}</td>
                <td>{{ ($p->programs->ProgramName) !=null ? $p->programs->ProgramName:'لاتوجد بيانات !' }}</td>
                <th>{{ ($p->branches->BrancheNameAR) !=null ? $p->branches->BrancheNameAR:'لاتوجد بيانات !' }}</th>
                <td>
                    @if($p->project_groups_id == null)
                                            ليس ضمن مجموعة مشاريع 
                    @endif
                    @if($p->project_groups_id != null)
                                    ينتمي الى مجموعة مشاريع
                    @endif
                </td>
                <td>{{ ($p->created_at) !=null ? $p->created_at:'لاتوجد بيانات !' }}</td>
            </tr>
            @endforeach
            <tr>

                <td colspan="6" style="  border-top: 1px solid black;">
                    <small>طبع بواسطة : {{ Auth::user()->username }} | {{ Time_Now() }}</small>

                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>