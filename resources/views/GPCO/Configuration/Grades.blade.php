@extends('layouts.Master.GPCO') 

@section('title')
 التهيئة  | الدرجات
@endsection 


@section('content')
   <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-gear"></i> التهيئة 
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-gear"></i> التهيئة</a>
                        </li>
                        <li  class="active">
                            الدرجات
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
                <div class="col-lg-10 pagetitle">الدرجات</div>
            </div>
            <!-- /.row --> 
            <div class="row">
                <div class="col-lg-12">
                {{ Form::model(Grades(),array('method'=>'PATCH','url'=>['settings/grades',Grades()->id,'update'])) }}
                    <div class="form-group col-lg-3">
                            <label for="DegreeOfAttendance">درجة الحضور :</label>
                            {{ Form::number('DegreeOfAttendance',null, ['class'=>'form-control','required']) }}
                    </div>
                    <div class="form-group col-lg-3">
                            <label for="DegreeOfDelivery">درجة التسليمات :</label>
                            {{ Form::number('DegreeOfDelivery',null, ['class'=>'form-control','required']) }}
                    </div>
                    <div class="form-group col-lg-3">
                            <label for="DegreeOfSupervisor">درجة المشرف :</label>
                            {{ Form::number('DegreeOfSupervisor',null, ['class'=>'form-control','required']) }}
                    </div>
                    <div class="form-group col-lg-3">
                            <label for="DegreeOfMidtermDiscussion">درجة المناقشة النصفية :</label>
                            {{ Form::number('DegreeOfMidtermDiscussion',null, ['class'=>'form-control','required']) }}
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="DegreeOfFinalDiscussion">درجة المناقشة النهائية :</label>
                        {{ Form::number('DegreeOfFinalDiscussion',null, ['class'=>'form-control','required']) }}
                    </div>
                   
                  

                    <div class="form-group col-lg-3">
                        <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-check-circle"></i> حفظ</button>
                        <button type="reset" class="btn btn-danger btn-block"> <i class="fa fa-times-circle"></i> الغاء</button>         
                    </div>
                         
                {{ Form::close() }}                  
                </div>
            </div>
            <!-- /.row -->    
        </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@Stop

