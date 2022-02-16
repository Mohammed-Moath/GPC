@extends('layouts.Master.Administrator') 

@section('title')
  أضافة طالب 
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a title="المستخدمين" href="{{url('administrator/users')}}"><i class="fa fa-users"></i> المستخدمين </a></li>
                    <li class="breadcrumb-item active">  أضافة طالب </li>
                </ol>
            </nav>
        </div>

        <div class="col-4">
            <div class="text-left">
                <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
                <a title="الرئيسية" href="{{ url('administrator/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
            {{Form::open(['url'=>"administrator/users/add/student"]) }}
                <div class="card-header text-center">
                   <strong> أضافة طالب  </strong>
                    <div class="btn-group btn-group-sm float-left" role="group">
                        <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                        <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>   
                    </div>
                </div>
                <div class="card-body">
                
                    <div class="form-group{{ $errors->has('AcdameicNumber') ? ' has-error' : '' }} col-lg-6 col-md-6">
                        <label for="AcdameicNumber"><span style="color:red;">*</span><strong> الرقم الإكاديمي :</strong></label>
                        {!! Form::number('AcdameicNumber',null,['required','maxlength'=>'20','class'=>'form-control','placeholder'=>'ضع هنا الرقم الاكاديمي للطالب','title'=>'الرقم الإكاديمي'])!!}
                        @if ($errors->has('AcdameicNumber'))
                            <span class="masseg_error">
                                <strong>{{ $errors->first('AcdameicNumber') }}</strong>
                            </span>
                        @endif     
                    </div>
                    <div class="form-group{{ $errors->has('IDNumber') ? ' has-error' : '' }} col-lg-6 col-md-6">
                        <label for="IDNumber"><span style="color:red;">*</span><strong> رقم المعرف الشخصي :</strong></label>
                        {!! Form::number('IDNumber',null,['required','maxlength'=>'20','class'=>'form-control','placeholder'=>'ضع هنا رقم المعرف الشخصي الخاصة بالطالب','title'=>'رقم المعرف الشخصي']) !!}
                        @if ($errors->has('IDNumber'))
                            <span class="masseg_error">
                                <strong>{{ $errors->first('IDNumber') }}</strong>
                            </span>
                        @endif   
                    </div>

                    <div class="clearfix">
                        <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }} col-lg-6 col-md-6">
                            <label for="Name"><span style="color:red;">*</span><strong> أسم الطالب :</strong></label>
                            {!! Form::text('Name',null,['required','maxlength'=>'100','class'=>'form-control','placeholder'=>'ضع هنا أسم الطالب','title'=>'أسم الطالب']) !!}
                            @if ($errors->has('Name'))
                                <span class="masseg_error">
                                    <strong>{{ $errors->first('Name') }}</strong>
                                </span>
                            @endif   
                        </div>

                        <div class="form-group col-lg-3 col-md-3">
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
                        <div class="form-group col-lg-3 col-md-3">
                            <label title="أنثي" class=" input-group-addon">
                                <label class="custom-control custom-radio">
                                    <input id="" name="Gender" type="radio" value="انثي" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                </label>
                                <span><strong>انثي</strong></span>
                            </label> 
                        </div>
                    </div>
        
                    <div class="clearfix"></div>
                        <div class="form-group {{ $errors->has('Program') ? ' has-error' : '' }} col-lg-6 col-md-6">
                            <label for="Program"><span style="color:red;">*</span><strong> التخصص :</strong></label>
                            {!! Form::select('Program',Programs(),null,array('required','id'=>'Program','class'=>'form-control','placeholder'=>'--- أختر التخصص من هنا ---','title'=>'أختر تخصص الطالب ')) !!}
                            @if ($errors->has('Program'))
                                <span class="masseg_error">
                                    <strong>{{ $errors->first('Program') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group {{ $errors->has('Branch') ? ' has-error' : '' }} col-lg-6 col-md-6">
                            <label for="Branch"><span style="color:red;">*</span><strong> المركز الدراسي :</strong></label>
                            {!! Form::select('Branch',Branch(),null,array('required','id'=>'Branch','class'=>'form-control','placeholder'=>'--- اختر المركز الدراسي من هنا ---','title'=>'أختر المركز الدراسي للطالب')) !!}
                            @if ($errors->has('Branch'))
                                <span class="masseg_error">
                                    <strong>{{ $errors->first('Branch') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group{{ $errors->has('HoursCompleted') ? ' has-error' : '' }} col-lg-6 col-md-6">
                            <label for="HoursCompleted"><span style="color:red;">*</span><strong> عدد الساعات المعتمدة :</strong></label>
                            {!! Form::number('HoursCompleted',null,['required','maxlength'=>'5','class'=>'form-control','placeholder'=>' ضع هنا اجمالي عدد الساعات المعتمدة للطالب','title'=>'عدد الساعات المعتمدة']) !!}
                            @if ($errors->has('HoursCompleted'))
                                <span class="masseg_error">
                                    <strong>{{ $errors->first('HoursCompleted') }}</strong>
                                </span>
                            @endif   
                        </div>

                    <div class="clearfix"></div>
                    <div class="form-group{{ $errors->has('PhoneNumber') ? ' has-error' : '' }} col-lg-6 col-md-6">
                        <label for="PhoneNumber"><strong>  رقم الهاتف :</strong></label>
                        {!! Form::number('PhoneNumber',null,['maxlength'=>'100','class'=>'form-control','placeholder'=>'ضع هنا رقم الهاتف الخاص بالطالب','title'=>'رقم الهاتف']) !!}
                        @if ($errors->has('PhoneNumber'))
                            <span class="masseg_error">
                                <strong>{{ $errors->first('PhoneNumber') }}</strong>
                            </span>
                        @endif   
                    </div>
                    <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }} col-lg-6 col-md-6">
                        <label for="PhoneNumber"><strong>  الإيميل :</strong></label>
                        {!! Form::email('Email',null,['maxlength'=>'100','class'=>'form-control','placeholder'=>'ضع هنا إيميل الطالب','title'=>'الإيميل']) !!}
                        @if ($errors->has('Email'))
                            <span class="masseg_error">
                                <strong>{{ $errors->first('Email') }}</strong>
                            </span>
                        @endif   
                    </div>
                    <div class="form-group col-lg-12 col-md-12">
                        <label for="IsActive"><span style="color:red;">*</span><strong> هل ترغب في تفعيل حساب لهذا الطالب ام لا</strong></label>
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
            {{ Form::close() }} 
            </div>
        </div>
    </div>
@Stop

