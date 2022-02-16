@extends('layouts.Master.Administrator')

@section('title',"اضافة - $user_role_name")

@section('content')
<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="المستخدمين" href="{{url('administrator/users')}}"><i class="fa fa-users"></i> المستخدمين </a></li>
                <li class="breadcrumb-item active"> اضافة - {{ $user_role_name }} </li>
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
            {{Form::open(['url'=>"administrator/users/add/$user_role"]) }}
            <div class="card-header text-center">
                <b>اضافة - {{ $user_role_name }}</b>
                <div class="btn-group btn-group-sm float-left" role="group">
                    <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                    <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group col-lg-12 col-md-12{{ $errors->has('Name') ? ' has-error' : '' }}">
                        <label for="Name"><span style="color:red;">*</span> <b>الاسم الرباعي :</b></label>
                        {!! Form::text('Name',null,['required','maxlength'=>'100','class'=>'form-control','placeholder'=>'الاسم الرباعي','title'=>'الاسم الرباعي']) !!}
                        @if ($errors->has('Name'))
                        <span class="masseg_error">
                            {{ $errors->first('Name') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username"><span style="color:red;">*</span><b> أسم المستخدم :</b></label>
                        {!! Form::text('username',null,array('required','maxlength'=>'50','id'=>'username','class'=>'form-control','placeholder'=>'أسم المتسخدم','title'=>'أسم المستخدم')) !!}
                        <span class="masseg_error">
                            {{ $errors->first('username') }}
                        </span>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('Email') ? ' has-error' : '' }}">
                        <label for="Email"><span style="color:red;">*</span><b> الايميل :</b></label>
                        {!! Form::email('Email',null,array('required','id'=>'Email','class'=>'form-control','placeholder'=>'الأيميل ','title'=>'الأيميل')) !!}
                        <span class="masseg_error">
                            {{ $errors->first('Email') }}
                        </span>
                    </div>
                    <div class="form-group col-lg-6 col-md-6{{ $errors->has('PhoneNumber') ? ' has-error' : '' }}">
                        <label for="PhoneNumber"><span style="color:red;">*</span><b> رقم الهاتف :</b></label>
                        {!! Form::number('PhoneNumber',null,array('required','maxlength'=>'20','id'=>'PhoneNumber','class'=>'form-control','placeholder'=>'رقم الهاتف','title'=>'رقم الهاتف')) !!}
                        <span class="masseg_error">
                            {{ $errors->first('PhoneNumber') }}
                        </span>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password"><span style="color:red;">*</span><b> كلمة المرور :</b></label>
                        {!! Form::text('password',null,array('required','maxlength'=>'250','id'=>'password','class'=>'form-control','placeholder'=>'كلمة المرور','title'=>'كلمة المرور')) !!}
                        <span class="masseg_error">
                            {{ $errors->first('password') }}
                        </span>
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label title="ذكر" class=" input-group-addon {{ $errors->has('Gender') ? ' has-error' : '' }}">
                            <label class="custom-control custom-radio">
                                <input id="" name="Gender" type="radio" value="ذكر" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span class="span_radio"><b>ذكر</b></span>
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
                            <span class="span_radio"><b>انثي</b></span>
                        </label>
                    </div>
                    <div class="form-group col-lg-6 col-md-6{{ $errors->has('IsActive') ? ' has-error' : '' }} ">
                        <label title="تفعيل الحساب" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="IsActive" type="radio" value="1" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span class="span_radio"><b>تفعيل الحساب</b></span>
                        </label>
                        @if ($errors->has('IsActive'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('IsActive') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6{{ $errors->has('IsActive') ? ' has-error' : '' }}">
                        <label title="تعطيل الحساب" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="IsActive" type="radio" value="0" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>

                            <span class="span_radio"><b>تعطيل الحساب</b></span>
                        </label>
                    </div>
                </div>
                @if($user_role == 3)
                <div class="col-lg-6 col-md-6">
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('AcdameicNumber') ? ' has-error' : '' }}">
                        <label for="AcdameicNumber"><span style="color:red;">*</span><b> الرقم الإكاديمي :</b></label>
                        {!! Form::number('AcdameicNumber',null,['required','maxlength'=>'20','class'=>'form-control','placeholder'=>'رقم الطالب الاكاديمي','title'=>'الرقم الإكاديمي'])!!}
                        @if ($errors->has('AcdameicNumber'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('AcdameicNumber') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('HoursCompleted') ? ' has-error' : '' }}">
                        <label for="HoursCompleted"><span style="color:red;">*</span><b> الساعات الدراسية المنجزة :</b></label>
                        {!! Form::number('HoursCompleted',null,['required','maxlength'=>'5','class'=>'form-control','placeholder'=>'عدد الساعات المنجزة','title'=>'عدد الساعات المنجزة']) !!}
                        @if ($errors->has('HoursCompleted'))
                        <span class="masseg_error">
                            {{ $errors->first('HoursCompleted') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('Program') ? ' has-error' : '' }}">
                        <label for="Program"><span style="color:red;">*</span><b> التخصص :</b></label>
                        {!! Form::select('Program',Programs(),null,array('required','id'=>'Program','class'=>'form-control','placeholder'=>'--- التخصصات ---','title'=>'تخصص الطالب')) !!}
                        @if ($errors->has('Program'))
                        <span class="masseg_error">
                            {{ $errors->first('Program') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('Branch') ? ' has-error' : '' }}">
                        <label for="Branch"><span style="color:red;">*</span><b> المركز الدراسي :</b></label>
                        {!! Form::select('Branch',Branch(),null,array('required','id'=>'Branch','class'=>'form-control','placeholder'=>'--- المراكز الدراسية ---','title'=>'المركز الدراسي')) !!}
                        @if ($errors->has('Branch'))
                        <span class="masseg_error">
                            {{ $errors->first('Branch') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label for="Training"><b>هل قام بالتدريب الميداني ؟</b></label>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 {{ $errors->has('Training') ? ' has-error' : '' }}">
                        <label title="نعم" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="Training" type="radio" value="Yes" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span class="span_radio"><b>نعم</b></span>
                        </label>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 {{ $errors->has('Training') ? ' has-error' : '' }}">
                        <label title="لا" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="Training" type="radio" value="No" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>

                            <span class="span_radio"><b>لا</b></span>
                        </label>
                    </div>
                </div>
                @endif
                @if($user_role == 4)
                <div class="col-lg-6 col-md-6">
                    <div class="form-group col-lg-6 col-md-6 {{ $errors->has('FunctionalNumber') ? ' has-error' : '' }}">
                        <label for="FunctionalNumber"><span style="color:red;">*</span><b> الرقم الوظيفي</b></label>
                        {!! Form::number('FunctionalNumber',null,['required','maxlength'=>'20','class'=>'form-control','placeholder'=>'الرقم الوظيفي','title'=>'الرقم الوظيفي'])!!}
                        @if ($errors->has('FunctionalNumber'))
                        <span class="masseg_error">
                            {{ $errors->first('FunctionalNumber') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label for="scientific_degrees_id"><b> الرتبة العلمية : </b></label>
                        {!! Form::select('scientific_degrees_id',ScientificDegree(),null,array('id'=>'scientific_degrees_id','class'=>'form-control','placeholder'=>'--- الرتب العلمية ---','title'=>'الرتبة العلمية')) !!}
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label for="Program"><b> التخصص :</b></label>
                        {!! Form::select('Program',Programs(),null,array('id'=>'Program','class'=>'form-control','placeholder'=>'--- التخصصات ---','title'=>'تخصص المشرف')) !!}
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label for="teachring_hours"><b> الساعات التدريسية / الاسبوع</b></label>
                        {!! Form::number('teachring_hours',null,['maxlength'=>'5','class'=>'form-control','placeholder'=>'الساعات التدريسية','title'=>'الساعات التدريسية']) !!}
                      
                    </div>
                    <div class="form-group col-lg-12 col-md-12">
                        <label for="teacher_staut"><b>الحالة الاكاديمية : </b></label>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 ">
                        <label title="نعم" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="teacher_staut" type="radio" value="Yes" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span class="span_radio"><b>مشغول</b></span>
                        </label>
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <label title="لا" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                <input id="" name="teacher_staut" type="radio" value="No" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>

                            <span class="span_radio"><b>متفرغ</b></span>
                        </label>
                    </div>
                </div>
                @endif
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div><br>
@Stop