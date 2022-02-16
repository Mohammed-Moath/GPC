<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <title>
        GPC |
         مقترح مشروع تخرج رقم {{ $proposal->id }}
    </title>

    {!! Html::style('css/reports.css') !!}
</head>

<body>
    <page size="A4">
        <div class="head-right">
            <h5 class="text-center">جامعة العلوم والتكنولوجيا <br> كلية الحاسبات وتكنولوجيا المعلومات <br/> لجنة مشاريع التخرج</h5>
        </div>
        <div class="head-center">
            <img class="img-rounded logo" src="{{ asset('img/ust.gif') }}">
        </div>
        <div class="head-left">
            <h5 class="text-center">University of Science & Technology <br/> Faculty of Computing & Info.Tech <br/> Graduation Projects Committee</h5>
        </div>
        <div class="line"></div>
        <div class="title text-center">
            <h3>عنوان مقترح المشروع /</h3>
            <h4>{{ $proposal->ProjectProposalTitle }}</h4>
        </div>
        <div class="content">
           <div>
               <h5> العام الجامعي : {{ $proposal->AcademicYear  }} |  الفصل الدراسي : {{ $proposal->Semester  }}</h5>
               <h5>  تاريخ التقديم : {{ $proposal->created_at  }}</h5>
                <h5>  مقدم المقترح : {{ $proposal->users->FirstName  }} {{ $proposal->users->SecondName  }} {{ $proposal->users->TirdName  }} {{ $proposal->users->NickName  }}</h5>
               <h5> صفة مقدم المقترح : {{ $proposal->users->UserRoles->UserRoleAr	}}</h5> 
           </div>
           <hr>
           <div>
             <h5><strong>وصف المقترح : </strong> {{ $proposal->descrdiption}}</h5>
           </div>
            <hr>
           <div>
             <h5><strong>المخرجات المتوقعة من المشروع : </strong> {{ $proposal->Outputs}}</h5>
           </div>
            <hr>
           <div>
             <h5><strong>أهمية هذا المشروع : </strong> {{ $proposal->ImportanceProposal}}</h5>
           </div>
            <hr>
           <div>
             <h5><strong>ادوات المشروع  : </strong> {{ $proposal->Tools}}</h5>
           </div>
            <hr>
           <div>
             <h5><strong>عدد الطلاب المناسب لانجاز هذا المقترح : </strong> {{ $proposal->NumberOfStudents}}</h5>
           </div>
            <hr>
           <div>
             <h5><strong>عدد الطلاب المناسب لانجاز هذا المقترح : </strong> {{ $proposal->NumberOfStudents}}</h5>
           </div>         
        </div>
        <div class="line"></div>
    </page>
</body>
</html>

