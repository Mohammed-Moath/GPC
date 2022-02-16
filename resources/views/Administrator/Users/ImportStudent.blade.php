@extends('layouts.Master.Administrator') 

@section('title')
  أستيراد بيانات الطلاب 
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a title="المستخدمين" href="{{url('administrator/users')}}"><i class="fa fa-users"></i> المستخدمين </a></li>
                    <li class="breadcrumb-item active">  أستيراد بيانات الطلاب </li>
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

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                   <strong> أستيراد بيانات الطلاب  </strong>
                </div>
                <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th><h3><span class="label label-danger">تعليمات الاستيراد بحسب المركز الدراسي</span></h3></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1- يجب أن يكون الملفات المراد استيراها بصيغة  cvs او xlsx .
                            <br>
                            2-  يتم استيراد البيانات التالية مع الالتزام بنفس التسمية الموضحة في الصورة ادني
                            <br> - الرقم الاكاديمي وتسميتة هو <mark>AcdameicNumber</mark>
                            <br> - رقم البطاقة الشخصية والتسمية هي <mark>ID</mark>
                            <br> - اسم  الطالب الرباعي وتسميتة هو <mark>StudentName</mark>
                            <br> - عدد الساعات المعتمدة للطالب والتسمية هي <mark>Number_HoursCompleted</mark>
                            <br> - التخصص وتسميته هو <mark>Programs</mark> | مع الاخذ بعين الاعتبار ان هناك ترميز خاص لك تخصص يتم اخذ الترميز من مطور النظام
                          

                            <br>
                            <img src="{{ asset('img\AN.jpg') }}"/ >
                        </td>
                        <td>
                            <form action="{{ URL::to('administrator/users/import/studen') }}" role="form" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="Branch">أستيراد الملف</label>
                                    <input title="قم بالضغط هنا من اجل اختيار الملف الذي ترغب في استيراده" type="file" name="import_file" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Branch">المركز الدراسي</label>
                                    {!! Form::select('Branch',Branch(),null,array('required','id'=>'Branch','class'=>'form-control','placeholder'=>'--- اختر المركز الدراسي من هنا ---','title'=>'حدد المركز الدراسي للطلاب الذي تم استيراد بياناتهم')) !!}
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">البدء في عملية الاستيراد</button>
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

