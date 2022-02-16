@extends('layouts.Master.GPCO') 

@section('title')
أعتماد الرغبات بحسب الاولوية 
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                    <i class="fa fa-group"></i> المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                        <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="أدارة المجموعات" href=" {{ url('manage/groups')}}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li  class="active">
                            <i class="fa fa-check-circle-o"></i> أعتماد الرغبات بحسب الاولوية 
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
                <div class="col-lg-12 col-md-12">
                    <h3><i class="fa fa-check-circle-o"></i>  أعتماد الرغبات <span class="label label-info"><strong>بحسب الاولوية</strong></span> </h3> 
                    @if(count($Groups)==0)
                        <hr>
                        <div class="alert alert-danger text-center" role="alert">
                            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>لاتوجد مجموعات</strong>
                        </div>
                    @endif

                    @if(count($Groups)!=0)
                    <hr>
                    <h4><strong><span class="label label-warning">المجموعات التي قد تم تكوينها</span></strong></h4>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><span class="label label-default">الرقم التسلسلي للمجموعة</span></th>
                                        <th><span class="label label-default">المركز الدراسي للمجموعة</span></th>
                                        <th><span class="label label-default">رئيس مجموعة العمل</span></th>
                                        <th><span class="label label-default">العام الجامعي</span></th>
                                        <th><span class="label label-default">تاريخ الانشاء</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Groups as $g)   
                                        <tr>
                                            <th>
                                                <a title="تفاصيل المجموعة ورغباتها" href="details-group/{{ $g->id }}" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> تفاصيل المجموعة ورغباتها </a> 
                                            </th>
                                            <th>
                                                {{ isset($g->id) !=null ? $g->id: 'لا توجد اي بيانات ليتم عرضها!.'}}
                                            </th>
                                            <th>
                                                {{ isset($g->branches->BrancheNameAR) !=null ? $g->branches->BrancheNameAR : 'لا توجد اي بيانات ليتم عرضها!.'}}
                                            </th>
                                            <th>
                                                {{ isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لا توجد اي بيانات ليتم عرضها!.'}}
                                            </th>
                                            <th>
                                                {{ isset($g->AcademicYear) !=null ? $g->AcademicYear : 'لا توجد اي بيانات ليتم عرضها!.'}}
                                            </th>
                                            <th>
                                                {{ isset($g->created_at) !=null ? $g->created_at : 'لا توجد اي بيانات ليتم عرضها!.'}}
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection