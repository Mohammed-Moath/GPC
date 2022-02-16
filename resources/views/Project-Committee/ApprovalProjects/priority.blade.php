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
            {{ Form::open(["url"=>"project-committee/approval-projects2/asprioirty/$Group->id/$Proposal->id"]) }}
                <div class="card">
                <div class="card-header text-center font-weight-bold">
                   مجموعة :  {{ isset($Group->project_students->users->Name) !=null ? $Group->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !'}} - 
                   {{ isset($Group->branches->BrancheNameAR) !=null ? $Group->branches->BrancheNameAR : 'لاتوجد اي بيانات ليتم عرضها !'}}
                    <div class="btn-group btn-group-sm float-left" role="group">
                        <button title="تفاصيل المجموعة" type="button" class="btn btn-outline-primary"><i class="fa fa-folder-open-o"></i></button>
                        <button title="حالة خاصة" type="button" class="btn btn-outline-secondary ">حالة خاصة</button> 
                        <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                        <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>  
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
                                        <td scope="row">
                                            @if($GW->proposals_id == $Proposal->id)
                                                <button title="معتمد" type="button" class="btn btn-success btn-sm"> <i class="fa fa-check-circle-o"></i></button>
                                            @endif
                                            @if($GW->proposals_id != $Proposal->id)
                                                <a title="اعتماد" type="button" class="btn btn-outline-success  btn-sm" href="{{url("project-committee/approval-projects2/asprioirty/$Group->id/$GW->proposals_id")}}"><i class="fa fa-circle-o"></i></a> 
                                            @endif
                                        </td>
                                        <td scope="row" class="hidetxt" title="{{ isset($GW->proposals->ProjectProposalTitle) !=null ? $GW->proposals->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}">
                                            {{ isset($GW->proposals->ProjectProposalTitle) !=null ? $GW->proposals->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}
                                        </td>
                                        <td>{{ isset($GW->created_at) !=null ? $GW->created_at : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                        <td><span class="badge badge-pill badge-info">{{ isset($GW->priority) !=null ? $GW->priority : 'لم تحدد !'}}</span></td>
                                        <td><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-folder-open-o"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header text-center font-weight-bold">توزيع المشرف</div>
                                <div class="card-body">
                                    @if($Proposal->PropertyRight == 3)
                                        <div class="alert alert-danger text-center">
                                            <strong><i class="fa fa-warning"></i>  تنبيه !!</strong> مقدم المشروع الخاص بهذه المجموعة  هو الاستاذ :  <strong> {{ isset($Proposal->users->Name) !=null ? $Proposal->users->Name : 'لاتوجد بيانات ليتم عرضها !'}} </strong> ويرغب في أن يكون مشرف عليه. 
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr class="info">
                                                    <th colspan="3" class="text-center"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square-o"></i></button> المشرفين المتوقع أشرافهم على مشروع هذه المجموعة </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($Proposal->supervisor_expecteds)==0)
                                                    <tr>
                                                        <td colspan="3" class="alert alert-danger text-center"><i class="fa fa-warning"></i> لم يتم تحديد اي مشرف من قبل اللجنة</td>
                                                    </tr>
                                                @endif
                                                @if(count($Proposal->supervisor_expecteds)!=0)
                                                    @foreach($Proposal->supervisor_expecteds as $s)
                                                        <tr>
                                                            <td class="text-center">
                                                                <label class="custom-control custom-radio">
                                                                    <input id="{{$s->FunctionalNumber}}" name="Supervisor" type="radio" value="{{$s->FunctionalNumber}}" class="custom-control-input">
                                                                    <span class="custom-control-indicator"></span>
                                                                </label>
                                                            </td> 
                                                            <td class="text-center">
                                                                {{ isset($s->project_supervisors->users->Name) !=null ? $s->project_supervisors->users->Name : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                                            </td> 
                                                            <td class="text-center">
                                                                <div class="btn-group btn-group-sm" role="group">
                                                                    <a href="{{url('#')}}" title="تفاصيل" type="button" class="btn btn-primary "><i class="fa fa-folder-open-o"></i></a>
                                                                    <a href="{{ url("project-committee/approval-projects/delete/supervisor/$s->FunctionalNumber/$Proposal->id") }}" title="حذف" type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                                                </div>    
                                                            </td> 
                                                        </tr>
                                                    @endforeach
                                                @endif    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                            <div class="card-header text-center font-weight-bold">الملاحظات</div>
                            <div class="card-body">
                                {!! Form::textarea("NotesCommittee",null,['id'=>'NotesCommittee','class'=>'form-control','placeholder'=>'ملاحظات ورأي اللجنة للمجموعة','title'=>'ملاحظات ورأي اللجنة']) !!}         
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}      
        </div>
    </div>
    @include('Project-Committee.ApprovalProjects.add-supervisor')  
@Stop
