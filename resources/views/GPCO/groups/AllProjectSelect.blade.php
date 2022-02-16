@extends('layouts.Master.GPCO') 

@section('title')
   أعتماد الرغبات بحسب المشاريع المختارة
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                    <i class="fa fa-group"></i> المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                        <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="أدارة المجموعات" href=" {{ url('manage/groups')}}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li  class="active">
                            <i class="fa fa-check-circle-o"></i> أعتماد الرغبات بحسب التاريخ 
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
                <div class="col-lg-12 col-md-12">
                    <h3><i class="fa fa-check-circle-o"></i> أعتماد الرغبات <span class="label label-info"><strong>بحسب التاريخ</strong></span> </h3> 
                    @if(count($GW)==0)
                        <hr>
                        <div class="alert alert-danger text-center"   role="alert">
                            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>لايوجد مشاريع</strong>
                        </div>
                    @endif

                    @if(count($GW)!=0)
                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="4"><h4><span class="label label-warning">المشاريع التي تم أختيارها من قبل المجموعات :</span></h4></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($GW as $p)   
                                        <tr> 
                                            <th class="text-left">
                                                <a title="تفاصيل عن المجموعات التي اختارة هذا المشروع" href="groups-choice-project/{{ $p->id }}" class="btn btn-success btn-xs"><span class="badge">{{ isset($p->Selected) !=null ? $p->Selected :'ال' }}</span> مجموعات اختارة هذا المشروع </a>                
                                            </th>
                                            <th class="text-right">
                                                <a title="تفاصيل عن المشروع" href="{{ url("review/proposal/$p->id/show") }}" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> تفاصيل المشروع </a> 
                                            </th>
                                            <th>{{$p->ProjectProposalTitle}}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection