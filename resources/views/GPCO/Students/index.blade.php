@extends('layouts.Master.GPCO') 

@section('title')
 بيانات الطلاب
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-bar-chart"></i>  بيانات الطلاب
                    </h3>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-bar-chart"></i> بيانات الطلاب 
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
                <div class="col-lg-12">
                    <h3> <i class="fa fa-bar-chart"></i> أحصائيات سريعة لطلبة مشاريع التخرج </h3> <hr> 
                </div>
            </div> 
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-Default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge">
                                        {{ isset($All_Student) !=null ? $All_Student : ''}}
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><strong>جميع الطلاب</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($All_Student !=0)
                            <a title="تفاصيل" href="{{ url('student-data/details/1') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">تفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge">
                                        {{ isset($Center_Branch) !=null ? $Center_Branch : ''}}
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><strong>المركز الرئيسي</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($Center_Branch !=0)
                            <a title="تفاصيل" href="{{ url('student-data/details/2') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">تفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge">
                                        {{ isset($Girls_Branch) !=null ? $Girls_Branch : ''}}
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><strong>فرع الطالبات</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($Girls_Branch !=0)
                            <a title="تفاصيل" href="{{ url('student-data/details/3') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">تفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge">
                                        {{ isset($Do_notHaveGroups) !=null ? $Do_notHaveGroups : ''}}
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><strong> لايوجد لديهم مجموعات !</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($Do_notHaveGroups !=0)
                            <a title="تفاصيل" href="{{ url('student-data/details/4') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">تفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection