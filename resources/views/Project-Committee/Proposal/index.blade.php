@extends('layouts.Master.Project-Committee')

@section('title')
المقترحات
@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> <i class="fa fa-file-powerpoint-o"></i> المقترحات</li>
            </ol>
        </nav>
    </div>

    <div class="col-4">
        <div class="text-left">
            <a title="رجوع" href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card ">
            <div class="card-header text-center">
                <span class="badge badge-pill badge-info"><i class="fa fa-file-powerpoint-o"></i> المقترحات</span>
                <a title="أضافة مقترح جديد" class="btn btn-outline-primary  btn-sm float-left" href="{{ url('project-committee/proposal/create') }}" role="button"><i class="fa fa-plus-square-o"></i> مقترح جديد</a>
                {{ Form::open(["class"=>"pull-right","url"=>"project-committee/proposal"]) }}
                <i class="fa fa-filter"></i>
                <select class="custom-select " name="filter" onchange="this.form.submit();">
                    <option value="1" {{ ($CF == 1 )  ? 'selected' : '' }}>الحالي</option>
                    <option value="2" {{  ($CF == 2 ) ? 'selected' : '' }}>نشط</option>
                    <option value="3" {{ ($CF == 3 ) ? 'selected' : '' }}>منتهي</option>
                    <option value="4" {{  ($CF == 4 ) ? 'selected' : '' }}> الجميع</option>
                </select>
                {{ Form::close() }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-warning border-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <span class="badge badge-pill badge-dark">({{$New}})</span>

                                </div>
                                <div class="mr-1 ">
                                    <h4>الجديد</h4>
                                </div>
                            </div>
                            @if($New != 0)
                            <a title="التفاصيل" class="card-footer text-white clearfix small z-1" href="{{ url("project-committee/proposal/1/$CF") }}">
                                <span class="float-right">
                                    التفاصيل <i class="fa fa-arrow-circle-left"></i>
                                </span>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-info border-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <span class="badge badge-pill badge-dark">({{$Certified}})</span>

                                </div>
                                <div class="mr-1">
                                    <h4>المعتمد</h4>
                                </div>
                            </div>
                            @if($Certified !=0)
                            <a title="التفاصيل" class="card-footer text-white clearfix small z-1" href="{{ url("project-committee/proposal/2/$CF") }}">
                                <span class="float-right">
                                    التفاصيل <i class="fa fa-arrow-circle-left"></i>
                                </span>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-info border-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <span class="badge badge-pill badge-dark">({{$Selected}})</span>

                                </div>
                                <div class="mr-1">
                                    <h4>المختار</h4>
                                </div>
                            </div>
                            @if($Selected !=0)
                            <a title="التفاصيل" class="card-footer text-white clearfix small z-1" href="{{ url("project-committee/proposal/3/$CF") }}">
                                <span class="float-right">
                                    التفاصيل <i class="fa fa-arrow-circle-left"></i>
                                </span>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white border-success bg-secondary o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <span class="badge badge-pill badge-dark">({{$All}})</span>

                                </div>
                                <div class="mr-1">
                                    <h4>الكل</h4>
                                </div>
                            </div>
                            @if($All)
                            <a title="التفاصيل" class="card-footer text-white clearfix small z-1" href="{{ url("project-committee/proposal/4/$CF") }}">
                                <span class="float-right">
                                    التفاصيل <i class="fa fa-arrow-circle-left"></i>
                                </span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@Stop