@extends('layouts.Master.Project-Committee')

@section('title','التقارير')

@section('content')
<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> <i class="fa fa-pie-chart"></i> التقارير</li>
            </ol>
        </nav>
    </div>

    <div class="col-4">
        <div class="text-left">
            <a title="رجوع" href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('project-committee/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card ">
            <div class="card-header text-center">
                <span class="badge badge-pill badge-warning"> <i class="fa fa-pie-chart"></i> التقارير</span>
            </div>
            <div class="card-body">
                <div><a title="Excle" href="{{ url('project-committee/data/students/excle') }}">تقرير عن بيانات جميع الطلبة <i class="fa fa-file-excel-o"> </i></a></div>
                <div><a title="Excle" href="{{ url('project-committee/data/supervisors/excle') }}">تقرير عن بيانات جميع المشرفين <i class="fa fa-file-excel-o"> </i></a></div>




            </div>
        </div>
    </div>
</div><br>


@Stop