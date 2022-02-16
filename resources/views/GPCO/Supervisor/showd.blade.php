@extends('layouts.Master.GPCO') 

@section('title')
تفاصيل بيانات المشرف {{$Supervisors_Data->FunctionalNumber}}
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-bar-chart"></i> بيانات المشرفين 
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-bar-chart"></i> بيانات المشرفين
                        </li>
                        <li >
                            <a  href="{{ url('control/FacultyMember')}}"><i class="fa fa-repeat"></i> أدارة بيانات المشرفين</a>
                        </li>
                        <li class="active">
                             <i class="fa fa-plus-square"></i> مشرفي مشاريع التخرج   
                        </li>
                        <li>
                             تفاصيل بيانات المشرف {{$Supervisors_Data->FunctionalNumber}}
                        </li>
                        <li  class="pull-left">
                            <a href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a class="pull-left" href="{{ url('control/FacultyMember') }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                    <div class="col-md-10 col-xs-12  pagetitle"> تفاصيل بيانات المشرف {{$Supervisors_Data->FunctionalNumber}} </div>
                </div>
            </div> 
            <!-- /.row -->
           
            <div class="row"> 
                <div class="col-lg-12 col-xs-12">
                    <div class="col-lg-2">
                        <span class="image-user-stu">
                            <img title="المشرف {{$Supervisors_Data->users_id}}" class="img-rounded"  src="{{ asset($Supervisors_Data->users->PresonalPicture) }}" alt="خطأ غير متوقع في تحميل صورة المشرف {{ $Supervisors_Data->users->FirstName	}} {{ $Supervisors_Data->users->SecondName	}} {{ $Supervisors_Data->users->TirdName	}} {{ $Supervisors_Data->users->NickName	}}">
                        </span>
                    </div>
                    <div class="col-lg-8">
                       <ul>
                           <li><strong>الرقم الوظيفي : </strong>{{$Supervisors_Data->FunctionalNumber}}</li>
                           <li><strong>اسم المشرف : </strong>{{ $Supervisors_Data->users->FirstName	}} {{ $Supervisors_Data->users->SecondName	}} {{ $Supervisors_Data->users->TirdName	}} {{ $Supervisors_Data->users->NickName	}}</li>
                           <li><strong>عدد الساعات التدريسية في الاسبوع للمشرف  : </strong>{{$Supervisors_Data->HoursOfService}}</li>
                           <li><strong>الدرجة العلمية : </strong>{{$Supervisors_Data->scientific_degrees->NameDegree}}</li>
                           <li><strong>التخصص : </strong>{{$Supervisors_Data->programs->ProgramName}}</li>
                         
                           
                       </ul>
                    </div>
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

