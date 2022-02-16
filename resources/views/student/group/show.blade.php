@extends('layouts.Master.Student') 

@section('title')
    مجموعتي
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
             <i class="fa fa-users" aria-hidden="true"></i> مجموعتي</a>
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    @if( Student_has_groug() == 'yes' )
        <h3 class="page-header">
            <strong>تفاصيل مجموعة العمل </strong>
        </h3>
        @if(Group_has_depended() == 'no')
            @if( IsStudentManger() == 'yes')
                <div class="alert alert-success  text-center" role="alert">  
                    <strong> <i class="fa fa-gears"></i>  خيارات أدارة المجموعة   | </strong> 
                    <a href="{{ url('student/x') }}" title="دعوة عضو">  <button type="button" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> دعوة عضو</button></a>
                    <a href="{{ url('student/x') }}" title="أعتزال رئاسة الفريق">  <button type="button" class="btn btn-warning"> <i class="fa fa-retweet"></i>  أعتزال رئاسة الفريق</button></a>
                    <a href="{{ url('student/x') }}" title="تغير رمز المجموعة">  <button type="button" class="btn btn-info"><i class="fa fa-key"></i> تغير رمز المجموعة</button></a>
                    <a href="{{ url('student/x') }}" title="حذف المجموعة">  <button type="button" class="btn btn-danger"> <i class="fa fa-trash"></i>  حذف المجموعة</button></a>
                </div>    
            @endif
            @if( IsStudentManger() == 'no')
                <div class="alert alert-success  text-left" role="alert">
                    <a href="{{ url('student/group/log-out') }}" title="مغادرة المجموعة">  <button type="button" class="btn btn-danger"> <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> مغادرة المجموعة</button></a>
                </div>    
            @endif
        @endif
        @if(Group_has_depended() == 'yes')
            @if( IsStudentManger() == 'yes')
                <div class="alert alert-success  text-lef" role="alert">  
                    <strong> <i class="fa fa-gears"></i>  خيارات أدارة المجموعة   | </strong> 
                    <a href="{{ url('student/x') }}" title="أعتزال رئاسة الفريق">  <button type="button" class="btn btn-warning"> <i class="fa fa-plus-circle"></i>  أعتزال رئاسة الفريق</button></a>
                </div>    
            @endif
        @endif    
        @if( Group_has_depended() == 'no')
            <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-exclamation-triangle"></i> ملاحظة : يمكنك فقط أضافة عدد {{  Number_Wishes() }}  من رغبات المشاريع لمجموعتك</h5>
             
            </div>
            <div class="panel panel-info"> 
                <div class="panel-heading clickable">
                    <h3 class="panel-title">
                        <strong>رغبات المشاريع الخاصة بالمجموعة</strong></h3>
                    <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
                </div>
                <div class="panel-body">
              
                    @if(count($Wishe) == 0)
                       <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-exclamation-triangle"></i> لاتوجد أي رغبات مسجله للمجموعة</h5>
                        <a href="{{url('student/selection/proposals')}}" title="أضف رغبات" > <i class="fa fa-plus-circle"></i> أضف رغبات</a>
                       </div>
                    @endif
                    @if(count($Wishe) != 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr class="success">
                                    @if( IsStudentManger() == 'yes')
                                        <th colspan="3"></th>
                                    @endif    
                                    <th>عنوان  المشروع </th>
                                    <th>اولوية المشروع</th>
                                    <th>تاريخ الاضافة</th>
                                </tr> 
                            </thead>
                            <tbody>
                            @foreach($Wishe as $W)
                                <tr> 
                                    @if( IsStudentManger() == 'yes')
                                        <th><a href="{{ url("student/proposals/$W->proposals_id/details")}}" title="عرض"><button  type="button" class="btn btn-info btn-xs"> <i class="fa fa-eye"></i></button></a></th>
                                        <th><a href="{{ url('student/delete/wish',$W->id)}}" title="حذف" ><button  type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i></button></a></th>
                                        <th><button title="تحديد أولوية المشروع" type="button"  data-toggle="modal" data-target="#myModal-{{$W->proposals->id}}" class="btn btn-success btn-xs"> <i class="fa fa-unsorted"></i></button></th>
                                    @endif    
                                    <th scope="row"> {{ isset($W->proposals->ProjectProposalTitle) ? $W->proposals->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.'  }}</th>
                                    <td>
                                       @if($W->priority == null)
                                        <span class="label label-danger">لم تحدد !</span>
                                       @endif
                                       @if($W->priority != null)
                                            <span class="badge bg-danger"> {{$W->priority}} </span> 
                                       @endif
                                    </td>
                                    <td> {{ ($W->created_at) !=null ? $W->created_at : 'لايوجد أي بيانات ليتم عرضها!.'  }} </td>
                                </tr>
                            @endforeach  
                            </tbody>
                        </table>
                    @endif
             
                </div>
            </div>   
        @endif
        @if(Group_has_depended() == 'yes')
            <div class="panel panel-info"> 
                <div class="panel-heading clickable">
                    <h3 class="panel-title">
                        <strong>عنوان المشروع الخاص بالمجموعة</strong></h3>
                    <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
                </div>
                <div class="panel-body">  
                    <a title="تفاصيل المشروع" href="{{ url("student/proposals/$G->proposals_id/details") }}"><i class="fa fa-arrow-circle-left"></i> {{ isset($G->proposals) ? $G->proposals->ProjectProposalTitle : 'لم يتم اعتماد المشروع بعد.'  }}   </a></td>  
                </div>
            </div>
        @endif
        <div class="panel panel-info"> 
            <div class="panel-heading clickable">
                <h3 class="panel-title">
                    <strong>رئيس مجموعة العمل</strong></h3>
                <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
                {{ isset($G->project_students->users->Name) != null ? $G->project_students->users->Name : 'لايوجد أي بيانات ليتم عرضها!.'  }}      
            </div>
        </div>
        <div class="panel panel-info"> 
            <div class="panel-heading clickable">
                <h3 class="panel-title">
                    <strong>مشرف مجموعة العمل</strong></h3>
                <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
                {{ isset($G->project_supervisors->users->Name) !=null ? $G->project_supervisors->users->Name : 'لم يتم تحديد المشرف من قبل اللجنة بعد.'  }}
            </div> 
        </div>
        <div class="panel panel-info"> 
            <div class="panel-heading clickable">
                <h3 class="panel-title">
                    <strong>تاريخ أنشاء المجموعة وموقعها</strong></h3>
                <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
                <strong> - تاريخ الانشاء : </strong>{{ isset($G->created_at) ? $G->created_at : 'لايوجد أي بيانات ليتم عرضها!.'  }}       </br>
                <strong> - العام الجامعي : </strong>{{ isset($G->AcademicYear) ? $G->AcademicYear : 'لايوجد أي بيانات ليتم عرضها!.'  }} </br>
                <strong> - الفصل الدراسي : </strong>{{ isset($G->Semester) ? $G->Semester : 'لايوجد أي بيانات ليتم عرضها!.'  }} </br>
                <strong>- موقع مجموعة العمل  : </strong>{{ isset($G->branches_id) ? $G->branches->BrancheNameAR : 'لايوجد أي بيانات ليتم عرضها!.'  }}
            </div>
        </div>
        <div class="panel panel-info"> 
            <div class="panel-heading clickable">
                <h3 class="panel-title">
                    <strong>فريق العمل</strong></h3>
                <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
            </div>
            <div class="panel-body">
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
                            <th scope="row"> {{ isset($t->AcdameicNumber) ? $t->AcdameicNumber : 'لايوجد أي بيانات ليتم عرضها!.'  }}</th>
                            <td>
                                {{ isset($t->users->Name) ? $t->users->Name : 'لايوجد أي بيانات ليتم عرضها!.'  }}
                            </td>
                            <td> {{ isset($t->programs->ProgramName) ? $t->programs->ProgramName : 'لايوجد أي بيانات ليتم عرضها!.'  }} </td>
                        </tr>
                    @endforeach  
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if(count($Wishe) != 0) 
        @include('student.group.priority')
    @endif 
@endsection           
