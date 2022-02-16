@extends('layouts.Master.FacultyMember') 

@section('title')
طلابي | تفاصيل مجموعة العمل رقم {{ $group->id }}
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-group"></i>
            طلابي 
        </li>
        <li class="active">
           تفاصيل مجموعة العمل رقم {{ $group->id }}
        </li>
        <li  class="pull-left">
            <a title= "PDF" href="{{ url("MyStudent/group/$group->id/pdf ")}}"><i class="fa fa-file-pdf-o"></i></a>
        </li>
        <li  class="pull-left">
            <a  title= "Word" href="#"><i class="fa fa-file-word-o"></i></a>
        </li>
       
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <div class="page-header">
        <h3><strong>تفاصيل مجموعة العمل رقم {{ $group->id }} | {{ $TypeStudent }}</strong></h3>
        <button class="pull-left" title= "طباعة هذة الصفحة" onclick="myFunction()"><i class="fa fa-print"></i></button>
    </div>

    <div class="panel panel-{{ $coler }}">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>عنوان مشروع التخرج الخاص بالمجموعة</strong></h3>
        </div>
        <div class="panel-body text-center">
            {{ $group->proposals->ProjectProposalTitle }}
        </div>
    </div>
    <div class="panel panel-{{ $coler }}">
        <div class="panel-heading">
            <h3 class="panel-title "><strong>رئيس مجموعة العمل</strong></h3>
        </div>
        <div class="panel-body text-center">
            {{ isset($group->project_students->users->Name) !=null ? $group->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !' }}
        </div>
    </div>
    <div class="panel panel-{{ $coler }}">
        <div class="panel-heading">
            <h3 class="panel-title "><strong>فريق مجموعة العمل</strong></h3>
        </div>
        <div class="panel-body ">
            <table class="table table-bordered ">
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
                        <th scope="row">{{ isset($t->AcdameicNumber) !=null ? $t->AcdameicNumber : 'لاتوجد أي بيانات ليتم عرضها !' }}</th>
                        <td>
                            {{ isset($t->users->Name) !=null ? $t->users->Name : 'لاتوجد أي بيانات ليتم عرضها !'}}
                        </td>
                        <td>{{ isset($t->programs->ProgramName) !=null ? $t->programs->ProgramName : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                    </tr>
                  @endforeach  
               
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-{{ $coler }}">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>تفاصيل اخرى عن هذه المجموعة</strong></h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover ">
                <thead>
                     <tr class="success">
                        <th>أنُشت هذه المجموعة بواسطة </th>
                        <th>
                            {{ isset($group->users->Name) !=null ? $group->users->Name : 'لا توجد أي بيانات ليتم عرضها !' }}
                     </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>العام الجامعي لهذه المجموعة</td>
                        <td>{{ isset($group->AcademicYear) !=null ? $group->AcademicYear : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                    </tr>
                    <tr>
                        <td>الفصل الدراسي لهذه المجموعة</td>
                        <td>{{ isset($group->Semester) !=null ? $group->Semester :'لا توجد أي بيانات ليتم عرضها !' }}</td>
                    </tr>
                    <tr>
                        <td>المركز الدراسي لهذه المجموعة</td>
                        <td>{{ isset($group->branches->BrancheNameAR) !=null ? $group->branches->BrancheNameAR : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                    </tr>
                    <tr>
                        <td>تاريخ انشاء هذه المجموعة</td>
                        <td>{{ isset($group->created_at) !=null ? $group->created_at :'لا توجد أي بيانات ليتم عرضها !' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  
@endsection           
@section('footer')
<script>
function myFunction() {
    window.print();
}
</script>

@endsection 