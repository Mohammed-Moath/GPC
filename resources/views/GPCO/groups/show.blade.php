@extends('layouts.Master.GPCO') 

@section('title')
     تفاصيل المجموعة رقم {{ isset($group->id) !=null ? $group->id : 'لاتوجد أي بيانات ليتم عرضها !' }}
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                    <i class="fa fa-group"></i>  المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                        <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="أدارة المجموعات" href="{{ url('manage/groups') }}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li  class="active">
                        تفاصيل المجموعة رقم {{ isset($group->id) !=null ? $group->id : 'لاتوجد أي بيانات ليتم عرضها !' }}
                         
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
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <a title="تعديل" href="#" class="btn btn-warning btn-xs "><i class="fa fa-edit"></i> تعديل</a> 
                                <a title="حذف" href="#" class="btn btn-danger btn-xs "><i class="fa fa-edit"></i> حذف</a>
                            </div>
                            <h3 class="panel-title "><strong>تفاصيل المجموعة رقم {{ isset($group->id) !=null ? $group->id : 'لاتوجد أي بيانات ليتم عرضها !' }}</strong></h3>   
                        </div>   
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row toggle" id="dropdown-detail-1" data-toggle="detail-1">
                                    <div class="col-xs-10">
                                        <h3 class="panel-title"><strong>عنوان مشروع التخرج للمجموعة</strong></h3>
                                    </div>
                                    <div class="col-xs-2"><i class="fa fa-chevron-down pull-left"></i></div>
                                </div>
                                <div id="detail-1">
                                    <hr></hr>
                                    <div class="container">
                                        <div class="fluid-row">
                                            <div class="col-xs-6">
                                             {{ isset($group->proposals->ProjectProposalTitle) !=null ? $group->proposals->ProjectProposalTitle : 'لم يتم تحديد المشروع بعد !' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row toggle" id="dropdown-detail-2" data-toggle="detail-2">
                                    <div class="col-xs-10">
                                        <h3 class="panel-title"><strong>رئيس المجموعة</strong></h3>
                                    </div>
                                    <div class="col-xs-2"><i class="fa fa-chevron-down pull-left"></i></div>
                                </div>
                                <div id="detail-2">
                                    <hr></hr>
                                    <div class="container">
                                        <div class="fluid-row">
                                            <div class="col-xs-6">
                                                {{ isset( $group->project_students->users->Name) !=null ?  $group->project_students->users->Name : 'لاتوجد أي بيانات ليتم عرضها !' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row toggle" id="dropdown-detail-3" data-toggle="detail-3">
                                    <div class="col-xs-10">
                                         <h3 class="panel-title"><strong>مشرف المجموعة</strong></h3>
                                    </div>
                                    <div class="col-xs-2"><i class="fa fa-chevron-down pull-left"></i></div>
                                </div>
                                <div id="detail-3">
                                    <hr></hr>
                                    <div class="container">
                                        <div class="fluid-row">
                                            <div class="col-xs-6">
                                                {{ isset($group->project_supervisors->users->Name) !=null ? $group->project_supervisors->users->Name : 'لم يتم تحديد مشرف بعد !'}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row toggle" id="dropdown-detail-4" data-toggle="detail-4">
                                    <div class="col-xs-10">
                                         <h3 class="panel-title"><strong>أعضاء المجموعة</strong></h3>
                                    </div>
                                    <div class="col-xs-2"><i class="fa fa-chevron-down pull-left"></i></div>
                                </div>
                                <div id="detail-4">
                                    <hr></hr>
                                    <div class="container">
                                        <div class="fluid-row">
                                            <table class="table table-bordered col-xs-6">
                                                <thead>
                                                    <tr class="success">
                                                        <th>الرقم الاكاديمي </th>
                                                        <th>الاسم</th>
                                                        <th>التخصص</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($Team as $t)
                                                    <tr>
                                                        <th scope="row">{{ isset($t->AcdameicNumber) !=null ? $t->AcdameicNumber : 'لاتوجد أي بيانات ليتم عرضها !' }}</th>
                                                        <td>
                                                            {{ isset($t->users->Name) !=null ? $t->users->Name : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                                        </td>
                                                        <td>{{ isset($t->programs->ProgramName) !=null ? $t->programs->ProgramName : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                                                    </tr>
                                                @endforeach  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row toggle" id="dropdown-detail-5" data-toggle="detail-5">
                                    <div class="col-xs-10">
                                        <h3 class="panel-title"><strong>معلومات اخرى عن المجمموعة</strong></h3>
                                    </div>
                                    <div class="col-xs-2"><i class="fa fa-chevron-down pull-left"></i></div>
                                </div>
                                <div id="detail-5">
                                    <hr></hr>
                                    <div class="container">
                                        <div class="fluid-row">
                                            <table class="table table-bordered col-xs-6">
                                                <tbody>
                                                    <tr>
                                                        <th>المركز الدراسي</th>
                                                        <td>{{ isset($group->branches->BrancheNameAR) !=null ? $group->branches->BrancheNameAR : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                     <tr>
                                                        <th>أنشات بتاريخ</th>
                                                        <td> {{ isset($group->created_at) !=null ? $group->created_at : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>أنشات بواسطة</th>
                                                        <td>
                                                           
                                                            {{isset( $group->users->Name) !=null ?  $group->users->Name : 'لاتوجد أي بيانات ليتم عرضها !' }} 
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <th>العام الجامعي</th>
                                                        <td> {{ isset($group->AcademicYear) !=null ? $group->AcademicYear : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>الفصل الدراسي</th>
                                                        <td>{{ isset($group->Semester) !=null ? $group->Semester : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection