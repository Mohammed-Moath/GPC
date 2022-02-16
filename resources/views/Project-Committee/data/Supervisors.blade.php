@extends('layouts.Master.Project-Committee')

@section('title','بيانات المشرفين')

@section('content')
<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> <i class="fa fa-bar-chart"></i> بيانات المشرفين</li>
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
                <span class="badge badge-pill badge-warning"> <i class="fa fa-bar-chart"></i> بيانات المشرفين</span>
                {{ Form::open(["class"=>"pull-right","url"=>"project-committee/data/supervisors"]) }}
                <i class="fa fa-filter"></i>
                <select class="custom-select " name="filter" onchange="this.form.submit();">
                    <option value="1" {{ ($SF == 1 )  ? 'selected' : '' }}>جميع المشرفين</option>
                    <!-- <option value="2" {{  ($SF == 2 ) ? 'selected' : '' }}>فرع الطلاب</option>
                    <option value="3" {{ ($SF == 3 ) ? 'selected' : '' }}> فرع الطالبات</option>
                    <option value="4" {{ ($SF == 4 ) ? 'selected' : '' }}>بدون مجموعة</option>
                    <option value="5" {{  ($SF == 5 ) ? 'selected' : '' }}> ضمن مجموعة</option> -->
                </select>
                {{ Form::close() }}
            </div>
            <div class="card-body">
                @if(count($Supervisors) == 0)
                <div class="alert alert-danger text-center" role="alert">
                    <i class="fa fa-warning"></i> لاتوجد بيانات !
                </div>
                @endif
                @if(count($Supervisors) != 0)
                <div class="table-responsive">
                    <table class="table  table-bordered table-hover table-sm  ">
                        <caption class="text-left">بيانات المشرفين</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" scope="col">الرقم الوظيفي</th>
                                <th class="text-center" scope="col">الاسم</th>
                                <th class="text-center" scope="col">التخصص</th>
                                <th class="text-center" scope="col">الدرجة العلمية </th>
                                <th class="text-center " scope="col"> <a title="Excle" href="{{ url('project-committee/data/supervisors/excle') }}" type="button" class="badge badge-success"><i class="fa fa-file-excel-o"></i></a></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($Supervisors as $sup)
                            <tr>
                                <td>{{ isset($sup->FunctionalNumber	) !=null ? $sup->FunctionalNumber	 : 'لاتوجد بيانات !'}}</td>
                                <td>{{ isset($sup->users->Name) !=null ? $sup->users->Name : 'لاتوجد بيانات !'}}</td>
                                <td>{{ isset($sup->programs->ProgramName) !=null ? $sup->programs->ProgramName : 'لاتوجد بيانات !'}}</td>
                                <td>{{ isset($sup->scientific_degrees->name) !=null ? $sup->scientific_degrees->name : 'لاتوجد بيانات !'}}</td>
                                <td>
                                    <a data-title="details" data-toggle="modal" data-id="Details_Suervisor_Data" data-target="#Details_Supervisor_Data-{{$sup->FunctionalNumber}}" title="تفاصيل" href='#' type="button" class="badge badge-info"><i class="fa fa-folder-open"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            </div>
        </div>
        @if(count($Supervisors)!=0)

        <div class="row">
            <div class="col-lg-12 ">
                <br>
                <div class="paginatios">
                    {!! $Supervisors->links() !!}
                </div>


            </div>
        </div>
        @endif
    </div>
</div><br>

@if(count($Supervisors)!=0)
@include('Project-Committee.data.Details_supervisor')

@endif

@Stop