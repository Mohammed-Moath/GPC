@extends('layouts.Master.Administrator')

@section('title')
المستخدمين | حساب المستخدم رقم {{ isset($user->id) !=null ?$user->id : ''}}
@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a title="المستخدمين" href="{{url('administrator/users')}}"><i class="fa fa-users"></i> المستخدمين</a></li>
                <li class="breadcrumb-item active"> حساب المستخدم رقم : {{ isset($user->id) !=null ?$user->id : ''}} </li>
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
            <div class="card-header">
                <strong> حساب المستخدم رقم : {{ isset($user->id) !=null ? $user->id : ''}} </strong>
                <div class="btn-group btn-group-sm pull-left" role="group" aria-label="Basic example">
                    <a title="pdf" href='{{ url("administrator/users/$user->id/pdf") }}' type="button" class="btn btn-outline-info"><i class="fa fa-file-pdf-o"></i></a>
                    <a title="تعديل" href='{{ url("administrator/users/$user->id/edit") }}' class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                    <button data-title="Delete" data-toggle="modal" data-target="#delete" title="حذف" type="button" class="btn btn-outline-danger"><i class="fa fa-trash-o"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div class="col-sm-3">
                    <div class="card text-center border-left-0 border border-danger">
                        <img width="100" height="100" class="rounded-right" src="{{ asset($user->PresonalPicture) }}" alt="{{$user->username}}" title="الصورة الشخصية : {{ $user->username}}">
                        <p><span class="badge badge-pill badge-info">تاريخ الانشاء |{{ isset($user->created_at) !=null ? $user->created_at : '' }}</span></p>
                        <p><span class="badge badge-pill badge-success">أخر تحديث |{{ isset($user->updated_at) !=null ? $user->updated_at : '' }}</span></p>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td><strong>الاسم : </strong>{{ isset($user->Name) !=null ?  $user->Name : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>اسم الاستخدام : </strong> {{ isset($user->username) !=null ?  $user->username : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>المجموعة : </strong>{{ isset($user->UserRoles->UserRoleAr) !=null ? $user->UserRoles->UserRoleAr : 'لايوجد بيانات ليتم عرضها !'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>رقم الهاتف : </strong>{{ isset($user->PhoneNumber) !=null ? $user->PhoneNumber : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>الايميل : </strong>{{ isset($user->Email) !=null ? $user->Email : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                </tr>
                                <tr>
                                    <td> حالة الحساب : {{ $user->IsActive ==1 ? 'مفعل' : 'غير مفعل' }} <a href=""><i class="fa fa-question-circle"></i></a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($user->Roles == 3)
                <div class="col-sm-5">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr class="thead-dark">
                                    <th class="text-center" colspan="2">البيانات الاكاديمية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($user->ProjectStudent == null)
                                <tr>
                                    <th class="text-center text-danger" colspan="2">لاتوجد بيانات للطالب</th>
                                </tr>
                                @endif
                                @if($user->ProjectStudent != null)
                                <tr>
                                    <th>الرقم الإكاديمي</th>
                                    <td>{{ isset($user->ProjectStudent->AcdameicNumber) !=null ?  $user->ProjectStudent->AcdameicNumber : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                                <tr>
                                    <th>المركز الدراسي</th>
                                    <td>{{ isset($user->ProjectStudent->branches->BrancheNameAR) !=null ?  $user->ProjectStudent->branches->BrancheNameAR : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                                <tr>
                                    <th>التخصص</th>
                                    <td>{{ isset($user->ProjectStudent->programs->ProgramName) !=null ?  $user->ProjectStudent->programs->ProgramName : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                                <tr>
                                    <th>القسم العلمي</th>
                                    <td>{{ isset($user->ProjectStudent->programs->scientific_departments->DepartmentName) !=null ?  $user->ProjectStudent->programs->scientific_departments->DepartmentName : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                                <tr>
                                    <th>عدد ساعاته المعتمدة</th>
                                    <td>{{ isset($user->ProjectStudent->HoursCompleted) !=null ? $user->ProjectStudent->HoursCompleted : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                                </tr>
                                <tr>
                                    <th>قيامه بالتدريب الميداني</th>
                                    <td>{{ isset($user->ProjectStudent->Complete_FeldTraining) !=null ? $user->ProjectStudent->Complete_FeldTraining : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ أضافة البيانات الاكاديمية الى النظام</th>
                                    <td>{{ isset($user->ProjectStudent->created_at) !=null ? $user->ProjectStudent->created_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                                </tr>
                                <tr>
                                    <th>أخر تحديث للبيانات الاكاديمية</th>
                                    <td>{{ isset($user->ProjectStudent->updated_at) !=null ? $user->ProjectStudent->updated_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if($user->Roles == 4)
                <div class="col-sm-5">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr class="thead-dark">
                                    <th class="text-center" colspan="2">البيانات الاكاديمية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($user->ProjectSupervisor == null)
                                <tr>
                                    <th class="text-center text-danger" colspan="2">لاتوجد بيانات لاعضو هيئة التدريس</th>
                                </tr>
                                @endif
                                @if($user->ProjectSupervisor != null)
                                <tr>
                                    <th>الرقم الوظيفي</th>
                                    <td>{{ isset($user->ProjectSupervisor->FunctionalNumber) !=null ?  $user->ProjectSupervisor->FunctionalNumber : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                                <tr>
                                    <th>الرتبة العلمية</th>
                                    <td>{{ isset($user->ProjectSupervisor->scientific_degrees->name) !=null ? $user->ProjectSupervisor->scientific_degrees->name : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ أضافة البيانات الاكاديمية الى النظام</th>
                                    <td>{{ isset($user->ProjectSupervisor->created_at) !=null ? $user->ProjectSupervisor->created_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                                </tr>
                                <tr>
                                    <th>أخر تحديث للبيانات الاكاديمية</th>
                                    <td>{{ isset($user->ProjectSupervisor->updated_at) !=null ? $user->ProjectSupervisor->updated_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@include('Administrator.Users.deletes')
@Stop