@extends('layouts.Master.Project-Committee') 

@section('title')
    مجموعة العمل رقم : {{ isset($Group->id) !=null ? $Group->id : ''}}
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{url("project-committee/groups")}}" title="المجموعات"><i class="fa fa-group"></i> المجموعات</a></li>
                    <li class="breadcrumb-item active"> مجموعة العمل رقم : {{ isset($Group->id) !=null ? $Group->id : ''}}</li>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   
                </div>
                <div class="card-body">
                    <div class="list-group col-sm-2 font-weight-bold">
                        <a href="#" class="list-group-item list-group-item-action text-info">اللقاءات <span class="badge badge-pill badge-dark">(0)</span></a>
                        <a href="#" class="list-group-item list-group-item-action text-info">التسليمات <span class="badge badge-pill badge-dark">(0)</span></a>
                        <a href="#" class="list-group-item list-group-item-action text-info">الطلبات <span class="badge badge-pill badge-dark">(0)</span></a>
                    </div>
                    <div class="table-responsive col-sm-6">
                        <table class="table table-sm table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" colspan="2" class="text-center">تفاصيل المجموعة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">العام الجامعي</th>
                                    <td>{{ isset($Group->calendars->AcademicYear) !=null ? $Group->calendars->AcademicYear :'لاتوجد بيانات ليتم عرضها !' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">الفصل الدراسي</th>
                                    <td>{{ isset($Group->calendars->Semester) !=null ? $Group->calendars->Semester :'لاتوجد بيانات ليتم عرضها !' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">المركز الدراسي</th>
                                    <td>{{ isset($Group->branches->BrancheNameAR) !=null ? $Group->branches->BrancheNameAR :'لاتوجد بيانات ليتم عرضها !' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">المشروع</th>
                                    <td title="{{ isset($Group->proposals->ProjectProposalTitle) !=null ? $Group->proposals->ProjectProposalTitle :'' }}"><span classe="hidetxt">{{ isset($Group->proposals->ProjectProposalTitle) !=null ? $Group->proposals->ProjectProposalTitle :'' }}<span></td>
                                </tr>
                                <tr>
                                    <th scope="row">المشرف</th>
                                    <td>{{ isset($Group->project_supervisors->users->Name) !=null ? $Group->project_supervisors->users->Name :'' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">أنشئت بواسطة</th>
                                    <td>{{ isset($Group->users->Name) !=null ? $Group->users->Name :'لاتوجد بيانات ليتم عرضها!' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">تاريخ الانشاء</th>
                                    <td>{{ isset($Group->created_at) !=null ? $Group->created_at :'لاتوجد بيانات ليتم عرضها!' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">أخر تحديث</th>
                                    <td>{{ isset($Group->updated_at) !=null ? $Group->updated_at :'لاتوجد بيانات ليتم عرضها!' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive col-sm-4">
                        @if(count($Group->ProjectStudent) ==0)
                            <div class="alert alert-danger text-center" role="alert">
                                <i class="fa fa-warning"></i> لايوجد أعضاء 
                            </div>
                        @endif
                        @if(count($Group->ProjectStudent) !=0)
                            <table class="table table-sm table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="text-center">الاعضاء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Group->ProjectStudent as $s)
                                        <tr>
                                            <th scope="row" class="text-center">
                                                {{ isset($s->users->Name) !=null ? $s->users->Name : 'لاتوجد بيانات ليتم عرضها !'}}
                                                @if($Group->GroupLader == $s->AcdameicNumber)
                                                    <span class="badge badge-pill badge-info">رئيس</span>
                                                @endif
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@Stop