@extends('layouts.Master.Project-Committee') 

@section('title')
 إقرار المشاريع
@endsection

@section('content')

  <div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">   <i class="fa fa-legal"></i> إقرار المشاريع</li>
            </ol>
        </nav>
    </div>

    <div class="col-4">
      <div class="text-left">
      <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
        <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
      </div>
    </div>
  </div>



    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    <span class="badge badge-pill badge-info"> <i class="fa fa-legal"></i> إقرار المشاريع - <span class="badge badge-pill badge-dark">  ({{$GroupWishe}})</span> </span>
                    <ul class="nav nav-tabs card-header-tabs ">      
                        <li class="nav-item">
                            <a class="nav-link"  href="{{url('project-committee/approval-projects')}}"><input type="radio" /> حسب التاريخ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"><input  type="radio" checked /> حسب الاولوية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url("project-committee/approval-projects3")}}">تم أقرارها   <span class="badge badge-pill badge-dark">  ({{$Approval}})</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#}">الحالات الخاصة</a>
                        </li>
                    </ul> 
                </div>
                <div class="card-body">
                    @if(count($Groups) == 0)
                        <div class="alert alert-danger text-center" role="alert">
                            <i class="fa fa-warning"></i> لايوجد أي مجموعة
                        </div>
                    @endif
                    @if(count($Groups) != 0)
                        <table class="table table-hover table-sm ">   
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="text-center" scope="col">رئيس المجموعة</th>
                                    <th class="text-center" scope="col">المركز الدراسي</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Groups as $g)

                                        <tr>
                                            <th scope="row">{{ isset($g->groups_id) !=null ? $g->groups_id : 'لاتوجد اي بيانات ليتم عرضها !'}}</th>
                                            <td class="text-center">{{ isset($g->project_groups->project_students->users->Name) !=null ? $g->project_groups->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                            <td class="text-center">{{ isset($g->project_groups->branches->BrancheNameAR) !=null ? $g->project_groups->branches->BrancheNameAR : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a title="تفاصيل المجموعة"  class="btn btn-outline-primary" href="{{url("project-committee/groups/$g->groups_id/show")}}"><i class="fa fa-folder-open-o"></i></a>
                                                    <a title="بدء عملية الإقرار" type="button" class="btn btn-secondary"  href="{{url("project-committee/approval-projects2/$g->groups_id")}}">
                                                       بدء عملية الإقرار
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                        
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@Stop