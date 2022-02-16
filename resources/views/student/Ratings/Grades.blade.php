@extends('layouts.Master.Student') 

@section('title')
   الدرجات
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
           تقيماتي
        </li>
        <li class="active">
           الدرجات
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
  
    <div class="page-header">
       <h3>الدرجات</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="info">
                    <th>أجمالي الدرجات من</th>
                    <td><span class="badge bg-green">42</span></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>درجة الحضور والغياب</th>
                    <td><span class="badge bg-green">42</span></td>
                </tr>
                <tr>
                    <th>درجة التسليمات</th>
                    <td><span class="badge bg-green">42</span></td>
                </tr>
                <tr>
                    <th>درجة المشرف</th>
                    <td><span class="badge bg-green">42</span></td>
                </tr>
                <tr>
                    <th>درجة المناقشة النصفية</th>
                    <td><span class="badge bg-green">42</span></td>
                </tr>
                <tr>
                    <th>درجة المناقشة النهائية</th>
                    <td><span class="badge bg-green">42</span></td>
                </tr>
            </tbody>
            <thead>
                <tr class="success">
                    <th>أجمالي درجاتي</th>
                    <td><span class="badge bg-green">42</span></td>
                </tr>
            </thead>
        </table>
    </div>

@endsection           
