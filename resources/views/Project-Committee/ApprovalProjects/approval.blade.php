@extends('layouts.Master.Project-Committee') 

@section('title')
 إقرار المشاريع
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">   <i class="fa fa-legal"></i> إقرار المشاريع</li>
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
            <div class="card">
                <div class="card-header text-center">
                    <span class="badge badge-pill badge-info"> <i class="fa fa-legal"></i> إقرار المشاريع - <span class="badge badge-pill badge-dark">  ({{$GroupWishe }})</span> </span>
                    <ul class="nav nav-tabs card-header-tabs ">      
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('project-committee/approval-projects')}} "><input id="radio1" name="radio" type="radio"/> حسب التاريخ </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{url('project-committee/approval-projects2')}}"><input id="radio1" name="radio" type="radio" /> حسب الاولوية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">تم أقرارها   <span class="badge badge-pill badge-dark">  ({{count($Approval)}})</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#}">الحالات الخاصة</a>
                        </li>
                    </ul> 
                </div>
                <div class="card-body">
                     @if(count($Approval) == 0)
                        <div class="alert alert-danger text-center" role="alert">
                            <i class="fa fa-warning"></i> لايوجد أي مجموعة
                        </div>
                    @endif
                    @if(count($Approval) != 0)
                        {{ Form::open(["url"=>"project-committee/approval-projects3"]) }}
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-hover ">
                                    <caption class="text-left">مشاريع التخرج التي تم أقرارها </caption>
                                    <thead class="thead-light ">
                                        <tr>
                                            <th colspan="6" scope="col">
                                                <div class="btn-group btn-group-sm float-left" role="group">
                                                    <button title="طباعة" type="button" class="btn btn-outline-dark "><i class="fa fa-print"></i></button> 
                                                    <button title="pdf" type="button" class="btn btn-outline-danger"><i class="fa fa-file-pdf-o"></i></button>
                                                    <button title="أعتماد نهائي" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> اعتماد نهائي</button>
                                                    <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>  
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="col">
                                                <label class="custom-control custom-checkbox ">
                                                    <input class="custom-control-input" title="أعتماد" type="checkbox" name="Groups[]" onchange="checkAll(this)">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <th scope="col">عنوان المشروع</th>
                                            <th scope="col">المجموعة</th>
                                            <th scope="col">المشرف</th>
                                            <th scope="col">الملاحظات</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Approval as $a)
                                            <tr>
                                                <th scope="row">
                                                    <label class="custom-control custom-checkbox ">
                                                        <input class="custom-control-input" title="أعتماد" type="checkbox" name="Groups[]" value="{{$a->id}}">
                                                        <span class="custom-control-indicator"></span>
                                                    </label>
                                                </th>
                                                <td><span class="hidetxt">{{ isset($a->proposals->ProjectProposalTitle) !=null ? $a->proposals->ProjectProposalTitle : 'لاتوجد بيانات ليتم عرضها !'}}</span></td>
                                                <td>
                                                    @foreach($a->project_groups->ProjectStudent as $stu)
                                                    - {{ isset($stu->users->Name) !=null ? $stu->users->Name  : 'لاتوجد بيانات ليتم عرضها !'}} </br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ isset($a->project_supervisors->users->Name) !=null ? $a->project_supervisors->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}
                                                </td>
                                                <td>{{ isset($a->NotesCommittee) !=null ? $a->NotesCommittee : '' }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a  title="تعديل" role="button" href="#" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                                                        <button title="حذف" type="button" class="btn btn-outline-danger"><i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        {{ Form::close() }}    
                    @endif
                </div>
            </div>
        </div>
    </div>
@Stop



@section('footer')
    <script type='text/javascript'>
        function checkAll(e) {
            var checkboxes = document.getElementsByName('Groups[]');
            
            if (e.checked) {
                for (var i = 0; i < checkboxes.length; i++) { 
                checkboxes[i].checked = true;
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
                }
            }
        }
    </script>      
    
@Stop