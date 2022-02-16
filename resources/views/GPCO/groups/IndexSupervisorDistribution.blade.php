@extends('layouts.Master.GPCO') 

@section('title')
  توزيع المشرفين 
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
                        <i class="fa fa-group"></i>  المجموعات
                        </li>
                        <li>
                            <a title="أدارة المجموعات" href=" {{ url('manage/groups')}}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li  class="active">
                            <i class="fa fa-share-alt"></i>  توزيع المشرفين 
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
        
                @if(count($Groups)==0)
                    <div class="col-lg-12 col-md-12">
                        <hr>
                        <div class="alert alert-danger text-center col-lg-12 col-md-12" role="alert">
                            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>لاتوجد مجموعات</strong>
                        </div>
                    </div>
                @endif
                  
                @if(count($Groups)!=0)
                    <div class="col-lg-12 col-md-12">
                        <h3><i class="fa fa-share-alt"></i>   توزيع المشرفين    </h3> 
                    </div>    
                    <div class="table-responsive col-lg-12 col-md-12">
                        <table class="table   table-hover">
                            <thead>
                                <tr>
                                    <th colspan="4"><h4><span class="label label-success">المجموعات التي تم أعتماد مشاريعها</span></h4></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th><span class="label label-default">عنوان المشروع</span></th>
                                    <th><span class="label label-default">رئيس المجموعة</span></th>
                                    <th><span class="label label-default">المركز الدراسي</span></th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Groups as $g)
                                <tr>
                                    <th><a title="تفاصيل" href="{{ url('supervisor-distribution',$g->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> تفاصيل </a></th>
                                    <th> {{ isset($g->proposals->ProjectProposalTitle) !=null ? $g->proposals->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!' }}</th>
                                    <th> {{ isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لايوجد أي بيانات ليتم عرضها!' }}</th>
                                    <th> {{ isset($g->branches->BrancheNameAR) !=null ?$g->branches->BrancheNameAR : 'لايوجد أي بيانات ليتم عرضها!' }}</th>
                                </tr>
                            @endforeach 
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(count($Groups)!=0)
                    <div class="col-lg-12 col-md-12">
                        {{$Groups->links()}}
                    </div>
                @endif
              
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection