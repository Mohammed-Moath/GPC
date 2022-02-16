@extends('layouts.Master.Administrator')

@section('title')
تعديل بيانات المستخدم رقم : {{ isset($user->id) !=null ?$user->id : ''}}
@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="المستخدمين" href="{{url('administrator/users')}}"><i class="fa fa-users"></i> المستخدمين </a></li>
                <li class="breadcrumb-item active"> تعديل بيانات المستخدم رقم : {{ isset($user->id) !=null ?$user->id : ''}} </li>
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
            {{ Form::model($user,['method'=>'PATCH','url'=>['administrator/users',$user->id,'update'],'files'=>true]) }}
            <div class="card-header text-center">
                <strong> تعديل بيانات المستخدم رقم : {{ isset($user->id) !=null ?$user->id : ''}} </strong>
                <div class="btn-group btn-group-sm float-left" role="group">
                    <button titlel="تغير كلمة المرور" type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#change_password"><i class="fa fa-key"></i> تغير كلمة المرور </button>
                    <button title="تعديل" type="submit" class="btn btn-outline-warning"> <i class="fa fa-edit"></i> تعديل</button>
                    <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }}">
                        <label for="Name"><span style="color:red;">*</span><strong> الاسم الرباعي :</strong></label>
                        {!! Form::text('Name',null,['required','maxlength'=>'100','class'=>'form-control','placeholder'=>'الاسم الرباعي','title'=>'الاسم الرباعي']) !!}
                        @if ($errors->has('Name'))
                        <span class="masseg_error">
                            <strong>{{ $errors->first('Name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username"><span style="color:red;">*</span><strong> أسم المستخدم :</strong></label>
                        {!! Form::text('username',null,array('required','maxlength'=>'50','id'=>'username','class'=>'form-control','placeholder'=>'أسم المتسخدم','title'=>'أسم المستخدم')) !!}
                        <span class="masseg_error">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    </div>
                    <div class="form-group{{ $errors->has('PhoneNumber') ? ' has-error' : '' }}">
                        <label for="PhoneNumber"><span style="color:red;">*</span><strong> رقم الهاتف :</strong></label>
                        {!! Form::number('PhoneNumber',null,array('required','maxlength'=>'20','id'=>'PhoneNumber','class'=>'form-control','placeholder'=>'رقم الهاتف','title'=>'رقم الهاتف')) !!}
                        <span class="masseg_error">
                            <strong>{{ $errors->first('PhoneNumber') }}</strong>
                        </span>
                    </div>
                    <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                        <label for="Email"><span style="color:red;">*</span><strong> الايميل :</strong></label>
                        {!! Form::email('Email',null,array('required','id'=>'Email','class'=>'form-control','placeholder'=>'الأيميل ','title'=>'الأيميل')) !!}
                        <span class="masseg_error">
                            <strong>{{ $errors->first('Email') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="form-group col-lg-6">
                        <label title="ذكر" class=" input-group-addon {{ $errors->has('Gender') ? ' has-error' : '' }}">
                            <label class="custom-control custom-radio">
                                {{ Form::radio('Gender', 'ذكر',null,['class'=>'custom-control-input']) }}
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
                    <div class="form-group col-lg-6">
                        <label title="أنثي" class=" input-group-addon">
                            <label class="custom-control custom-radio">
                                {{ Form::radio('Gender', 'انثي',null,['class'=>'custom-control-input']) }}
                                <span class="custom-control-indicator"></span>
                            </label>
                            <span><strong>انثي</strong></span>
                        </label>
                    </div>

                    <div class="form-group{{ $errors->has('IsActive') ? ' has-error' : '' }} col-lg-6">
                        <label title="تفعيل الحساب" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                {{ Form::radio('IsActive', '1',null,['class'=>'custom-control-input']) }}
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
                    <div class="form-group{{ $errors->has('IsActive') ? ' has-error' : '' }} col-lg-6">
                        <label title="تعطيل الحساب" class="radio radio-inline input-group-addon">
                            <label class="custom-control custom-radio">
                                {{ Form::radio('IsActive', '0',null,['class'=>'custom-control-input']) }}
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
</div>
@include('Administrator.Users.change_password')
@Stop