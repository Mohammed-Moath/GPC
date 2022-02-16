@extends('layouts.Master.Administrator') 

@section('title')
 عام 
@endsection

@section('header')
    {!! Html::style('Templates/Shared-files/css/bootstrap-datetimepicker.min.css') !!}
@endsection 


@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">  <i class="fa fa-gear"></i> التهيئة </li>
                    <li class="breadcrumb-item active"> عام </li>
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

    {{ Form::model(Constraint(),array('method'=>'PATCH','url'=>['project-committee/configuration/constraint',Constraint()->id,'update'])) }}
        <div class="row">
            <div class="col">
                <div class="card card border-info border-bottom-0 mb-3">
                    <div class="card-body text-danger">
                        <i class="fa fa-info-circle"></i>
                            هنا يتم تحديد الإعدادات العامة للنظام
                        <div class="btn-group btn-group-sm float-left" role="group">
                            <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle-o"></i> حفظ</button>
                            <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>   
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
 
                <div class="col-sm-6">
                    <div class="form-group col-sm-12 {{ $errors->has('AcademicYear') ? 'has-error' : '' }}">
                        <label for="AcademicYear"><span style="color:red;">*</span><strong> العام الجامعي :</strong></label>
                        {{ Form::select('AcademicYear', AcademicYear(), null, ['class'=>"form-control custom-select",'required','placeholder' => '--- أختر العام الجامعي  ---','title'=>'العام الجامعي']) }}
                        @if ($errors->has('AcademicYear'))
                            <div class="masseg_error">
                                {{ $errors->first('AcademicYear') }}
                            </div>  
                        @endif
                    </div>
                    <div class="form-group col-sm-12{{ $errors->has('StartDate') ? 'has-error' : '' }}">
                        <label for="StartDate"><span style="color:red;">*</span><strong> الفصل الدراسي الاول :</strong></label>
                        <div class="input-group input-daterange">
                            <div class="input-group-addon"><strong>من</strong></div>
                            <input type="text" class="form-control datepicker " readonly>
                            <div class="input-group-addon"><strong>الى</strong></div>
                            <input type="text" class="form-control  datepicker" readonly>
                        </div>
                        @if ($errors->has('StartDate'))
                            <div class="masseg_error ">
                                {{ $errors->first('StartDate') }}
                            </div>
                        @endif
                      
                    </div>
                    <div class="form-group col-sm-12{{ $errors->has('StartDate') ? 'has-error' : '' }}">
                        <label for="StartDate"><span style="color:red;">*</span><strong> الفصل الدراسي الثاني :</strong></label>
                        <div class="input-group input-daterange">
                            <div class="input-group-addon"><strong>من</strong></div>
                            <input type="text" class="form-control datepicker " readonly>
                            <div class="input-group-addon"><strong>الى</strong></div>
                            <input type="text" class="form-control  datepicker" readonly>
                        </div>
                        @if ($errors->has('StartDate'))
                            <div class="masseg_error ">
                                {{ $errors->first('StartDate') }}
                            </div>
                        @endif
                      
                    </div>
                  
                </div>
              
     
        </div>
    {{ Form::close() }} 
@Stop

@section('footer')
    {!! Html::script('Templates/Shared-files/js/bootstrap-datetimepicker.min.js') !!}
    <script type="text/javascript">
        $(".datepicker").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
        $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
        });
    </script>        
    
@Stop