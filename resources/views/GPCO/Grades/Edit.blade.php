@extends('layouts.Master.GPCO') 

@section('title')
    تعديل الدرجات 
@endsection 



@section('content')
   <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-check-square-o"></i> الدرجات 
                    </h3>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a title="الدرجات" href="{{ url('GPCO/grades') }}"><i class="fa fa-check-square-o"></i> الدرجات </a>
                        </li>
                        <li>
                            تعديل درجات | {{ isset($Student_Degree->users->Name) !=null ? $Student_Degree->users->Name : 'لاتوجد بيانات ليتم عرضها !'}}
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
            <div class="col-lg-3">
                    <span class="image-user-stu text-center">
                        <img class="img-rounded"  src="{{ asset($Student_Degree->users->PresonalPicture) }}" alt="  خطأ غير متوقع في تحميل صورة الطالب |  {{ $Student_Degree->users->Name}}"> 
                        <h3>
                            <span class="label label-default"> {{ isset($Student_Degree->users->Name) !=null ? $Student_Degree->users->Name : 'لاتوجد بيانات ليتم عرضها !'}}</span>
                        </h3>
                        <p>
                            <a title="تفاصيل" href="{{ url("student-data/show/$Student_Degree->AcdameicNumber") }}" class="btn btn-primary btn-xs "><i class="fa fa-folder-open"></i></a>
                            <span class="label label-info">{{ isset($Student_Degree->programs->ProgramName) !=null ? $Student_Degree->programs->ProgramName : 'لاتوجد بيانات ليتم عرضها !'}}</span>
                        </p>
                        <hr> 
                    </span>
                 
                </div>
                <div class="col-lg-3">
                    {{ Form::model($Student_Degree,array('method'=>'PATCH','url'=>['GPCO/grades',$Student_Degree->AcdameicNumber,'update'])) }}
                        <div class="form-group input-group ">
                            <span class="input-group-addon"><strong>درجة الحضور </strong></span>
                            {{ Form::number('Degree_attendance',null, ['class'=>'form-control']) }}
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><strong>درجة التسليمات </strong></span>
                            {{ Form::number('Degree_delivery',null, ['class'=>'form-control']) }}
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><strong>درجة المشرف </strong></span>
                            {{ Form::number('Degree_Supervisor',null, ['class'=>'form-control','disabled']) }}
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><strong>درجة المناقشة النصفية </strong></span>
                            {{ Form::number('Degree_Midterm_discussion',null, ['class'=>'form-control','required']) }}
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><strong>درجة المناقشة النهائية </strong></span>
                            {{ Form::number('Degree_Final_discussion',null, ['class'=>'form-control','required']) }}
                        </div>
                    
                        <div class="form-group">
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


