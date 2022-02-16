<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>
        GPC |
          المركز الرئيسي- بنين
    </title>

    
</head>

<body>
     <table class="table">
                      <thead>
                        <tr>
                          <th>الرقم الاكاديمي للطالب</th>
                          <th>اسم الطالب</th>
                          <th>القسم العلمي</th>
                          <th>التخصص</th>
                           <th>تاريخ التسجيل</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach($PSB as $p)
                                        <tr>
                                            <td>{{ $p->AcdameicNumber }}</td>
                                            <td>{{ $p->users->FirstName	}} {{ $p->users->SecondName	}} {{ $p->users->TirdName	}} {{ $p->users->NickName	}}</td>
                                            <td>{{ $p->programs->scientific_departments->DepartmentName }}</td>
                                            <td>{{ $p->programs->ProgramName	}}</td>
                                            <td>{{ $p->created_at }}</td>
                                        </tr>
                                @endforeach 
                      </tbody>
                    </table>
</body>
</html>

