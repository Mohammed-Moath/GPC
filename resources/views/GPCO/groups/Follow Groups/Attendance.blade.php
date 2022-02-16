@extends('layouts.Master.GPCO') 

@section('title')
 المجموعات | متابعة المجموعات | {{ $NameGroups }}
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-group"></i>  المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                           <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="متابعة المجموعات" href="{{ url('follow/groups') }}"><i class="fa fa-eye"></i> متابعة المجموعات </a>
                        </li>
                        <li  class="active">
                            {{ $NameGroups }} | الحضور والغياب
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                </div>
            </div> 
            <!-- /.row --> 

            <div class="row"> 
                @if( $NameGroups == "الطلاب")
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="اللقاءات" href="{{ url('follow-up/boys',1) }}" class="list-group-item list-group-item-info   group-q">
                                <strong>اللقاءات</strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="الحضور والغياب"  class="list-group-item list-group-item-info disabled  group-q">
                                <strong>الحضور والغياب </strong>
                            </a>
                        </div>
                        
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="التسليمات" href="{{ url('follow-up/boys',3) }}" class="list-group-item list-group-item-info   group-q">
                                <strong>التسليمات </strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                @endif
              
                @if( $NameGroups == "الطالبات")
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="اللقاءات" href="{{ url('follow-up/grils',1) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>اللقاءات</strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="الحضور والغياب"  class="list-group-item list-group-item-info disabled  group-q">
                                <strong>الحضور والغياب </strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="list-group text-center">
                            <a title="التسليمات" href="{{ url('follow-up/grils',3) }}" class="list-group-item list-group-item-info  group-q">
                                <strong>التسليمات </strong>
                            </a>
                        </div>
                        <hr>
                    </div>
                @endif
            </div>
            <!-- /.row -->  

            <div class="row"> 
                @if(count($Groups) ==0)
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-danger text-center" role="alert">
                            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>لاتوجد مجموعات</strong>
                        </div>
                    </div>
                @endif
                @if(count($Groups) !=0)
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>رئيس المجموعة</th>
                                        <th>مشرف المجموعة</th>
                                        <th>العام الجامعي</th>
                                        <th>الفصل الدراسي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Groups as $g)
                                    <tr>
                                        <td>{{ isset($g->id) !=null ? $g->id : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($g->project_supervisors->users->Name) !=null ? $g->project_supervisors->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($g->AcademicYear) !=null ? $g->AcademicYear : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($g->Semester) !=null ? $g->Semester : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td><a title="تفاصيل" href="{{ url("follow-up/group/$TypeGroups/$g->id/attendance") }}" class="btn btn-primary btn-xs "><i class="fa fa-folder-open"></i> تفاصيل</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.row -->       
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection