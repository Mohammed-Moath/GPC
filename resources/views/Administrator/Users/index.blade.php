@extends('layouts.Master.Administrator')

@section('title')
المستخدمين
@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-users"></i> المستخدمين </li>
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
                <strong> المستخدمين </strong>
                <div class="btn-group btn-group-sm pull-left" role="group" aria-label="Basic example">
                    <button titlel="أضافة طالب " type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#GroupUsers"><i class="fa fa-plus-square-o"></i> أضافة مستخدم</button>
                    <a titlel="أستيراد بيانات الطلاب " href="{{url('administrator/users/import/student')}}" class="btn btn-outline-info"><i class="fa fa-copy"></i> أستيراد بيانات الطلاب</a>
                    <a titlel="أستيراد بيانات أعضاء هيئة التدريس " href="{{url('administrator/users/import/FacultyMember')}}" class="btn btn-outline-info"><i class="fa fa-copy"></i> أستيراد بيانات اعضاء هينة التدريس</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-hover">
                        <caption class="text-left">مستخدمين النظام</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الاسم</th>
                                <th scope="col"></th>
                                <th scope="col">الجنس</th>
                                <th scope="col">المجموعة</th>
                                <th scope="col">حالة الحساب</th>
                                <th scope="col">تاريخ الاضافة</th>
                                <th scope="col">
                                    <!-- <a title="pdf"  href="{{url('administrator/users/print-pdf-all-users')}}"><i class="fa fa-file-pdf-o"></i></a> -->
                                    <a title="excel" href="{{url('administrator/users/print-excle-all-users')}}" class="text-center"><i class="fa fa-file-excel-o"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ isset($user->id) !=null ? $user->id : ''}}</th>
                                <td>{{ isset($user->Name) !=null ? $user->Name : 'لا توجد بيانات'}}</td>
                                <td>{{ ($user->username) !=null ? $user->username : 'لا توجد بيانات'}}</td>
                                <td>{{ ($user->Gender) !=null ? $user->Gender : 'لا توجد بيانات'}}</td>
                                <td>{{ ($user->UserRoles->UserRoleAr) !=null ? $user->UserRoles->UserRoleAr : 'لا توجد بيانات'}}</td>
                                <td>
                                    @if($user->IsActive == 0)
                                    <span class="badge  badge-secondary">معطل</span>
                                    @endif
                                    @if($user->IsActive == 1)
                                    <span class="badge badge-success"> مفعل</span>
                                    @endif
                                </td>
                                <td>{{ ($user->created_at) !=null ? $user->created_at : 'لا توجد بيانات'}}</td>
                                <td><a title="تفاصيل" href='{{url("administrator/users/$user->id/show")}}'><i class="fa fa-folder-open-o"></i></a></td>
                            </tr>
                            @endforeach
                        <tbody>
                    </table>

                </div>
            </div>
            <div class="card-footer text-muted">
                <nav aria-label="Page navigation">
                    {{$users->links('vendor.pagination.bootstrap-4')}}
                </nav>
            </div>
        </div>
    </div>
</div><br>

@include('Administrator.Users.group-users')
@Stop