@extends('layouts.Master.Project-Committee') 

@section('title')
 التقويم | {{ isset($Calendar->Name) !=null ? $Calendar->Name : ''}}
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('project-committee/calendar') }}" title="التقويم"><i class="fa fa-calendar"></i> التقويم</a></li>
                    <li class="breadcrumb-item active">{{ isset($Calendar->Name) !=null ? $Calendar->Name : ''}}</li>
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
                    <strong>  {{ isset($Calendar->Name) !=null ? $Calendar->Name : ''}}</strong>
                    <div class="btn-group btn-group-sm float-left" role="group">
                        <a title="تعديل" class="btn btn-outline-warning" href="{{ url("project-committee/calendar/$Calendar->id/edit")}}" role="button"><i class="fa fa-edit"></i></a>
                        <button title="حذف"  class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">  <i class="fa fa-trash"></i> </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <p>
                        <a title="تفاصيل التقويم" class="btn btn-outline-secondary" data-toggle="collapse" href="#detile-cal" role="button" aria-expanded="false" aria-controls="collapseExample">
                            تفاصيل التقويم
                        </a>
                        <a title="تفاصيل ارتباطات التقويم" class="btn btn-outline-secondary" data-toggle="collapse" href="#rle-cal" role="button" aria-expanded="false" aria-controls="collapseExample">
                            تفاصيل ارتباطات التقويم
                        </a>
                        
                    </p>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" id="detile-cal">
                                <div class="card card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-hover">
                                                <thead class="thead-dark">  
                                                    <tr>
                                                        <th  class="text-center " colspan="2" scope="col">تفاصيل التقويم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">الحالة</th>
                                                        <td>
                                                            @if($Calendar->Active == 0)
                                                                <span class="badge badge-pill badge-secondary">غير نشط</span>
                                                            @endif
                                                            @if($Calendar->Active == 1)
                                                                <span class="badge badge-pill badge-success">نشط</span>
                                                            @endif
                                                            @if($Calendar->Active == 2)
                                                                <span class="badge badge-pill badge-danger">منتهي</span>
                                                            @endif
                                                            @if($Calendar->Current == 1)
                                                                <span class="badge badge-pill badge-info">الحالي</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">العام الجامعي</th>
                                                        <td>{{ isset($Calendar->AcademicYear) !=null ? $Calendar->AcademicYear : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">الفصل الدراسي</th>
                                                        <td>{{ isset($Calendar->Semester) !=null ? $Calendar->Semester : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">تاريخ بداية النشاط</th>
                                                        <td>{{ isset($Calendar->StartDate) !=null ? $Calendar->StartDate : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">تاريخ نهاية النشاط</th>
                                                        <td>{{ isset($Calendar->EndDate) !=null ? $Calendar->EndDate : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">أخر موعد لتقديم المقترحات</th>
                                                        <td>{{ isset($Calendar->EndSubmissionProposals) !=null ? $Calendar->EndSubmissionProposals : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">أخر موعد لتسجيل المشروع</th>
                                                        <td>{{ isset($Calendar->EndCreateGroup) !=null ? $Calendar->EndCreateGroup : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">أخر موعد لتسجيل الرغبات</th>
                                                        <td>{{ isset($Calendar->EndChooseWishes) !=null ? $Calendar->EndChooseWishes : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">تاريخ الانشاء</th>
                                                        <td>{{ isset($Calendar->created_at) !=null ? $Calendar->created_at : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">أنش بواسطة</th>
                                                        <td>{{ isset($Calendar->users->Name) !=null ? $Calendar->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center" colspan="2" scope="row">الملاحظات</th>
                                                    </tr>
                                                    <tr>
                                                        <td  colspan="2">{{ isset($Calendar->note) !=null ? $Calendar->note : '' }}</td>
                                                    </tr>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="collapse multi-collapse" id="rle-cal">
                                <div class="card card-body">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in
                                            <span class="badge badge-primary badge-pill">14</span>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                                        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card card-body">
                        @if(count($Calendar->appointments) !=0)
                            <div class="table-responsive">
                                <table class="table table-sm  table-hover">
                                        <thead class="thead-light">  
                                            <tr>
                                                <th  class="text-center " colspan="7" scope="col"><i class="fa fa-clock-o"></i> المواعيد</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th  class="text-center " > النوع</th>
                                                <th  class="text-center " > الموضوع</th>
                                                <th  class="text-center " > تاريخ البدء</th>
                                                <th  class="text-center " > تاريخ الانتهاء</th>
                                                <th  class="text-center " > الوصف</th>
                                                <th  class="text-center " > أنش بواسطة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($Calendar->appointments as $a)
                                                <tr>
                                                    <td>    
                                                        <div class="btn-group btn-group-sm float-left" role="group">
                                                            <a title="تعديل" class="btn btn-outline-warning" href="{{url("project-committee/appointments/$a->id/edit")}}" role="button"><i class="fa fa-edit"></i></a>
                                                            <button title="حذف"  class="btn btn-outline-danger" data-toggle="modal" data-target="#appointments-{{$a->id}}">  <i class="fa fa-trash"></i> </button>
                                                        </div>
                                                    </td>
                                                    <td class=" text-center">
                                                        @if($a->type ==1)
                                                            تسليم   
                                                        @endif
                                                        @if($a->type ==2)
                                                            مناقشة   
                                                        @endif
                                                        @if($a->type ==3)
                                                            حدث   
                                                        @endif
                                                    </td>
                                                    <td class=" text-center">{{ isset($a->name) !=null ? $a->name : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                                    <td class=" text-center">{{ isset($a->time_open) !=null ? $a->time_open : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                                    <td class=" text-center">{{ isset($a->time_close) !=null ? $a->time_close : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                                    <td class=" text-center">{{ isset($a->descrdiption) !=null ? $a->descrdiption : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                                    <td class=" text-center">{{ isset($a->users->Name) !=null ? $a->users->Name : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        @endif
                        @if(count($Calendar->appointments) ==0)
                            <div class="alert alert-danger text-center" role="alert">
                                <i class="fa fa-warning"></i> لايوجد لهذا التقويم أي مواعيد 
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Project-Committee.Calendar.delete')
    @include('Project-Committee.Calendar.Appointments.delete')
@Stop