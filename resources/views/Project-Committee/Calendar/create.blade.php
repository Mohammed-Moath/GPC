@extends('layouts.Master.Project-Committee')

@section('title')
أنشاء تقويم
@endsection


@section('header')
{!! Html::style('Templates/Shared-files/css/bootstrap-datetimepicker.min.css') !!}
@endsection


@section('content')

<div class="row">
    <div class="col-xs-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="التقويم" href="{{ url('project-committee/calendar') }}"><i class="fa fa-calendar"></i> التقويم</a></li>
                <li class="breadcrumb-item active"> أنشاء تقويم</li>
            </ol>
        </nav>
    </div>

    <div class="col-xs-4">
        <div class="float-left">
            <a title="رجوع" href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
    </div>
</div>



<div class="row">
    <div class="col">
        <div class="card ">
            {{ Form::open(["url"=>"project-committee/calendar/create"]) }}
            <div class="card-header text-center">
                <span class="badge badge-pill badge-success"> <i class="fa fa-plus-square-o"></i> أنشاء تقويم</span>
                <div class="btn-group btn-group-sm float-left" role="group">
                    <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                    <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>

                </div>
            </div>
            <div class="card-body ">
                <div class="clearfix">
                    <div class="form-group col-md-3 {{ $errors->has('AcademicYear') ? 'has-error' : '' }}">
                        <label for="AcademicYear"><span style="color:red;">*</span><strong> العام الجامعي :</strong></label>
                        {{ Form::select('AcademicYear', AcademicYear(), null, ['class'=>"form-control custom-select",'required','placeholder' => '--- أختر العام الجامعي  ---','title'=>'العام الجامعي']) }}
                        @if ($errors->has('AcademicYear'))
                        <div class="masseg_error">
                            {{ $errors->first('AcademicYear') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('Semester') ? 'has-error' : '' }}">
                        <label for="Semester"><span style="color:red;">*</span><strong> الفصل الدراسي :</strong></label>
                        {{ Form::select('Semester',Semester(), null, ['required','class'=>"form-control custom-select",'placeholder' => '--- أختر الفصل الدراسي ---','title'=>'الفصل الدراسي']) }}
                        @if ($errors->has('Semester'))
                        <div class="masseg_error">
                            {{ $errors->first('Semester') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6  {{ $errors->has('Name') ? 'has-error' : '' }}">
                        <label for="Name"><strong>أسم التقويم</strong></label>
                        {{ Form::text('Name',null,['maxlength'=>'100','id'=>'Name','class'=>"form-control",'placeholder'=>'100 حرف اقصي حد.','title'=>'أسم التقويم']) }}
                        @unless ($errors->has('Name'))
                        <small id="Name" class="form-text text-muted">
                            يمكن ترك الحقل فارغاً وسيتم التسمية تلقائي باسم العام الجامعي والفصل الدراسي .
                        </small>
                        @endif
                        @if ($errors->has('Name'))
                        <div class="masseg_error">
                            {{ $errors->first('Name') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="clearfix">
                    <div class="form-group col-md-3 {{ $errors->has('StartDate') ? 'has-error' : '' }}">
                        <label for="StartDate"><span style="color:red;">*</span><strong> تاريخ بداية نشاط التقويم :</strong></label>
                        <div class="input-group date datetimepicker1  ">

                            {{ Form::text('StartDate',null,['class'=>"form-control",'readonly']) }}

                            <span class="input-group-addon ">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        @if ($errors->has('StartDate'))
                        <div class="masseg_error ">
                            {{ $errors->first('StartDate') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3  {{ $errors->has('EndDate') ? 'has-error' : '' }}">
                        <label for="EndDate"><span style="color:red;">*</span><strong> تاريخ نهاية نشاط التقويم :</strong></label>
                        <div class='input-group date datetimepicker1'>
                            {{ Form::text('EndDate',null,['class'=>"form-control",'readonly']) }}
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        @if ($errors->has('EndDate'))
                        <div class="masseg_error">
                            {{ $errors->first('EndDate') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('EndSubmissionProposals') ? ' has-error' : '' }}">
                        <label for="EndSubmissionProposals"><span style="color:red;">*</span><strong> أخر موعد لتقديم المقترحات :</strong></label>
                        <div class='input-group date datetimepicker1'>
                            {{ Form::text('EndSubmissionProposals',null,['class'=>"form-control",'readonly']) }}
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        @if ($errors->has('EndSubmissionProposals'))
                        <div class="masseg_error">
                            {{ $errors->first('EndSubmissionProposals') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{ $errors->has('EndCreateGroup') ? ' has-error' : '' }}">
                        <label for="EndCreateGroup"><span style="color:red;">*</span><strong> أخر موعد للتسجيل :</strong></label>
                        <div class='input-group date datetimepicker1'>
                            {{ Form::text('EndCreateGroup',null,['class'=>"form-control",'readonly']) }}
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        @if ($errors->has('EndCreateGroup'))
                        <div class="masseg_error">
                            {{ $errors->first('EndCreateGroup') }}
                        </div>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="form-group col-md-6  {{ $errors->has('EndChooseWishes') ? 'has-error' : '' }}">
                        <label for="EndChooseWishes"><span style="color:red;">*</span><strong> أخر موعد لاختيار الرغبات :</strong></label>
                        <div class='input-group date datetimepicker1'>
                            {{ Form::text('EndChooseWishes',null,['class'=>"form-control",'readonly']) }}
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        @if ($errors->has('EndChooseWishes'))
                        <div class="masseg_error">
                            {{ $errors->first('EndChooseWishes') }}
                        </div>
                        @endif
                    </div>


                    <div class="form-group col-md-6  {{ $errors->has('note') ? 'has-error' : '' }}">
                        <label for="note"><strong> ملاحظات :</strong></label>
                        {{ Form::textarea('note',null,['class'=>"form-control note-create-calendar"]) }}
                        @if ($errors->has('note'))
                        <div class="masseg_error">
                            {{ $errors->first('note') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="clearfix">
                    <div class="form-group  text-center border border-success ">
                        <label for="Current"> <strong>هل هذا هو التقويم الحالي ؟</strong></label>
                        <label class="custom-control custom-checkbox ">
                            <input type="checkbox" class="custom-control-input" name="Current" value="1">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">نعم</span>
                        </label>
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
    $(".datetimepicker1").datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });
</script>

@Stop