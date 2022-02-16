@extends('layouts.Master.Project-Committee') 

@section('title')
  درجات
@endsection

@section('content')

    <div class="row">
        <div class="col-9">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">درجات</a></li>
                </ol>
            </nav>
        </div>

        <div class="col-sm">
            <div class="text-left">
                    <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
                <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                {{ Form::model(Grades(),array('method'=>'PATCH','url'=>['project-committee/configuration/grades',Grades()->id,'update'])) }}
                    <div class="card-header text-center">
                        <span class="badge badge-pill badge-info"> درجات</a></span>
                        <div class="btn-group btn-group-sm float-left" role="group">
                            <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                            <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>   
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="form-group col-md-2 {{ $errors->has('DegreeOfAttendance') ? 'has-error' : '' }}">
                            <label for="DegreeOfAttendance"><strong> درجة الحضور :</strong></label>
                            {{ Form::number('DegreeOfAttendance',null, ['class'=>'form-control','required']) }}
                            @if ($errors->has('DegreeOfAttendance'))
                                <div class="masseg_error">
                                    {{ $errors->first('DegreeOfAttendance') }}
                                </div>  
                            @endif
                        </div>
                        <div class="form-group col-md-2 {{ $errors->has('DegreeOfDelivery') ? 'has-error' : '' }}">
                            <label for="DegreeOfDelivery"><strong> درجة التسليمات :</strong></label>
                            {{ Form::number('DegreeOfDelivery',null, ['class'=>'form-control','required']) }}
                            @if ($errors->has('DegreeOfDelivery'))
                                <div class="masseg_error">
                                    {{ $errors->first('DegreeOfDelivery') }}
                                </div>  
                            @endif
                        </div>
                        <div class="form-group col-md-2 {{ $errors->has('DegreeOfSupervisor') ? 'has-error' : '' }}">
                            <label for="DegreeOfSupervisor"><strong> درجة المشرف :</strong></label>
                            {{ Form::number('DegreeOfSupervisor',null, ['class'=>'form-control','required']) }}
                            @if ($errors->has('DegreeOfSupervisor'))
                                <div class="masseg_error">
                                    {{ $errors->first('DegreeOfSupervisor') }}
                                </div>  
                            @endif
                        </div>
                        <div class="form-group col-md-3  {{ $errors->has('DegreeOfMidtermDiscussion') ? 'has-error' : '' }}">
                            <label for="DegreeOfMidtermDiscussion"><strong> درجة المناقشة النصفية :</strong></label>
                            {{ Form::number('DegreeOfMidtermDiscussion',null, ['class'=>'form-control','required']) }}
                            @if ($errors->has('DegreeOfMidtermDiscussion'))
                                <div class="masseg_error">
                                    {{ $errors->first('DegreeOfMidtermDiscussion') }}
                                </div>  
                            @endif
                        </div>
                        <div class="form-group col-md-3  {{ $errors->has('DegreeOfFinalDiscussion') ? 'has-error' : '' }}">
                            <label for="DegreeOfFinalDiscussion"><strong> درجة المناقشة النهائية :</strong></label>
                            {{ Form::number('DegreeOfFinalDiscussion',null, ['class'=>'form-control','required']) }}
                            @if ($errors->has('DegreeOfFinalDiscussion'))
                                <div class="masseg_error">
                                    {{ $errors->first('DegreeOfFinalDiscussion') }}
                                </div>  
                            @endif
                        </div>
                    </div>
                {{ Form::close() }}     
            </div>
        </div>
    </div>
@Stop