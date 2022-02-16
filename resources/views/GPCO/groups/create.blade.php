@extends('layouts.Master.GPCO') 

@section('title')
    تكوين مجموعة عمل جديدة  
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
                        <li  class="active">
                            <i class="fa fa-plus-circle"></i> أنشاء مجموعة عمل جديدة
                        </li>
                        <li  class="pull-left">
                            <a href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a class="pull-left" href="{{ url('home/GPCO') }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                    <div class="col-md-10 col-xs-12  pagetitle"><i class="fa fa-plus-circle"></i>
                        أنشاء مجموعة عمل جديدة
                    </div>
                </div>
            </div> 
            <!-- /.row -->
            <div class="row"> 
                <div class="col-lg-12 col-md-12">
                    {!! Form::open(['url'=>['create/group']]) !!}
                        <div class="form-group col-lg-6 col-md-6">
                            {!! Form::label('AcademicYear','* العام الجامعي :')!!}
                            {!! Form::select('AcademicYear',AcademicYear(),null,array('required','id'=>'AcademicYear','class'=>'form-control','placeholder'=>'--- أختر العام الجامعي من هنا ---','title'=>'حدد العام الجامعي لهذا المجموعة.')) !!}
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            {!! Form::label('Semester','* الفصل الدراسي :')!!}
                            {!! Form::select('Semester',Semester(),null,array('required','id'=>'Semester','class'=>'form-control','placeholder'=>'--- أختر الفصل الدراسي من هنا ---','title'=>'حدد الفصل الدراسي لهذه المجموعة')) !!}
                        </div>    
                        <div class="form-group col-lg-12 col-md-12">
                            {!! Form::label('proposals_id','* مشروع التخرج الخاص بالمجموعة :')!!}
                            {!! Form::select('proposals_id',$proposal,null,array('required','id'=>'proposals_id','class'=>'form-control','placeholder'=>'--- حدد مشروع التخرج الخاص بالمجموعة ---','title'=>'مشروع التخرج الخاص بالمجموعة')) !!}
                        </div>
                        <div class="form-group col-lg-12 col-md-12">
                            {!! Form::label('branches_id','* المركز الدراسي :')!!}
                            {!! Form::select('branches_id',$Branch,null,array('required','id'=>'branches_id','class'=>'form-control','placeholder'=>'--- حدد المركز الدراسي الخاص بالمجموعة ---','title'=>'حدد المركز الدراسي الخاص بالمجموعة')) !!}
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            {!! Form::label('GroupLader','* رئيس المجموعة :')!!}
                            {!! Form::number('GroupLader',null,array('required','id'=>'GroupLader','class'=>'form-control','placeholder'=>'ادخل الرقم الاكاديمي للرئيس المجموعة','title'=>'الرقم الاكاديمي لرئيس المجموعة')) !!}
                        </div>
                        <div class="form-group col-lg-6 col-md-6 {{ $errors->has('GroupCode') ? ' has-error' : '' }}">
                            {!! Form::label('GroupCode','* رمز الدخول للمجموعة')!!}
                            {!! Form::text('GroupCode',null,array('required','id'=>'GroupCode','class'=>'form-control','placeholder'=>'حدد رمز مناسبة للدخول المجموعة','title'=>'رمز الدخول للمجموعة')) !!}
                            @if ($errors->has('GroupCode'))
                                <div class="form-group col-md-10">
                                    <div class="alert alert-danger " role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> {{ $errors->first('GroupCode') }}</div>  
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-3 col-md-3 ">
                            {!! Form::submit('أنشئ هذا المجموعة',['class'=>'btn btn-success btn-block'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::reset('ألغاء',['class'=>'btn btn-primary'])!!}
                        </div> 
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection