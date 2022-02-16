@extends('layouts.Master.GPCO') 

@section('title')
 المجموعات | متابعة المجموعات | {{ $NameGroups }}
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-group"></i>  المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                           <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="متابعة المجموعات" href="{{ url('follow/groups') }}"><i class="fa fa-eye"></i> متابعة المجموعات </a>
                        </li>
                        <li>
                            <a title="{{ $NameGroups }} | الحضور والغياب" href="{{ url('follow-up/boys',1) }}">  {{ $NameGroups }} | الحضور والغياب</a>
                        </li>
                        <li  class="active">
                           المجموعة رقم : {{ isset( $Groups->id) !=null ?  $Groups->id : 'لاتوجد أي بيانات ليتم عرضها !' }}
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                </div>
            </div> 
            <!-- /.row --> 
            
            <div class="row"> 
                @if(count($Groups) !=0)
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="info">
                                        <th>#</th>
                                        <th>رئيس المجموعة</th>
                                        <th>مشرف المجموعة</th>
                                        <th>العام الجامعي</th>
                                        <th>الفصل الدراسي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>{{ isset($Groups->id) !=null ? $Groups->id : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($Groups->project_students->users->Name) !=null ? $Groups->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($Groups->project_supervisors->users->Name) !=null ? $Groups->project_supervisors->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($Groups->AcademicYear) !=null ? $Groups->AcademicYear : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($Groups->Semester) !=null ? $Groups->Semester : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td><a title="تفاصيل" href="{{ url("statistics-groups/$Groups->id/show") }}" class="btn btn-primary btn-xs "><i class="fa fa-folder-open"></i> تفاصيل</a></td>
                                    </tr>
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.row -->    

            <div class="row"> 
                @if($NameGroups == "الطلاب")
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="اللقاءات" href="{{ url("follow-up/group/1/$Groups->id/meetings") }}" class="list-group-item list-group-item-info   group-q">
                                <strong>اللقاءات</strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="الحضور والغياب"  class="list-group-item list-group-item-info disabled group-q">
                                <strong>الحضور والغياب </strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="التسليمات" href="{{ url("follow-up/group/1/$Groups->id/deliveries") }}" class="list-group-item list-group-item-info  group-q">
                                <strong>التسليمات </strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                @endif
              
                @if( $NameGroups == "الطالبات")
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="اللقاءات" href="{{ url("follow-up/group/2/$Groups->id/meetings") }}" class="list-group-item list-group-item-info  group-q">
                                <strong>اللقاءات</strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="الحضور والغياب"  class="list-group-item list-group-item-info disabled  group-q">
                                <strong>الحضور والغياب </strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="التسليمات" href="{{ url("follow-up/group/2/$Groups->id/deliveries") }}" class="list-group-item list-group-item-info  group-q">
                                <strong>التسليمات </strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                @endif
            </div>
            <!-- /.row -->    

            <div class="row"> 
                <div class="col-lg-12 col-md-12">
                    @if(count($Groups) !=0)
                            @if(count($Meetings) == 0)
                                <div class="alert alert-danger text-center col-lg-12 col-md-12" role="alert">
                                    <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>لم يرصد الحضور والغياب </strong>
                                </div>
                            @endif
                            @if(count($Meetings) != 0)
                                <h4> الحضور والغياب لأعضاء المجموعة</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th colspan="{{count($Meetings)}}" class="info text-center">اللقاءات التي اٌقيمت لهذه المجموعة</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th class="info">أعضاء المجموعة</th>
                                                @foreach($Meetings as $m)
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
                                                @endforeach
                                            </tr>    
                                        </thead>
                                        <tbody>
                                            @foreach($Team as $t)
                                                <tr>
                                                    <td  class="warning">{{ isset($t->users->Name) !=null ? $t->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    @foreach($Meetings as $m)
                                                        @foreach($Attendance as $a)
                                                            @if($m->id == $a->meeting_id)
                                                                @if($t->AcdameicNumber == $a->AcdameicNumber)
                                                                <td>
                                                                    <span class="label label-success">حاضر</span>
                                                                </td> 
                                                                @endif
                                                                @unless($t->AcdameicNumber == $a->AcdameicNumber)
                                                                <td>
                                                                    <span class="label label-danger">غائب</span>
                                                                </td> 
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>    
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @if(count($Meetings)!=0) 
        @include('GPCO.groups.Follow Groups.Detail Meeting')
    @endif 
@endsection