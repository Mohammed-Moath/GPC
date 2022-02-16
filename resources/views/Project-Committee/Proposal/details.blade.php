@extends('layouts.Master.Project-Committee') 

@section('title')
    المقترحات | {{ isset($Type_pro) != null ? $Type_pro : ''}}
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a title="المقترحات" href="{{ url('project-committee/proposal') }}"><i class="fa fa-file-powerpoint-o"></i> المقترحات </a></li>
                    <li class="breadcrumb-item active">  {{ isset($Type_pro) !=null ? $Type_pro : 'لاتوجد بيانات ليتم عرضها !'}}</li>
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
                    <span class="badge badge-pill badge-info"><i class="fa fa-file-powerpoint-o"></i> المقترحات</span>
                        <div class="pull-right">
                            <i class="fa fa-calendar"></i>
                            <select class="custom-select " disabled>
                                <option > {{isset($calendar) !=null ? $calendar : ''}}</option>
                            </select>
                        </div>
                    
                     
                </div>
                <div class="card-body">
                    @if(count($Proposal) ==0)
                        <div class="alert alert-danger text-center" role="alert">
                            <i class="fa fa-warning"></i> لاتوجد مقترحات
                        </div>
                    @endif
                    @if(count($Proposal) !=0)
                        <div class="table-responsive ">
                            <table class="table table-sm table-hover">   
                                <caption class="text-left">المقترحات {{ isset($Type_pro) !=null ? $Type_pro : 'لاتوجد بيانات ليتم عرضها !'}} في التقويم {{isset($calendar) !=null ? $calendar : ''}}</caption>
                                <thead class="thead-dark">
                                    <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">العام الجامعي</th>
                                    <th class="text-center" scope="col">الفصل الدراسي</th>
                                    <th class="text-center" scope="col">عنوان المقترح</th>
                                    <th class="text-center" scope="col">تاريخ التقديم</th>
                                    <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($Proposal as $p) 
                                    <tr class="text-center">
                                        <th scope="row">{{ isset($p->id) !=null ? $p->id : 'لاتوجد بيانات ليتم عرضها !'}}</th>
                                        <td>{{ isset($p->calendars->AcademicYear) !=null ? $p->calendars->AcademicYear : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                        <td>{{ isset($p->calendars->Semester) !=null ? $p->calendars->Semester : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                        <td title="{{ isset($p->ProjectProposalTitle	) !=null ? $p->ProjectProposalTitle	 : 'لاتوجد بيانات ليتم عرضها !'}}"><span class="hidetxt">{{ isset($p->ProjectProposalTitle	) !=null ? $p->ProjectProposalTitle	 : 'لاتوجد بيانات ليتم عرضها !'}}</span></td>
                                        <td>{{ isset($p->created_at	) !=null ? $p->created_at	 : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                        <td><a title="تفاصيل" href="{{ url("project-committee/proposal/$p->id") }}" class="btn btn-outline-primary btn-sm  btn-block"><i class="fa fa-folder-open-o"></i></a></td>
                                    </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if(count($Proposal) !=0)
                    <div class="card-footer text-muted">
                        <nav aria-label="Page navigation example">
                        {{$Proposal->links('vendor.pagination.bootstrap-4')}}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
@Stop