@extends('layouts.Master.Project-Committee') 

@section('title')
    أنشاء مجموعة عمل
@endsection

@section('header')
    {!! Html::style('css/select2.min.css') !!}
@endsection 


@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{url("project-committee/groups")}}" title="المجموعات"><i class="fa fa-group"></i> المجموعات</a></li>
                    <li class="breadcrumb-item active"> أنشاء مجموعة  عمل</li>
                </ol>
            </nav>
        </div>

        <div class="col-4">
            <div class="text-left">
                <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
                <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <span class="pull-right text-danger">   <i class="fa fa-info-circle"></i>
                    هنا لايتم الالترام بقيود أنشاء المجموعة.
                    </span>
                    <span class="badge badge-pill badge-info"><i class="fa fa-plus-square-o"></i> أنشاء مجموعة عمل</span>
                    <div class="btn-group btn-group-sm float-left" role="group">
                        <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                        <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>   
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group col-sm-5 {{ $errors->has('calendar_id') ? ' has-error' : '' }}">
                        <label for="calendar_id"><span style="color:red;">*</span><strong> التقويم :</strong></label>
                        {{ Form::select('calendar_id',Calendars(), null, ['required','class'=>"select2",'placeholder' => '--- أختر التقويم ---','title'=>'التقويم']) }}
                        @if ($errors->has('Semester'))
                            <span class="masseg_error">
                                <strong>{{ $errors->first('calendar_id') }}</strong>
                            </span>
                        @endif   
                    </div>
                    <div class="form-group col-sm-3 {{ $errors->has('branches_id') ? ' has-error' : '' }} ">
                        <label for="branches_id"> <span style="color:red;">*</span><strong>  المركز الدراسي :</strong></label>
                        {{ Form::select('branches_id', Branch(), null, ['id'=>'branches_id','class'=>" form-control custom-select",'required','title'=>'المركز الدراسي']) }}
                        @if ($errors->has('branches_id'))
                            <span class="masseg_error">
                                <strong>{{ $errors->first('branches_id') }}</strong>
                            </span>
                        @endif 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@Stop


@section('footer')
    <!-- select2 -->
    {!! Html::script('js/select2.min.js') !!}
    <script>
        $('.select2').select2({
            dir: "rtl"
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                dir: "rtl"
            });   
        });
    </script>
@Stop