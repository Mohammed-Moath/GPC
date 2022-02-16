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
                    <li class="breadcrumb-item active">  حسب التاريخ</li>
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
            {{ Form::open(["url"=>"project-committee/approval-projects/bydate/$Proposal->id/submit"]) }}
                <div class="card">
                    <div class="card-header text-center font-weight-bold">
                        {{ isset($Proposal->ProjectProposalTitle) !=null ? $Proposal->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}
                        <div class="btn-group btn-group-sm float-left" role="group">
                            <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                            <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>   
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($GW)== 0)
                            <div class="alert alert-danger  text-center" role="alert">
                                <i class="fa fa-warning"></i> لاتوجد بيانات
                            </div>
                        @endif
                        @if(count($GW)!= 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th scope="col"></th>
                                        <th scope="col">ملاحظات</th>
                                        <th scope="col">رئيس المجموعة</th>
                                        <th scope="col">المركز الدراسي</th>
                                        <th scope="col">تاريخ الاختيار</th>
                                        <th scope="col">رقم الاولوية</th>  
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($GW as $g)
                                            <tr class=" {{ $errors->has('Groups') ? ' has-error' : '' }}">
                                                <th scope="row">
                                                    <label class="custom-control custom-checkbox ">
                                                        <input class="custom-control-input" title="أعتماد" type="checkbox" name="Groups[]" value="{{$g->groups_id}}">
                                                        <span class="custom-control-indicator"></span>
                                                    </label>
                                                </th>
                                                <th scope="row">
                                                    <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#{{$g->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                        <i class="fa fa-plus-square-o"></i>
                                                    </a>
                                                    <div class="collapse" id="{{$g->id}}">
                                                        {!! Form::textarea("NotesCommittee[{$g->groups_id}]",null,['id'=>'NotesCommittee','class'=>'form-control','placeholder'=>'ملاحظات ورأي اللجنة للمجموعة','title'=>'ملاحظات ورأي اللجنة']) !!}         
                                                    </div>
                                                </th>
                                                <td>{{ isset($g->project_groups->project_students->users->Name) !=null ? $g->project_groups->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                                <td>{{ isset($g->project_groups->branches->BrancheNameAR) !=null ? $g->project_groups->branches->BrancheNameAR : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                                <td>{{ isset($g->created_at) !=null ? $g->created_at : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                                <td><span class="badge badge-pill badge-info">{{ isset($g->priority) !=null ? $g->priority : 'لم تحدد !'}}</span></td>
                                                <td>  <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-folder-open-o"></i></a></td>
                                            </tr>
                                            @if ($errors->has('Semester'))
                                                <span class="masseg_error">
                                                    <strong>{{ $errors->first('Groups') }}</strong>
                                                </span>
                                            @endif  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="card-header text-center font-weight-bold">توزيع المشرف</div>
                    <div class="card-body">
                        @if($Proposal->PropertyRight == 3)
                            <div class="alert alert-danger text-center">
                                <strong><i class="fa fa-warning"></i>  تنبيه !!</strong> مقدم المشروع الخاص بهذه المجموعة  هو الاستاذ :  <strong> {{ isset($Proposal->users->Name) !=null ? $Proposal->users->Name : 'لاتوجد بيانات ليتم عرضها !'}} </strong> ويرغب في أن يكون مشرف عليه. 
                            </div>
                        @endif
                        <div class="table-responsive col-lg-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="info">
                                        <th colspan="3" class="text-center"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square-o"></i></button> المشرفين المتوقع أشرافهم على مشروع هذه المجموعة </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($SE)==0)
                                        <tr>
                                            <td colspan="3" class="alert alert-danger text-center"><i class="fa fa-warning"></i> لم يتم تحديد اي مشرف من قبل اللجنة</td>
                                        </tr>
                                    @endif
                                    @if(count($SE)!=0)
                                        @foreach($SE as $s)
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
            {{ Form::close() }}      
        </div>
    </div>
    @include('Project-Committee.ApprovalProjects.add-supervisor')
@Stop
