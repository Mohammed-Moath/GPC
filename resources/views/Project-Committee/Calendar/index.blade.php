@extends('layouts.Master.Project-Committee') 

@section('title')
 التقويم
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"> <i class="fa fa-calendar"></i> التقويم</li>
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
            <div class="card ">
                <div class="card-header text-center">
                    <span class="badge badge-pill badge-info">   <i class="fa fa-calendar"></i> التقويم</span>
                    <div class="btn-group btn-group-sm float-left" role="group">
                        <a title="أنشاء تقويم" class="btn btn-outline-primary" href="{{ url('project-committee/calendar/create') }}" role="button"><i class="fa fa-plus-square"></i>  تقويم</a>
                        <a title="أنشاء موعد" class="btn btn-outline-info" href="{{ url('project-committee/calendar/appointments/create') }}" role="button"><i class="fa fa-plus-square"></i>  موعد</a>
                    </div>
                    {{ Form::open(["class"=>"pull-right","url"=>"project-committee/calendar"]) }}
                        <i class="fa fa-filter"></i>
                        <select class="custom-select " name="filter" onchange="this.form.submit();">
                            <option value="1" {{ ($CF == 1 )  ? 'selected' : '' }} >الحالي</option>
                            <option value="2" {{  ($CF == 2 ) ? 'selected' : '' }}>نشط</option>
                            <option value="3" {{ ($CF == 3 ) ? 'selected' : '' }}>غير نشط</option>
                            <option value="4" {{ ($CF == 4 ) ? 'selected' : '' }}>منتهي</option>
                            <option value="5" {{  ($CF == 5 ) ? 'selected' : '' }}> الجميع</option>
                        </select>
                    {{ Form::close() }}   
                </div>
                <div class="card-body">
                    @if(count($Calendars) == 0)
                        <div class="alert alert-danger text-center" role="alert">
                            <i class="fa fa-warning"></i> لايوجد أي تقويم
                        </div>
                    @endif
                    @if(count($Calendars) != 0)
                        <div class="table-responsive">
                            <table class="table  table-bordered table-hover table-sm  ">
                            <caption class="text-left">التقويم</caption>
                                <thead  class="thead-dark">
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">الحالة</th>
                                        <th class="text-center" scope="col">العام الجامعي</th>
                                        <th class="text-center" scope="col">الفصل الدراسي</th>
                                        <th class="text-center" scope="col">تاريخ البداية </th>
                                        <th class="text-center "  scope="col">تاريخ النهاية</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($Calendars as $cal)
                                        <tr class="{{  ($cal->Current  == 1) ? 'table-info' : ''  }}">
                                            <th>{{ isset($cal->id) !=null ? $cal->id : 'لاتوجد بيانات ليتم عرضها !'}}</th>
                                            <th>
                                                @if($cal->Active == 0)
                                                    <span class="badge badge-pill badge-secondary">غير نشط</span>
                                                @endif
                                                @if($cal->Active == 1)
                                                    <span class="badge badge-pill badge-success">نشط</span>
                                                @endif
                                                @if($cal->Active == 2)
                                                    <span class="badge badge-pill badge-danger">منتهي</span>
                                                @endif
                                            </th>
                                            <td >{{ isset($cal->AcademicYear	) !=null ? $cal->AcademicYear	 : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td >{{ isset($cal->Semester) !=null ? $cal->Semester : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td>{{ isset($cal->StartDate) !=null ? $cal->StartDate : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td>{{ isset($cal->EndDate) !=null ? $cal->EndDate : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                            <td>
                                                <a title="تفاصيل" href="{{ url("project-committee/calendar/$cal->id/show") }}" type="button" class="btn btn-primary btn-sm  btn-block"><i class="fa fa-folder-open"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                  
                </div>
            </div>
        </div>
    </div>
@Stop