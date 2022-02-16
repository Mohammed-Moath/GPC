@extends('layouts.Master.Project-Committee')

@section('title')
المتابعة
@endsection

@section('content')

<div class="row">
    <div class="col-8">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> <i class="fa fa-eye"></i> المتابعة</li>
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
                <span class="badge badge-pill badge-info"><i class="fa fa-eye"></i> المتابعة</span>
                {{ Form::open(["class"=>"pull-right","url"=>"project-committee/follow"]) }}
                <i class="fa fa-filter"></i>
                <select class="custom-select " name="filter" onchange="this.form.submit();">
                    <option value="1" {{ ($CF == 1 )  ? 'selected' : '' }}>الحالي</option>
                    <option value="2" {{  ($CF == 2 ) ? 'selected' : '' }}>نشط</option>
                    <option value="3" {{ ($CF == 3 ) ? 'selected' : '' }}>منتهي</option>
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
                        <caption class="text-left">متابعة المجموعات</caption>
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th class="text-center" scope="col">عنوان المشروع</th>
                                <th scope="col">رئيس المجموعة</th>
                                <th scope="col">المركز الدراسي</th>
                                <th scope="col">اللقاءات</th>
                                <th scope="col">التسليمات</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Groups as $g)
                            <tr>
                                <th scope="row">{{ isset($g->id) !=null ? $g->id : 'لاتوجد بيانات ليتم عرضها !'}}</th>
                                <td title="{{ isset($g->proposals->ProjectProposalTitle) !=null ? $g->proposals->ProjectProposalTitle : 'لاتوجد بيانات ليتم عرضها !'}}">
                                    <span class="hidetxt">
                                        {{ isset($g->proposals->ProjectProposalTitle) !=null ? $g->proposals->ProjectProposalTitle : 'لاتوجد بيانات ليتم عرضها !'}}
                                    </span>
                                </td>
                                <td>{{ isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                <td>{{ isset($g->branches->BrancheNameAR) !=null ? $g->branches->BrancheNameAR : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                <td>
                                    <span class="badge badge-pill badge-info"> ( {{ isset($g->Meetings) !=null ? count( $g->Meetings) : ''}} )</span>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-info"> ( {{ isset($g->delivs) !=null ? count( $g->delivs) : ''}} )</span>
                                </td>
                                <td> <a title="تفاصيل" class="btn btn-sm btn-outline-primary" href="{{url("#")}}"><i class="fa fa-folder-open-o"></i></a></td>
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