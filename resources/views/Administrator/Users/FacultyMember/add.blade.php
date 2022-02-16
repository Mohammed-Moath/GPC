@extends('layouts.Master.Administrator')

@section('title')
أضافة عضو هيئة التدريس
@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="المستخدمين" href="{{url('administrator/users')}}"><i class="fa fa-users"></i> المستخدمين </a></li>
                <li class="breadcrumb-item active"> أضافة عضو هيئة التدريس </li>
            </ol>
        </nav>
    </div>

    <div class="col-4">
        <div class="text-left">
            <a title="رجوع" href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('administrator/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            {{Form::open(['url'=>"administrator/users/add/FacultyMember"]) }}
            <div class="card-header text-center">
                <strong> أضافة عضو هيئة التدريس </strong>
                <div class="btn-group btn-group-sm float-left" role="group">
                    <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                    <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group{{ $errors->has('FunctionalNumber') ? ' has-error' : '' }}">
                        <label for="FunctionalNumber"><span style="color:red;">*</span><strong> الرقم الوظيفي</strong></label>
                        {!! Form::number('FunctionalNumber',null,['required','maxlength'=>'20','class'=>'form-control','placeholder'=>'الرقم الوظيفي','title'=>'الرقم الوظيفي'])!!}
                        @if ($errors->has('FunctionalNumber'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('FunctionalNumber') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }}">
                        <label for="Name"><span style="color:red;">*</span><strong> الاسم الرباعي :</strong></label>
                        {!! Form::text('Name',null,['required','maxlength'=>'100','class'=>'form-control','placeholder'=>'الاسم الرباعي','title'=>'الاسم الرباعي']) !!}
                        @if ($errors->has('Name'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('Name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('scientific_degrees_id') ? ' has-error' : '' }}">
                        <label for="scientific_degrees_id"><span style="color:red;">*</span><strong> الرتبة العلمية : </strong></label>
                        {!! Form::select('scientific_degrees_id',ScientificDegree(),null,array('required','id'=>'scientific_degrees_id','class'=>'form-control','placeholder'=>'--- الرتب العلمية ---','title'=>'الرتبة العلمية')) !!}
                        @if ($errors->has('scientific_degrees_id'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('scientific_degrees_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('PhoneNumber') ? ' has-error' : '' }}">
                        <label for="PhoneNumber"><span style="color:red;">*</span><strong> رقم الهاتف :</strong></label>
                        {!! Form::number('PhoneNumber',null,array('required','maxlength'=>'20','id'=>'PhoneNumber','class'=>'form-control','placeholder'=>'رقم الهاتف','title'=>'رقم الهاتف')) !!}
                        <span class="masseg_error">
                            <strong>{{ $errors->first('PhoneNumber') }}</strong>
                        </span>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                        <label for="Email"><span style="color:red;">*</span><strong> الايميل :</strong></label>
                        {!! Form::email('Email',null,array('required','id'=>'Email','class'=>'form-control','placeholder'=>'الأيميل ','title'=>'الأيميل')) !!}
                        <span class="masseg_error">
                            <strong>{{ $errors->first('Email') }}</strong>
                        </span>
                    </div>
                    <div class="form-group{{ $errors->has('IDNumber') ? ' has-error' : '' }}">
                        <label for="IDNumber"><span style="color:red;">*</span><strong> كلمة المرور</strong></label>
                        {!! Form::number('IDNumber',null,['required','maxlength'=>'20','class'=>'form-control','placeholder'=>'كلمة المرور','title'=>'كلمة المرور']) !!}
                        @if ($errors->has('IDNumber'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('IDNumber') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label title="ذكر" class=" input-group-addon {{ $errors->has('Gender') ? ' has-error' : '' }}">
                            <label class="custom-control custom-radio">
                                <input id="" name="Gender" type="radio" value="ذكر" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span><strong>ذكر</strong></span>
                        </label>
                        @if ($errors->has('Gender'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('Gender') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label title="أنثي" class=" input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="Gender" type="radio" value="انثي" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span><strong>انثي</strong></span>
                        </label>
                    </div>
                    <div class="form-group{{ $errors->has('IsActive') ? ' has-error' : '' }} col-lg-6 col-md-6">
                        <label title="تفعيل الحساب" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="IsActive" type="radio" value="1" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span><strong>تفعيل الحساب</strong></span>
                        </label>
                        @if ($errors->has('IsActive'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('IsActive') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('IsActive') ? ' has-error' : '' }} col-lg-6 col-md-6">
                        <label title="تعطيل الحساب" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="IsActive" type="radio" value="0" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>

                            <span><strong>تعطيل الحساب</strong></span>
                        </label>
                    </div>

                </div>


            </div>
            {{ Form::close() }}
        </div>
    </div>
</div><br>
@Stop