<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>
        GPC |
          جميع الطلاب المسجلين
    </title>

    
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
                           <th>تاريخ التسجيل</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach($PS as $p)
                                        <tr>
                                            <td>{{ $p->AcdameicNumber }}</td>
                                            <td>{{ $p->users->FirstName	}} {{ $p->users->SecondName	}} {{ $p->users->TirdName	}} {{ $p->users->NickName	}}</td>
                                            <td>{{ $p->users->Gender }}</td>
                                            <td>{{ $p->programs->ProgramName	}}</td>
                                            <th>{{ $p->branches->BrancheNameAR }}</th>
                                            <td>{{ $p->created_at }}</td>
                                        </tr>
                                @endforeach 
                      </tbody>
                    </table>
</body>
</html>

