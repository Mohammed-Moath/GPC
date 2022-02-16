@extends('layouts.Master.GPCO') 

@section('title')
 المواعيد  | التسليمات
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
                        <i class="fa fa-clock-o"></i> المواعيد 
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-clock-o"></i> المواعيد</a>
                        </li>
                        <li  class="active">
                          التسليمات
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
                <div class="col-lg-10 col-md-10">
                    <h4> <strong>أضافة تسليم</strong></h4>
                    <hr>
                </div>
                {!! Form::open(["url"=>"appointments/deliveries"]) !!} 
                    <div class="col-lg-6">
                        <div class="form-group col-lg-6">
                            <label for="AcademicYear">العام الجامعي :</label>
                            <input title="العام الجامعي" id="AcademicYear" type="text" class="form-control" disabled="disabled" placeholder="{{AcademicYear_GPC()}}">
                        </div>
                        <div class="form-group col-lg-6 {{ $errors->has('Semester') ? ' has-error' : '' }}">
                            <label for="Semester">الفصل الدراسي :</label>
                            {{ Form::select('Semester',Semester(), null, ['required','class'=>'form-control','placeholder' => '--- أختر الفصل الدراسي ---','title'=>'الفصل الدراسي']) }}
                            @if ($errors->has('Semester'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Semester') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group col-lg-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">التسليم المطلوب :</label>
                            {!! Form::text('name',null,['required','maxlength'=>'100','id'=>'name','class'=>'form-control','placeholder'=>'موضوع التسليم المطلوب','title'=>'موضوع التسليم المطلوب','value'=>"{{Request::old('name')}}"]) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group col-lg-6 {{ $errors->has('time_open') ? ' has-error' : '' }}">
                            <label for="time_open">تاريخ البدء :</label>
                            <div class="input-group date myDatepicker1" >
                                {{ Form::text('time_open',null,['class'=>'form-control','readonly','required','title'=>'تاريخ البدء']) }}
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            @if ($errors->has('time_open'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('time_open') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group col-lg-6 {{ $errors->has('time_close') ? ' has-error' : '' }}">
                            <label for="time_close">تاريخ الانتهاء :</label>
                            <div class="input-group date myDatepicker1" >
                                {{ Form::text('time_close',null,['class'=>'form-control','readonly','required','title'=>'تاريخ الانتهاء']) }}
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            @if ($errors->has('time_close'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('time_close') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group col-lg-6">
                            <button title="حفظ" type="submit" class="btn btn-primary btn-block"> <i class="fa fa-check-circle"></i> حفظ</button>  
                        </div>
                        <div class="form-group col-lg-6">
                        <button title="الغاء" type="reset" class="btn btn-danger btn-block"> <i class="fa fa-times-circle"></i> الغاء</button>         
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('descrdiption') ? ' has-error' : '' }} ">
                            <label for="time_close">الوصف :</label>
                            {!! Form::textarea('descrdiption',null,['id'=>'descrdiption','class'=>'form-control','title'=>'الوصف','value'=>"{{Request::old('descrdiption')}}"]) !!}
                            @if ($errors->has('descrdiption'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('descrdiption') }}</strong>
                                </span>
                            @endif   
                        </div> 
        
                    
                    
                    

                    
                            
                            
                    </div>
                {{ Form::close() }}   
                <div class="col-lg-12 col-md-12">
                <hr>
                </div>        
            </div>
            <!-- /.row -->

             <div class="row">
                <div class="col-lg-10 col-md-10">
                    <h4> <strong>التسليمات التي تم أنشائها</strong></h4>
                    <hr>
                </div>
                @if(count($Deliveries)==0)
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-danger text-center col-lg-12 col-md-12" role="alert">
                            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>لاتوجد تسليمات مطلوبة</strong>
                        </div>
                    </div>
                @endif
                @if(count($Deliveries)!=0)
                    <div class="col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>العام الجامعي</th>
                                            <th>الفصل</th>
                                            <th>التسليم المطلوب</th>
                                            <th>تاريخ البدء</th>
                                            <th>تاريخ الانتهاء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Deliveries as $d)
                                        <tr>
                                            <td>{{ isset($d->AcademicYear) !=null ? $d->AcademicYear : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td>{{ isset($d->Semester) !=null ? $d->Semester : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td>{{ isset($d->name) !=null ? $d->name : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td>{{ isset($d->time_open) !=null ? $d->time_open : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td>{{ isset($d->time_close) !=null ? $d->time_close : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <th><button  title="تفاصيل"  type="button" class="btn btn-primary btn-xs"> <i class="fa fa-folder-open"></i></button></a></th>
                                            <th><button  title="تعديل"  type="button" class="btn btn-warning btn-xs"> <i class="fa fa-edit"></i></button></a></th>
                                            <th><button  title="حذف"  type="button" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i></button></a></th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                @endif
             
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