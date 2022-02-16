@extends('layouts.Master.GPCO') 

@section('title')
   المجموعات | متابعة المجموعات
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
                        <li  class="active">
                            <i class="fa fa-eye"></i> متابعة المجموعات
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
                <div class="col-lg-6 col-md-6">
                    <h3> الطلاب</h3>
                    <hr>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="اللقاءات" href="{{ url('follow-up/boys',1) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>اللقاءات</strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="الحضور والغياب" href="{{ url('follow-up/boys',2) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>الحضور والغياب </strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="التسليمات" href="{{ url('follow-up/boys',3) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>التسليمات </strong>
                            </a>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6">
                    <h3> الطالبات</h3>
                    <hr>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="اللقاءات" href="{{ url('follow-up/grils',1) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>اللقاءات</strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="الحضور والغياب" href="{{ url('follow-up/grils',2) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>الحضور والغياب </strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="التسليمات" href="{{ url('follow-up/grils',3) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>التسليمات </strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection