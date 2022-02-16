@extends('layouts.Master.GPCO') 

@section('title')
 بيانات المشرف | {{ isset($Supervisors_Data->users->Name) !=null ? $Supervisors_Data->users->Name : '' }}
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
           
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-bar-chart"></i>  بيانات المشرفين
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <a title="بيانات المشرفين"  href="{{ url('supervisors-data') }}"><i class="fa fa-bar-chart"></i> بيانات المشرفين </a>
                        </li>
                        <li class="active">
                            بيانات المشرف | {{ isset($Supervisors_Data->users->Name) !=null ? $Supervisors_Data->users->Name : '' }}
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
                        <img class="img-rounded"  src="{{ asset($Supervisors_Data->users->PresonalPicture) }}" alt="  خطأ غير متوقع في تحميل صورة المشرف |  {{ $Supervisors_Data->users->Name}}">
                    </span>
                 
                </div>

                <div class="table-responsive col-lg-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center"><h3><span class="label label-default">{{ isset($Supervisors_Data->users->Name) !=null ? $Supervisors_Data->users->Name : 'لاتوجد أي بيانات ليتم عرضها !' }}</span></h3></th>
                            </tr>
                            <tr>
                                <th colspan="2"><span class="label label-info">البيانات الإكاديمية للمشرف</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>الرقم الوظيفي</th>
                                <td title="الرقم الوظيفي للمشرف.">{{ isset( $Supervisors_Data->FunctionalNumber ) !=null ?  $Supervisors_Data->FunctionalNumber  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>التخصص</th>
                                <td title="التخصص">{{ isset($Supervisors_Data->programs->ProgramName) !=null ? $Supervisors_Data->programs->ProgramName : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>الدرجة العلمية</th>
                                <td title="الدرجة العلمية">{{ isset($Supervisors_Data->scientific_degrees->NameDegree) !=null ? $Supervisors_Data->scientific_degrees->NameDegree : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                            </tr>
                            <tr>
                                <th>حالة الاشراف</th>
                                <td title="حالة الاشراف">
                                    @if($Supervisors_Data->StatuSupervision == 1)
                                        <span class="label label-success"><i class="fa fa-check-circle-o"></i> مشرف</span>
                                    @endif
                                    @if($Supervisors_Data->StatuSupervision == 0)
                                        <span class="label label-warning"><i class="fa fa-info-circle"></i> معفي من الاشراف</span>
                                    @endif
                               </td>
                            </tr>
                            <tr>
                                <th>عدد المجموعات التي يشرف عليها</th>
                                <td title="عدد المجموعات التي يشرف عليها">
                                    <span class="badge bg-green">{{ isset($Number_GroupsSupervisor) !=null ? $Number_GroupsSupervisor : ''}}</span>
                                    @if($Number_GroupsSupervisor != 0)
                                        <a title="تفاصيل" href="{{ url("#") }}" class="btn btn-primary btn-xs "><i class="fa fa-folder-open"></i> تفاصيل</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>تاريخ أضافة البيانات الإكاديمية الى النظام</th>
                                <td title="تاريخ أضافة البيانات الإكاديمية الى النظام">{{ isset($Supervisors_Data->created_at) !=null ? $Supervisors_Data->created_at : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>تاريخ أخر تحديث للبيانات الإكاديمية</th>
                                <td title="تاريخ أخر تحديث للبيانات الإكاديمية">{{ isset($Supervisors_Data->updated_at) !=null ? $Supervisors_Data->updated_at : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2"><span class="label label-info">بيانات شخصية / بيانات استخدام النظام للمشرف</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>رقم المستخدم في النظام</th>
                                <td title="رقم المستخدم في النظام">{{ isset( $Supervisors_Data->users->id ) !=null ?  $Supervisors_Data->users->id  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>اسم المستخدم</th>
                                <td title="اسم المستخدم">{{ isset( $Supervisors_Data->users->username ) !=null ?  $Supervisors_Data->users->username  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>الجنس</th>
                                <td title="الجنس">{{ isset($Supervisors_Data->users->Gender	) !=null ? $Supervisors_Data->users->Gender : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>رقم الهاتف</th>
                                <td title="القسم العلمي">{{ isset($Supervisors_Data->users->PhoneNumber) !=null ? $Supervisors_Data->users->PhoneNumber : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>الايميل</th>
                                <td title="الايميل">{{ isset($Supervisors_Data->users->Email) !=null ? $Supervisors_Data->users->Email : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
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