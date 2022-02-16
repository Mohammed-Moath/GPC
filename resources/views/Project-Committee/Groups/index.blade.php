@extends('layouts.Master.Project-Committee')

@section('title')
المجموعات
@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> <i class="fa fa-group"></i> المجموعات</li>
            </ol>
        </nav>
    </div>

    <div class="col-4">
        <div class="text-left">
            <a title="رجوع" href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card ">
            <div class="card-header text-center">
                <span class="badge badge-pill badge-info"><i class="fa fa-group"></i> المجموعات</span>
                <!--a title="أنشاء مجموعة" class="btn btn-outline-primary  btn-sm float-left" href="{{ url('project-committee/group/create') }}" role="button"><i class="fa fa-plus-square-o"></i> أنشاء مجموعة </a-->
                {{ Form::open(["class"=>"pull-right","url"=>"project-committee/groups"]) }}
                <i class="fa fa-filter"></i>
                <select class="custom-select " name="filter" onchange="this.form.submit();">
                    <option value="1" {{ ($CF == 1 )  ? 'selected' : '' }}>الحالي</option>
                    <option value="2" {{  ($CF == 2 ) ? 'selected' : '' }}>نشط</option>
                    <option value="3" {{ ($CF == 3 ) ? 'selected' : '' }}>غير نشط</option>
                    <option value="4" {{  ($CF == 4 ) ? 'selected' : '' }}> الجميع</option>
                </select>
                {{ Form::close() }}
            </div>
            <div class="card-body">
                @if(count($Groups) == 0)
                <div class="alert alert-danger text-center" role="alert">
                    <i class="fa fa-warning"></i> لايوجد أي مجموعة
                </div>
                @endif
                @if(count($Groups) != 0)
                <div class="table-responsive-sm">
                    <table class="table table-sm table-hover">
                        <caption class="text-left">مجموعات العمل</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">العام الجامعي</th>
                                <th scope="col">الفصل الدراسي</th>
                                <th scope="col">رئيس المجموعة</th>
                                <th scope="col">المركز الدراسي</th>
                                <th scope="col">تاريخ الانشاء</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Groups as $g)
                            <tr>
                                <th scope="row">{{ isset($g->id) !=null ? $g->id : 'لاتوجد بيانات ليتم عرضها !'}}</th>
                                <td>{{ isset($g->calendars->AcademicYear) !=null ? $g->calendars->AcademicYear : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                <td>{{ isset($g->calendars->Semester) !=null ? $g->calendars->Semester : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                <td>{{ isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                <td>{{ isset($g->branches->BrancheNameAR) !=null ? $g->branches->BrancheNameAR : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                <td>{{ isset($g->created_at) !=null ? $g->created_at : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                <td> <a title="تفاصيل" class="btn btn-sm btn-outline-primary" href="{{url("project-committee/groups/$g->id/show")}}"><i class="fa fa-folder-open-o"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @if(count($Groups) != 0)
            <div class="card-footer text-muted">
                <nav aria-label="Page navigation example">
                    {{$Groups->links('vendor.pagination.bootstrap-4')}}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@Stop