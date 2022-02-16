@extends('layouts.Master.Project-Committee')

@section('title')
الصفحة الرئيسية
@endsection

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        GPC | لجنة المشاريع
    </li>
    <li class="breadcrumb-item active"><i class="fa fa-info-circle"></i> النسخة 0.3 تحت الإنشاء</li>


</ol>
@if(count(Calendar_Current()) == 0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-warning"></i> تنبية !! لا يوجد اي تقويم نشط للجنة المشاريع
    </div>

@endif

<div class="row">
    <div class="col text-center">
        <img title="GPC" class="rounded img-responsive" src="{{ asset('img\NewLoge.JPG') }}" alt=" #">
        <h6>Copyright © G<span style="color:red;">P</span>C | 2018</h6>
    </div>
</div>
@Stop