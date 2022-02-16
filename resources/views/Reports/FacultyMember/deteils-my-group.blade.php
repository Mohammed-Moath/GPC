<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>
        groupC |
        طلابي | تفاصيل مجموعة العمل رقم {{ $group->id }}
    </title>

    {!! Html::style('css/reports.css') !!}
</head>

<body>
    <page size="A4">
        <div class="title text-center">
            <h4>طلابي | تفاصيل مجموعة العمل رقم {{ $group->id }}</h4>
        </div>
        <div class="content">
           <div>
               <h5> رئيس مجموعة العمل  {{ $group->project_students->users->FirstName }}
            {{ $group->project_students->users->SecondName }}
            {{ $group->project_students->users->TirdName }}
            {{ $group->project_students->users->NickName }}   </h5>
           </div>
           <hr>
           <div>
             <h5><strong>فريق مجموعة العمل </strong> </h5>
                 <table class="table table-bordered">
                <thead>
                    <tr class="success">
                        <th>الرقم الاكاديمي </th>
                        <th>الاسم</th>
                        <th>التخصص</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Team as $t)
                    <tr>
                        <th scope="row">{{ $t->AcdameicNumber }}</th>
                        <td>{{$t->users->FirstName}}
                             {{$t->users->SecondName}}
                             {{$t->users->TirdName}}
                             {{$t->users->NickName}}
                        </td>
                        <td>{{$t->programs->ProgramName}}</td>
                    </tr>
                  @endforeach  
               
                </tbody>
            </table>
           </div>
            <hr>
           <div>
             <h5><strong>تفاصيل اخرى عن هذه المجموعة </strong></h5>
            <table class="table table-bordered table-hover ">
                <thead>
                    <tr class="success">
                        <th>عدد أعضاء الفريق المسموح به في هذه المجموعة </th>
                        <th>{{ $group->proposals->NumberOfStudents }}</th>
                    </tr>
                     <tr class="success">
                        <th>أنشات هذه المجموعة بواسطة </th>
                        <th>
                            @unless($group->created_by == null)
                                {{ $group->users->FirstName }}
                                {{ $group->users->SecondName }}
                                {{ $group->users->TirdName }}
                                {{ $group->users->NickName }}
                            @endif
                            @if($group->created_by == null)
                             عذراً ، لا تتوفر اي بيانات من قاعدة البيانات   
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>العام الجامعي لهذه المجموعة</td>
                        <td>{{ $group->AcademicYear }}</td>
                    </tr>
                    <tr>
                        <td>الفصل الدراسي لهذه المجموعة</td>
                        <td>{{ $group->Semester }}</td>
                    </tr>
                    <tr>
                        <td>المركز الدراسي لهذه المجموعة</td>
                        <td>{{ $group->branches->BrancheNameAR }}</td>
                    </tr>
                    <tr>
                        <td>تاريخ انشاء هذه المجموعة</td>
                        <td>{{ $group->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="line"></div>
    </page>
</body>
</html>

