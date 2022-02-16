@extends('layouts.Master.GPCO') 

@section('title')
 التهيئة  | الشروط 
@endsection 

@section('header')
    <!-- bootstrap-daterangepicker -->
    {!! Html::style('css/daterangepicker.css') !!}
    <!-- bootstrap-datetimepicker -->
    {!! Html::style('css/bootstrap-datetimepicker.css') !!}
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
                            <i class="fa fa-gear"></i> التهيئة
                        </li>
                        <li  class="active">
                           الشروط
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
                <div class="col-lg-10 pagetitle"> الشروط</div>
            </div>
            <!-- /.row --> 
            <div class="row">
                <div class="col-lg-12">
                {{ Form::model(Calendar_GPC(),array('method'=>'PATCH','url'=>['configuration/conditions',Calendar_GPC()->id,'update'])) }}
                   <div class="form-group col-lg-6">
                        <label for="AcademicYear">العام الجامعي :</label>
                        {{ Form::select('AcademicYear', AcademicYear(), null, ['class'=>'form-control','required','placeholder' => '--- أختر العام الجامعي  ---']) }}
                   </div>
                    <div class="form-group col-lg-6">
                        <label for="Semester">الفصل الدراسي :</label>
                        {{ Form::select('Semester',Semester(), null, ['required','class'=>'form-control','placeholder' => '--- أختر الفصل الدراسي ---']) }}
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="SubmissionProposals">اخر موعد لتقديم مقترحات مشاريع التخرج :</label>
                        <div class="input-group date myDatepicker1" >
                            {{ Form::text('SubmissionProposals',null,['class'=>'form-control','readonly']) }}
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-3">
                            <label for="Number_AddProposalStudent">عدد مقترحات المشاريع المتاح أضافتها من قبل الطلبة : </label>
                            {{ Form::select('Number_AddProposalStudent', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div>
                    
                    <div class="form-group col-lg-3">
                            <label for="Number_AddProposalTeacher">عدد مقترحات المشاريع المتاح أضافتها من قبل أعضاء هيئة التدريس :</label>
                            {{ Form::select('Number_AddProposalTeacher', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div>
         
                    <div class="form-group col-lg-6">
                        <label for="createGroup"> اخر موعد لإنشاء مجموعات مشاريع التخرج :</label>
                        <div class="input-group myDatepicker1" >
                            {{ Form::text('createGroup',null,['class'=>'form-control','readonly']) }}  
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="ChooseWishes">أخر موعد لاختيار رغبات المشاريع للمجوعات :</label>
                        <div class="input-group myDatepicker1" >
                            {{ Form::text('ChooseWishes',null,['class'=>'form-control','readonly']) }}  
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                            <label for="Number_chooseWishes">عدد الرغبات المتاح اختيارها للمجموعة :</label>
                            {{ Form::select('Number_chooseWishes', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div>
                    <div class="form-group col-lg-3">
                            <label for="Min_Number_StudentinGroup">أقل عدد للطلاب في المجموعة الواحده :</label>
                            {{ Form::select('Min_Number_StudentinGroup', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div>
                    <div class="form-group col-lg-3">
                            <label for="Number_StudentinGroup">أقصى عدد للطلاب في المجموعة الواحده :</label>
                            {{ Form::select('Number_StudentinGroup', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div> 

                    <div class="form-group col-lg-3">
                            <label for="Max_Certified_Project_GroupB">يسمح باعتماد المشروع للطلاب لاقصي عدد من المجموعات : </label>
                            {{ Form::select('Max_Certified_Project_GroupB', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div>
                    <div class="form-group col-lg-3">
                            <label for="Max_Certified_Project_GroupG">يسمح باعتماد المشروع للطالبات لاقصي عدد من المجموعات : </label>
                            {{ Form::select('Max_Certified_Project_GroupG', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div> 
                    <div class="form-group col-lg-3">
                            <label for="Max_Supervisor_GroupsB">يسمح لعضو هيئة التدريس ان يشرف كاقصي حد لعدد مجموعات طلاب : </label>
                            {{ Form::select('Max_Supervisor_GroupsB', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
                    </div> 
                    <div class="form-group col-lg-3">
                            <label for="Max_Supervisor_GroupsG">يسمح لعضو هيئة التدريس ان يشرف كاقصي حد لعدد مجموعات طالبات : </label>
                            {{ Form::select('Max_Supervisor_GroupsG', Number(), null, ['class'=>'form-control','required','placeholder' => '--- أختر رقماً من هنا  ---']) }}
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

@section('footer')
   
    <!-- bootstrap-daterangepicker -->
    {!! Html::script('js/moment.min.js') !!}
    {!! Html::script('js/daterangepicker.js') !!}
    <!-- bootstrap-datetimepicker -->    
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
    <!-- Initialize datetimepicker -->
    <script>
        $('.myDatepicker1').datetimepicker({
            ignoreReadonly: true,
            allowInputToggle: true
           
           
        });
    </script>
@Stop