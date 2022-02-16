@extends('layouts.Master.FacultyMember') 

@section('title')
    اللقاءات السابقة
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <a title="اللقاءات" href="{{ url('FacultyMember/meetings') }}"><i class="fa fa-video-camera"></i>  اللقاءات </a>
        </li>
        <li class="active">
           اللقاءات السابقة
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>

    @if(count($Meetings)==0)
        <hr>
        <div class="alert alert-danger text-center" role="alert"><h4><i class="fa fa-warning"></i> لايوجد لقاءات </h4></div>
    @endif 
    @if(count($Meetings)!=0)
        <h4 class="page-header">
            <span class="badge bg-green">{{count($Meetings)}}</span> لقاء أقيم للمجموعة
        </h4>
        @foreach($Meetings as $m)
            <div class="col-lg-3 col-md-3">
                <div class="list-group text-center">
                    <a href="{{ url("FacultyMember/meeting/$m->id/details") }}" title="اللقاء رقم :{{ isset($m->id) !=null ? $m->id : '' }}"  class="list-group-item">
                        <strong>
                            @php
                                $NameOfMeetings;
                                switch($m->NumberOfMeeting){
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
                                    default :$NameOfMeetings = "اللقاء رقم : $m->NumberOfMeeting";
                                } 
                            @endphp
                            {{$NameOfMeetings}}
                        </strong>
                    </a>
                </div>
            </div>
        @endforeach
    @endif
 
@endsection           
 