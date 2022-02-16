@extends('layouts.Master.Administrator') 

@section('title')
الصفحة الرئيسية
@endsection

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        GPC |  الادارة
    </li>
    <li class="breadcrumb-item active"><i class="fa fa-info-circle"></i> النسخة 0.3 تحت الإنشاء</li>
</ol>

<div class="row">
    <div class="col text-center"> 
        <img title="GPC" class="rounded img-responsive"  src="{{ asset('img\NewLoge.JPG') }}" alt=" #">
        <h6>Copyright © G<span style="color:red;">P</span>C | 2018</h6>
    </div>
</div>
@Stop