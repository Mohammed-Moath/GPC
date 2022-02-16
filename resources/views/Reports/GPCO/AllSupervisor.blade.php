<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>
        GPC |
         جميع المشرفين المسجلين
    </title>

    
</head>

<body>
     <table class="table">
                      <thead>
                        <tr>
                          <th>الرقم الوظيفي للمشرف</th>
                          <th>اسم المشرف </th>
                          <th>الجنس</th>
                          <th>الدرجة العلمية</th>
                          <th>التخصص</th>
                           <th>تاريخ التسجيل</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach($PS as $p)
                                        <tr>
                                            <td>{{ $p->FunctionalNumber }}</td>
                                            <td>{{ $p->users->FirstName	}} {{ $p->users->SecondName	}} {{ $p->users->TirdName	}} {{ $p->users->NickName	}}</td>
                                            <td>{{ $p->users->Gender }}</td>
                                            <td>{{ $p->scientific_degrees->NameDegree }}</td>
                                            <th>{{ $p->programs->ProgramName}}</th>
                                            <td>{{ $p->created_at }}</td>
                                        </tr>
                                @endforeach 
                      </tbody>
                    </table>
</body>
</html>

