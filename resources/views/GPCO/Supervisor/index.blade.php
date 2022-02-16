@extends('layouts.Master.GPCO') 

@section('title')
 بيانات المشرفين
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-bar-chart"></i>  بيانات المشرفين
                    </h3>
                    <ol class="breadcrumb">
                        <li class="active">
                           <i class="fa fa-bar-chart"></i> بيانات المشرفين
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                            <a class="pull-left" title="تصدير البيانات الى ملف Excel" href="{{ url('ViewDetails/excel/all/supervisor') }}"><i class="fa fa-file-excel-o"></i></a>
                    </ol>
                </div>
            </div> 
            <!-- /.row -->

            <div class="col-lg-3 col-md-3">

                <div class="list-group">
                    <a title="جميع المشرفين" href="{{ url('supervisors-data/details/1') }}" class="list-group-item list-group-item-info  group-q">
                        <span class="badge">{{isset($All_Supervisors) !=null ? $All_Supervisors : ''}}</span>
                        <strong>جميع المشرفين </strong>
                    </a>
                </div>
                <hr>

                <div class="list-group">
                    <a title="طلبات الاعفاء من الاشراف" href="{{ url('#') }}" class="list-group-item list-group-item-danger  group-q">
                        <span class="badge">#</span>
                        <strong> طلبات الاعفاء من الاشراف </strong>
                    </a>
                </div>
                <hr>

                <div class="list-group">
                    <a title="المشرفين معفيين من الاشراف" href="{{ url('supervisors-data/details/2') }}" class="list-group-item list-group-item-warning  group-q">
                        <span class="badge">{{ isset($Desnat_Supervisors) ? $Desnat_Supervisors : '' }}</span>
                        <strong> المشرفين معفيين من الاشراف</strong>
                    </a>
                </div>

            </div>
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection