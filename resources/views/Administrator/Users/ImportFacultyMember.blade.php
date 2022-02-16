@extends('layouts.Master.Administrator')

@section('title','إستيراد بيانات إعضاء هيئة التدريس')



@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="المستخدمين" href="{{url('administrator/users')}}"><i class="fa fa-users"></i> المستخدمين </a></li>
                <li class="breadcrumb-item active"> إستيراد بيانات إعضاء هيئة التدريس </li>
            </ol>
        </nav>
    </div>

    <div class="col-4">
        <div class="text-left">
            <a title="رجوع" href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('administrator/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header text-center">
                <strong> إستيراد بيانات إعضاء هيئة التدريس</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><span class="label label-danger">تعليمات الاستيراد</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1- يجب ان يكون الملفات المراد استيرادها بصيغة csv او xlsx
                                <br>
                                2- يجب ان يكون اسم العمود للارقام الوظيفية في الملف المراد استيراده هو <mark>FunctionalNumber</mark> حتي تتم العملية بشكل صحيح.
                                <br>
                                <img src="{{ asset('img\FN.jpg') }}" />
                            </td>
                            <td>
                                <form action="{{ URL::to('administrator/users/import/FacultyMember') }}" role="form" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input title="اختيار الملف المراد استيراد منه بيانات أعضاء هيئة التدريس" type="file" name="import_file">
                                    </div>
                                    <div class="form-group">
                                        <button title="بدء عملية الاستيراد لبيانات أعضاء هيئة التدريس" class="btn btn-primary btn-block">استيراد الملف</button>
                                    </div>
                                </form>
                            </td>

                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@Stop