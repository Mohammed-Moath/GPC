@extends('layouts.Master.FacultyMember') 

  @section('title')

تسجيل كمشرف مشروع
@endsection

@section('content')
<!-- Blog Entries Column -->

  <h1 class="page-header">
    تسجيل كمشرف لمشاريع التخرج <span class="glyphicon glyphicon-education" aria-hidden="true"></span>
  </h1>
  <div class="col-md-6">
    {{ Form::open(['url'=>'Registration/FacultyMember']) }}
      <div class="form-group">
        {!! Form::label('FunctionalNumber', '* تأكيد الرقم الوظيفي الخاص بك :')!!}
        {!! Form::number('FunctionalNumber',null,['required','maxlength'=>'20','id'=>'FunctionalNumber','class'=>'form-control','placeholder'=>'الرجاء أدخال الرقم الوظيفي الخاص بك لعملية التحقق','title'=>'الرقم الوظيفي'])!!}
      </div>
      <div class="form-group">
        {!! Form::label('HoursOfService', '* عدد ساعات التدريس في  الاسبوع :')!!}
        {!! Form::number('HoursOfService',null,['required','maxlength'=>'11','id'=>'HoursOfService','class'=>'form-control','placeholder'=>'عدد ساعات التدريس في الاسبوع','title'=>'عدد ساعات التدريس في الاسبوع'])!!}
      </div>
      <div class="form-group">
        {!! Form::label('scientific_degrees_id', '* الدرجة العلمية الحاصل عليها :')!!}
        {!! Form::select('scientific_degrees_id',ScientificDegrees(),null,array('required','id'=>'scientific_degrees_id','class'=>'form-control','placeholder'=>'--- أختر درجتك العلمية من هنا ---','title'=>'الدرجة العلمية')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('programs_id', '* التخصص العلمي :')!!}
        {!! Form::select('programs_id',Programs(),null,array('required','id'=>'programs_id','class'=>'form-control','placeholder'=>'--- أختر تخصصك العلمي من هنا ---','title'=>'التخصص العلمي')) !!}
      </div>
      <button type="submit" class="btn btn-primary form-control"> تسجيل <i class="fa fa-pencil-square-o"></i></button>
    {{ Form::close() }}
  </div>

@endsection 
          