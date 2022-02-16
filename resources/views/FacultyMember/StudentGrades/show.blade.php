@extends('layouts.Master.FacultyMember') 

@section('title')
 الدرجات | تفاصيل درجات الطلاب
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <a title="الدرجات"href="{{ url('student/grades') }}"> الدرجات</a> 
        </li>
        <li class="active">
         تفاصيل درجات الطلاب 
        </li>
        <li  class="pull-left">
         <a title="ذهاب للصفحة الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ url('home/FacultyMember') }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h3 class="page-header">
      <strong>تفاصيل الدرجات الخاصة بالطلاب </strong>
    </h3>
    <div class="panel panel-info"> 
        <div class="panel-heading ">
            <h3 class="panel-title text-center">
                <strong>{{ $TypeStudent }}</strong></h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th class=" text-center warning">رئيس هذه المجموعة</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td>
                            <a title="تفاصيل هذه الطالب" href="{{ url('FacultyMember/x')}}">
                                {{ $group->project_students->users->FirstName }}
                                {{ $group->project_students->users->SecondName }}
                                {{ $group->project_students->users->TirdName }}
                                {{ $group->project_students->users->NickName }} 
                            </a>    
                        </td>
                    </tr>
  
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="warning">
                            <th>اسم الطالب </th>
                            <th>الدرجة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($TeamDegre as $t)
                        <tr>
                            <td>
                                <a title="تفاصيل هذه الطالب" href="{{ url('FacultyMember/x')}}">
                                    {{ $t->project_students->users->FirstName }}
                                    {{ $t->project_students->users->SecondName }}
                                    {{ $t->project_students->users->TirdName }}
                                    {{ $t->project_students->users->NickName }} 
                                </a>    
                            </td>
                            <td><input class="form-control" placeholder="{{ $t->DegreeSupervisor }}" disabled=""> </td>
                            <td><a href="{{ url('FacultyMember/x')}}"><button class="btn btn-success"><i class="fa fa-edit"></i> تعديل الدرجة</button></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection           
