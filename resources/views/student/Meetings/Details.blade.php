@extends('layouts.Master.Student') 

@section('title')
    تفاصيل اللقاء رقم : {{ isset($Meeting->id) !=null ? $Meeting->id : '' }}
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            تفاصيل اللقاء رقم : {{ isset($Meeting->id) !=null ? $Meeting->id : '' }}
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h4 class="page-header">
        تفاصيل 
        <strong>
            @php
                $NameOfMeetings;
                switch($Meeting->NumberOfMeeting){
                    case 1:$NameOfMeetings = "اللقاء الاول";break;
                    case 2:$NameOfMeetings = "اللقاء الثاني";break;
                    case 3:$NameOfMeetings = "اللقاء الثالث";break;
                    case 4:$NameOfMeetings = "اللقاء الرابع";break;
                    case 5:$NameOfMeetings = "اللقاء الخامس";break;
                    case 6:$NameOfMeetings = "اللقاء السادس";break;
                    case 7:$NameOfMeetings = "اللقاء السابع";break;
                    case 8:$NameOfMeetings = "اللقاء الثامن";break;
                    case 9:$NameOfMeetings = "اللقاء التاسع";break;
                    case 10:$NameOfMeetings = "اللقاء العاشر";break;
                    case 11:$NameOfMeetings = "اللقاء الحادي عشر";break;
                    case 12:$NameOfMeetings = "اللقاء الثاني عشر";break;
                    case 13:$NameOfMeetings = "اللقاء الثالث عشر";break;
                    case 14:$NameOfMeetings = "اللقاء الرابع عشر";break;
                    case 15:$NameOfMeetings = "اللقاء الخامس عشر";break;
                    case 16:$NameOfMeetings = "اللقاء السادس عشر";break;
                    case 17:$NameOfMeetings = "اللقاء السابع عشر";break;
                    case 18:$NameOfMeetings = "اللقاء الثامن عشر";break;
                    case 19:$NameOfMeetings = "اللقاء التاسع عشر";break;
                    case 20:$NameOfMeetings = "اللقاء العشرون";break;
                    default :$NameOfMeetings = "اللقاء رقم : $Meeting->NumberOfMeeting";
                } 
            @endphp
            {{$NameOfMeetings}}
        </strong>
    </h4>

    <div class="table-responsive">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"> <strong>موضوعات اللقاء</strong></h3>
            </div>
            <div class="panel-body">
               {{ isset($Meeting->TitleMeeting) !=null ? $Meeting->TitleMeeting : 'لاتوجد بيانات ليتم عرضها !' }}
            </div>
        </div>
       
    </div>
    <div class="table-responsive">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title"> <strong>تكاليف اللقاء</strong></h3>
            </div>
            <div class="panel-body">
               {{ isset($Meeting->TaskName) !=null ? $Meeting->TaskName : 'لاتوجد بيانات ليتم عرضها !' }}
            </div>
        </div>
       
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>الحضور</th>
                    <th>تاريخ عقد اللقاء</th>
                    <th>اٌنش اللقاء بواسطة</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @foreach($Meeting->project_students as $s)
                        - {{ isset($s->users->Name) !=null ? $s->users->Name : 'لاتوجد بيانات ليتم عرضها!' }} </br>
                        @endforeach
                    </td>
                    <td>{{ isset($Meeting->created_at) !=null ? $Meeting->created_at : 'لاتوجد بيانات ليتم عرضها!' }}</td>
                    <td>{{ isset($Meeting->project_supervisors->users->Name) !=null ? $Meeting->project_supervisors->users->Name : 'لاتوجد بيانات ليتم عرضها!' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

   
   
 
@endsection           
 