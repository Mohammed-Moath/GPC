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
                    <span class="badge badge-pill badge-info"> <i class="fa fa-legal"></i> إقرار المشاريع - <span class="badge badge-pill badge-dark">  ({{$GroupWishe }})</span> </span>
                    <ul class="nav nav-tabs card-header-tabs ">      
                        <li class="nav-item">
                            <a class="nav-link active"><input id="radio1" name="radio" type="radio" checked/> حسب التاريخ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{url('project-committee/approval-projects2')}}"><input id="radio1" name="radio" type="radio" /> حسب الاولوية</a>
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
                    @if(count($Proposal) == 0)
                        <div class="alert alert-danger text-center" role="alert">
                            <i class="fa fa-warning"></i> لايوجد أي مشروع
                        </div>
                    @endif
                    @if(count($Proposal) != 0)
                        <table class="table table-hover table-sm ">   
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="text-center" scope="col">مشاريع الفصل الحالي</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Proposal as $p)
                                    <tr>
                                        <th scope="row">{{ isset($p->proposals->id) !=null ? $p->proposals->id : 'لاتوجد اي بيانات ليتم عرضها !'}}</th>
                                        <td class="text-center">{{ isset($p->proposals->ProjectProposalTitle) !=null ? $p->proposals->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a  title="تفاصيل المشروع" class="btn btn-outline-primary" href="{{url("project-committee/proposal/$p->proposals_id")}}"><i class="fa fa-folder-open-o"></i></a>
                                                <a title="بدء عملية الإقرار" href="{{ url("project-committee/approval-projects/bydate/$p->proposals_id")}}"  type="button" class="btn btn-secondary ">بدء عملية الإقرار</a>
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