@extends('layouts.Master.GPCO') 

@section('title')
   أعتماد الرغبات للمجموعات بحسب الاولوية المختارة
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-group"></i>المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="أدارة المجموعات" href=" {{ url('manage/groups')}}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li  class="active">
                            <a title=" أعتماد الرغبات بحسب الاولوية " href=" {{ url('approval-as-primacy')}}"><i class="fa fa-check-circle-o"></i> أعتماد الرغبات بحسب الاولوية </a> 
                        </li>
                        <li  class="active">
                          المجموعة رقم : {{ $Groups->id }} 
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ url('approval-as-primacy') }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                </div>
            </div> 
            <!-- /.row -->
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <a title="تعديل" href="" class="btn btn-warning btn-xs pull-left"><i class="fa fa-edit"></i> تعديل</a>
                            <h3 class="panel-title"> <i class="fa fa-exclamation-circle"></i> معلومات عن المجموعة رقم : {{ $Groups->id }}  </h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>المركز الدراسي: <span class="label label-default">{{ isset($Groups->branches->BrancheNameAR) !=null ? $Groups->branches->BrancheNameAR : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                            <th>اعضاء الفريق في المجموعة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">العام الجامعي: <span class="label label-default">{{ isset($Groups->AcademicYear) !=null ? $Groups->AcademicYear : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                            <td rowspan="4">
                                                @if(count($Team)==0)
                                                    <span class="label label-danger">لايوجد اي عضو فريق في هذه المجموعة !!</span>
                                                @endif
                                                @if(count($Team)!=0)
                                                    @foreach($Team as $t)
                                                     - {{ isset($t->users->Name) !=null ? $t->users->Name : 'لايوجد اي بيانات ليتم عرضها !!'  }}
                                                            @if($t->AcdameicNumber == $Groups->GroupLader)
                                                                <span class="label label-success">رئيس الفريق</span>
                                                            @endif    
                                                      </br>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">الفصل الدراسي: <span class="label label-default">{{ isset($Groups->Semester) !=null ? $Groups->Semester : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                        </tr>
                                        <tr>
                                            <th scope="row">تاريخ أنشاء المجموعة : <span class="label label-default">{{ isset($Groups->created_at) !=null ? $Groups->created_at : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                        </tr>
                                        <tr>
                                            <th scope="row">أنٌشت المجموعة بواسطة : <span class="label label-default">{{ isset($Groups->users->Name) !=null ? $Groups->users->Name : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                        </tr>
                                        <tr>
                                            <th scope="row">مشرف المجموعة : <span class="label label-default">{{ isset($Groups->project_supervisors->users->Name) !=null ? $Groups->project_supervisors->users->Name : 'لم يتم تحديد مشرف بعد !'}}</span></th>
                                            <th scope="row">عنوان مشروع المجموعة : <span class="label label-default">{{ isset($Groups->proposals->ProjectProposalTitle) !=null ? $Groups->proposals->ProjectProposalTitle : 'لم يتم أعتماد المشروع بعد !'}}</span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong> رغبات المشاريع الخاصة بالمجموعة رقم : {{ $Groups->id }}  </strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table  table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>الأولوية</th>
                                            <th>تاريخ الاختيار</th>
                                            <th>عنوان المشروع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($Wishes)==0)
                                            <tr>
                                                <th colspan="4"><span class="label label-danger">لايوجد اي رغبة لهذا المجموعة !!</span></th>
                                            </tr>
                                        @endif 
                                        @if(count($Wishes)!=0) 
                                            @foreach($Wishes as $w) 
                                                <tr>
                                                    <td>
                                                        <a title="تفاصيل المشروع" href="{{ url("review/proposal/$w->proposals_id/show") }}" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> تفاصيل المشروع</a>
                                                        <button data-title="Approval" data-toggle="modal" data-target="#Approval-{{$w->id}}" class="btn btn-success btn-xs" title="أعتماد المشروع للمجموعة"><i class="fa fa-check-circle-o"></i> أعتماد المشروع للمجموعة</button>
                                                    </td>
                                                    <td>{{isset($w->priority) !=null ? $w->priority : 'لم يتم تحديد الاولوية !.'}}</td>
                                                    <td>{{isset($w->created_at) !=null ? $w->created_at : 'لايوجد أي بيانات ليتم عرضها !.'}}</td>
                                                    <td>{{isset($w->proposals->ProjectProposalTitle) !=null ? $w->proposals->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها !.'}}</td>
                                                </tr>
                                            @endforeach 
                                        @endif   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @if(count($Wishes)!=0) 
        @include('GPCO.groups.NotesCommittee')
    @endif   
@endsection


