@extends('layouts.Master.GPCO') 

@section('title')
الصفحة الرئيسية
@endsection

@section('content')
<div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header text-center">
                         <small>مرحباُ بك في GPC | البوابة الالكترونية للجنة مشاريع التخرج - كلية الحاسبات وتكنولوجيا المعلومات بجامعة العلوم والتكنولوجيا </small>
                      
                    </h2>
                    <ol class="breadcrumb">
                        <li>
                        <i class="fa fa-mortar-board"></i>  GPC |  لجنة المشاريع
                        </li>
                        <li class="active" >
                           
                            <span class="label label-danger"> <i class="fa fa-info-circle"></i> النسخة 1.0 تحت الإنشاء</span>
                           
                        </li>
                       
                    </ol>
                    <div class="pull-left">
                        <a title="النسحة الحديثة"href="{{ url('project-committee/home') }}" class="btn btn-sm btn-info">النسخة الحديثة </a> 
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!--div class="col-lg-3 col-md-3  hidden-sm hidden-xs  "> 
                <img title="GPC" class="img-rounded img-responsive"  src="{{ asset('img\GPC-Boys.png') }}" alt="GPC">
                <hr>
            </div>
            <div class="col-lg-5 col-md-5 text-center  hidden-sm hidden-xs  "> 
                <h2><strong><mark>أستثمر</mark> | في نفسك ...</strong></h2>
                <hr>
            </div>
            <div class="col-lg-4 pull-left "> 
                <img title="GPC" class="img-rounded img-responsive"  src="{{ asset('img\GPC1.png') }}" alt=" #">
                <hr>
               
            </div-->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@Stop