@extends('layouts.Master.Project-Committee') 

@section('title')
 إقرار المشاريع
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a title="إقرار المشاريع" href="{{url('project-committee/approval-projects')}}">  <i class="fa fa-legal"></i> إقرار المشاريع</a></li>
                    <li class="breadcrumb-item active">  حسب الاولوية</li>
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
            {{ Form::open(["url"=>"project-committee/approval-projects/bydate/1/submit"]) }}
                <div class="card">
                <div class="card-header text-center font-weight-bold">
                   مجموعة :  {{ isset($Group->project_students->users->Name) !=null ? $Group->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !'}} - 
                   {{ isset($Group->branches->BrancheNameAR) !=null ? $Group->branches->BrancheNameAR : 'لاتوجد اي بيانات ليتم عرضها !'}}
                    <div class="btn-group btn-group-sm float-left" role="group">
                        <button title="تفاصيل المجموعة" type="button" class="btn btn-outline-primary"><i class="fa fa-folder-open-o"></i></button>
                        <button title="حالة خاصة" type="button" class="btn btn-outline-secondary ">حالة خاصة</button> 
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col"></th>
                                <th scope="col">عنوان المشروع</th>
                                <th scope="col">تاريخ الاختيار</th>
                                <th scope="col">رقم الاولوية</th>  
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Group->GroupWishe as $GW)
                                    <tr>
                                        <th scope="row">
                                        <a title="اعتماد" type="button" class="btn btn-outline-success  btn-sm" href="{{url("project-committee/approval-projects2/asprioirty/$Group->id/$GW->proposals_id")}}"><i class="fa fa-circle-o"></i></a> 
                                        </th>
                                        <td class="hidetxt" title="{{ isset($GW->proposals->ProjectProposalTitle) !=null ? $GW->proposals->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}">{{ isset($GW->proposals->ProjectProposalTitle) !=null ? $GW->proposals->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                        <td>{{ isset($GW->created_at) !=null ? $GW->created_at : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                        <td><span class="badge badge-pill badge-info">{{ isset($GW->priority) !=null ? $GW->priority : 'لم تحدد !'}}</span></td>
                                        <td>  <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-folder-open-o"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{ Form::close() }}      
        </div>
    </div>
   
@Stop
