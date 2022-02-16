@extends('layouts.Master.Student') 

@section('title')
   الحضور والغياب
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
           تقيماتي
        </li>
        <li class="active">
           الحضور والغياب
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
  
    <div class="table-responsive col-lg-6">

        <h4>  الحضور والغياب</h4>
        <hr>
        @if(count($Meetings) == 0)
            <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-exclamation-triangle"></i> لم يتم رصد الحضور والغياب</h5>
            </div>
        @endif
        @if(count($Meetings) != 0)
            <table class="table table-bordered table-hover">
                <tbody>
                    @foreach($Meetings as $m)
                        <tr>
                            <th>
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
                            </th>
                            <td>
                                @foreach($m->project_students as $s)
                                    @if ($loop->first)
                                        @if($s->AcdameicNumber == $SG->AcdameicNumber)
                                            <span class="label label-success">حاضر</span>
                                        @endif 
                                    
                                        @if($s->AcdameicNumber != $SG->AcdameicNumber)
                                            <span class="label label-danger">غائب</span>
                                        @endif 
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="table-responsive col-lg-6">
        <table class="table ">
            <tbody>
                    <tr>
                        <th>
                          عدد اللقاءات
                        </th>
                        <td>
                          <span class="badge bg-green">{{count($Meetings)}}</span>
                        </td>
                    </tr>
                    <tr class="info">
                        <th>
                          عدد الحضور
                        </th>
                        <td>
                          <span class="badge bg-green">{{ isset($Prsent) !=null ? $Prsent : ''}}</span>
                        </td>
                    </tr>
                    <tr class="danger">
                        <th>
                          عدد الغياب
                        </th>
                        <td>
                          <span class="badge bg-green">{{ isset($Absent) !=null ? $Absent : ''}}</span>
                        </td>
                    </tr>
            </tbody>
        </table>
        <hr>
    </div>

@endsection           
