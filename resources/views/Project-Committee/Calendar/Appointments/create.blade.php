@extends('layouts.Master.Project-Committee') 

@section('title')
    أنشاء موعد
@endsection


@section('header')
    {!! Html::style('Templates/Shared-files/css/bootstrap-datetimepicker.min.css') !!}
    <!-- select2 -->
    {!! Html::style('css/select2.min.css') !!}
@endsection 



@section('content')

    <div class="row">
        <div class="col-9">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a  title="التقويم" href="{{ url('project-committee/calendar') }}"><i class="fa fa-calendar"></i> التقويم</a></li>
                    <li class="breadcrumb-item active"> أنشاء موعد</li>
                </ol>
            </nav>
        </div>

        <div class="col-sm">
        <div class="text-left">
        <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('project-committee/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
        </div>
    </div>



    <div class="row">
        <div class="col">
            <div class="card ">
                {!! Form::open(["url"=>"project-committee/calendar/appointments/create"]) !!} 
                    <div class="card-header text-center">
                        <span class="badge badge-pill badge-success"> أنشاء موعد</span>
                        <div class="btn-group btn-group-sm float-left" role="group">
                            <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                            <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>   
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="col-lg-6">
                            <div class="form-group col-lg-12 {{ $errors->has('calendar_id') ? ' has-error' : '' }}">
                                <label for="calendar_id"><span style="color:red;">*</span><strong> التقويم :</strong></label>
                                {{ Form::select('calendar_id',Calendars(), null, ['required','class'=>"select2",'placeholder' => '--- أختر التقويم ---','title'=>'التقويم']) }}
                                @if ($errors->has('Semester'))
                                    <span class="masseg_error">
                                        <strong>{{ $errors->first('calendar_id') }}</strong>
                                    </span>
                                @endif   
                            </div>
                            <div class="clearfix">
                                <div class="form-group col-lg-4{{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type"><span style="color:red;">*</span><strong> نوع الموعد :</strong></label>
                                    {{ Form::select('type',Type_appointments(), null, ['required','class'=>"form-control custom-select",'placeholder' => '','title'=>'نوع الموعد']) }}
                                    @if ($errors->has('type'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif   
                                </div>
                                <div class="form-group col-lg-8 {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name"> <span style="color:red;">*</span><strong> الموضوع :</strong></label>
                                    {!! Form::text('name',null,['required','maxlength'=>'100','id'=>'name','class'=>'form-control','placeholder'=>'موضوع الموعد','title'=>'الموضوع','value'=>"{{Request::old('name')}}"]) !!}
                                    @if ($errors->has('name'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif   
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="form-group col-lg-6 {{ $errors->has('time_open') ? ' has-error' : '' }}">
                                    <label for="time_open"><span style="color:red;">*</span><strong> تاريخ البدء :</strong></label>
                                    <div class="input-group date datetimepicker1" >
                                        {{ Form::text('time_open',null,['class'=>'form-control','readonly','required','title'=>'تاريخ البدء']) }}
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('time_open'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('time_open') }}</strong>
                                        </span>
                                    @endif   
                                </div>
                                <div class="form-group col-lg-6 {{ $errors->has('time_close') ? ' has-error' : '' }}">
                                    <label for="time_close"><span style="color:red;">*</span><strong> تاريخ الانتهاء :</strong></label>
                                    <div class="input-group date datetimepicker1" >
                                        {{ Form::text('time_close',null,['class'=>'form-control','readonly','required','title'=>'تاريخ الانتهاء']) }}
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('time_close'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('time_close') }}</strong>
                                        </span>
                                    @endif   
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group {{ $errors->has('descrdiption') ? ' has-error' : '' }} ">
                                <label for="time_close"><strong>الوصف :</strong></label>
                                {!! Form::textarea('descrdiption',null,['id'=>'descrdiption','class'=>'form-control','title'=>'الوصف','value'=>"{{Request::old('descrdiption')}}"]) !!}
                                @if ($errors->has('descrdiption'))
                                    <span class="masseg_error">
                                        <strong>{{ $errors->first('descrdiption') }}</strong>
                                    </span>
                                @endif   
                            </div> 
            
                        
                        
                        

                        
                                
                                
                        </div>
                    </div> 
                {{ Form::close() }}          
            </div>
        </div>
    </div>
@Stop

@section('footer')
    {!! Html::script('Templates/Shared-files/js/bootstrap-datetimepicker.min.js') !!}
    <script type="text/javascript">
        $(".datetimepicker1").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    </script>  
    <!-- select2 -->
    {!! Html::script('js/select2.min.js') !!}
    <script>
        $('.select2').select2({
            dir: "rtl"
        });
    </script>
@Stop