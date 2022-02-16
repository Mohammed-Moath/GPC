@extends('layouts.Master.Project-Committee')

@section('title','بيانات الطلبة')

@section('content')
<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> <i class="fa fa-bar-chart"></i> بيانات الطلبة</li>
            </ol>
        </nav>
    </div>

    <div class="col-4">
        <div class="text-left">
            <a title="رجوع" href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('project-committee/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card ">
            <div class="card-header text-center">
                <span class="badge badge-pill badge-warning"> <i class="fa fa-bar-chart"></i> بيانات الطلبة</span>
                {{ Form::open(["class"=>"pull-right","url"=>"project-committee/data/students"]) }}
                <i class="fa fa-filter"></i>
                <select class="custom-select " name="filter" onchange="this.form.submit();">
                    <option value="1" {{ ($SF == 1 )  ? 'selected' : '' }}>جميع الطلبة</option>
                    <option value="2" {{  ($SF == 2 ) ? 'selected' : '' }}>فرع الطلاب</option>
                    <option value="3" {{ ($SF == 3 ) ? 'selected' : '' }}> فرع الطالبات</option>
                    <option value="4" {{ ($SF == 4 ) ? 'selected' : '' }}>بدون مجموعة</option>
                    <option value="5" {{  ($SF == 5 ) ? 'selected' : '' }}> ضمن مجموعة</option>
                </select>
                {{ Form::close() }}
            </div>
            <div class="card-body">
                @if(count($Studets) == 0)
                <div class="alert alert-danger text-center" role="alert">
                    <i class="fa fa-warning"></i> لاتوجد بيانات !
                </div>
                @endif
                @if(count($Studets) != 0)
                <div class="table-responsive">
                    <table class="table  table-bordered table-hover table-sm  ">
                        <caption class="text-left">بيانات الطلبة</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" scope="col">الرقم الاكاديمي</th>
                                <th class="text-center" scope="col">الاسم</th>
                                <th class="text-center" scope="col">الفرع</th>
                                <th class="text-center" scope="col">التخصص </th>
                                <th class="text-center " scope="col">المجموعة</th>
                                <th class="text-center " scope="col"> <a title="Excle" href="{{ url('project-committee/data/students/excle') }}" type="button" class="badge badge-success"><i class="fa fa-file-excel-o"></i></a></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($Studets as $stu)
                            <tr class="{{  ($stu->Current  == 1) ? 'table-info' : ''  }}">
                                <td>{{ isset($stu->AcdameicNumber	) !=null ? $stu->AcdameicNumber	 : 'لاتوجد بيانات !'}}</td>
                                <td>{{ isset($stu->users->Name) !=null ? $stu->users->Name : 'لاتوجد بيانات !'}}</td>
                                <td>{{ isset($stu->branches->BrancheNameAR) !=null ? $stu->branches->BrancheNameAR : 'لاتوجد بيانات !'}}</td>
                                <td>{{ isset($stu->programs->ProgramName) !=null ? $stu->programs->ProgramName : 'لاتوجد بيانات !'}}</td>
                                <td title="رقم مجموعة العمل">
                                    @if($stu->project_groups_id == null)
                                    <span class="badge  badge-danger">بدون مجموعة !</span>
                                    @endif
                                    @if($stu->project_groups_id != null)
                                    <span class="badge badge-pill badge-success">ضمن مجموعة</span>
                                    <!-- <span class="badge bg-green">{{ isset($stu->project_groups_id) !=null ? $stu->project_groups_id : ''}}</span>
                                    <a title="تفاصيل" href="{{ url("statistics-groups/$stu->project_groups_id/show") }}" class="btn btn-primary btn-xs "><i class="fa fa-folder-open"></i> تفاصيل</a> -->
                                    @endif
                                </td>
                                <td>
                                    <a data-title="details" data-toggle="modal" data-id="Details_Student_Data" data-target="#Details_Student_Data-{{$stu->AcdameicNumber}}" title="تفاصيل" href='#' type="button" class="badge badge-info"><i class="fa fa-folder-open"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            </div>
        </div>
        @if(count($Studets)!=0)

        <div class="row">
            <div class="col-lg-12 ">
                <br>
                <div class="paginatios">
                    {!! $Studets->links() !!}
                </div>


            </div>
        </div>
        @endif
    </div>
</div><br>

@if(count($Studets)!=0)
@include('Project-Committee.data.Details_student')

@endif

@Stop