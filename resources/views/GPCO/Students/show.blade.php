@extends('layouts.Master.GPCO') 

@section('title')
 بيانات الطالب | {{ isset($Student_Data->users->Name) !=null ? $Student_Data->users->Name : '' }}
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
           
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-bar-chart"></i>  بيانات الطلاب
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <a title="بيانات الطلاب"  href="{{ url('students-data') }}"><i class="fa fa-bar-chart"></i> بيانات الطلاب </a>
                        </li>
                        <li class="active">
                            بيانات الطالب | {{ isset($Student_Data->users->Name) !=null ? $Student_Data->users->Name : '' }}
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                </div>
            </div> 
            <!-- /.row -->
           
            <div class="row"> 
            
                <div class="col-lg-3">
                    <span class="image-user-stu pull-left">
                        <img class="img-rounded"  src="{{ asset($Student_Data->users->PresonalPicture) }}" alt="  خطأ غير متوقع في تحميل صورة الطالب |  {{ $Student_Data->users->Name}}">
                    </span>
                 
                </div>

                <div class="table-responsive col-lg-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center"><h3><span class="label label-default">{{ isset($Student_Data->users->Name) !=null ? $Student_Data->users->Name : 'لاتوجد أي بيانات ليتم عرضها !' }}</span></h3></th>
                            </tr>
                            <tr>
                                <th colspan="2"><span class="label label-info">البيانات الإكاديمية للطالب</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>الرقم الاكاديمي</th>
                                <td title="الرقم الاكاديمي للطالب.">{{ isset( $Student_Data->AcdameicNumber ) !=null ?  $Student_Data->AcdameicNumber  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>التخصص</th>
                                <td title="التخصص">{{ isset($Student_Data->programs->ProgramName) !=null ? $Student_Data->programs->ProgramName : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>القسم العلمي</th>
                                <td title="القسم العلمي">{{ isset($Student_Data->programs->scientific_departments->DepartmentName) !=null ? $Student_Data->programs->scientific_departments->DepartmentName : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>المركز الدراسي</th>
                                <td title="القسم العلمي">{{ isset($Student_Data->branches->BrancheNameAR) !=null ? $Student_Data->branches->BrancheNameAR : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>عدد ساعاته المعتمده</th>
                                <td title="عدد ساعاته المعتمده">{{ isset($Student_Data->HoursCompleted) !=null ? $Student_Data->HoursCompleted : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>أكمال التدريب الميداني</th>
                                <td title="أكمال التدريب الميداني">{{ isset($Student_Data->Complete_FeldTraining) !=null ? $Student_Data->Complete_FeldTraining : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>رقم مجموعة العمل</th>
                                <td title="رقم مجموعة العمل">
                                    @if($Student_Data->project_groups_id == null)
                                        <span class="label label-danger">الطالب لا يوجد لديه مجموعة !</span>
                                    @endif
                                    @if($Student_Data->project_groups_id != null)
                                        <span class="badge bg-green">{{ isset($Student_Data->project_groups_id) !=null ? $Student_Data->project_groups_id : ''}}</span>
                                        <a title="تفاصيل" href="{{ url("statistics-groups/$Student_Data->project_groups_id/show") }}" class="btn btn-primary btn-xs "><i class="fa fa-folder-open"></i> تفاصيل</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>تاريخ أضافة البيانات الإكاديمية الى النظام</th>
                                <td title="تاريخ أضافة البيانات الإكاديمية الى النظام">{{ isset($Student_Data->created_at) !=null ? $Student_Data->created_at : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>تاريخ أخر تحديث للبيانات الإكاديمية</th>
                                <td title="تاريخ أخر تحديث للبيانات الإكاديمية">{{ isset($Student_Data->updated_at) !=null ? $Student_Data->updated_at : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2"><span class="label label-info">بيانات شخصية / بيانات استخدام النظام للطالب</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>رقم المستخدم في النظام</th>
                                <td title="رقم المستخدم في النظام">{{ isset( $Student_Data->users->id ) !=null ?  $Student_Data->users->id  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>اسم المستخدم</th>
                                <td title="اسم المستخدم">{{ isset( $Student_Data->users->username ) !=null ?  $Student_Data->users->username  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>الجنس</th>
                                <td title="الجنس">{{ isset($Student_Data->users->Gender	) !=null ? $Student_Data->users->Gender : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>رقم الهاتف</th>
                                <td title="القسم العلمي">{{ isset($Student_Data->users->PhoneNumber) !=null ? $Student_Data->users->PhoneNumber : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>الايميل</th>
                                <td title="الايميل">{{ isset($Student_Data->users->Email) !=null ? $Student_Data->users->Email : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
             

                <div class="col-lg-3">
                    <button title="Print"  onclick="myFunction()" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                    <a href="#"> <button title="PDF" type="reset" class="btn btn-default"><i class="fa fa-file-pdf-o"></i></button></a>  
                </div>
               
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection