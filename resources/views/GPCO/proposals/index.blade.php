@extends('layouts.Master.GPCO') 

@section('title')
    أدارة المقترحات
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-file-text-o"></i>  المقترحات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                           <i class="fa fa-file-text-o"></i> المقترحات   
                        </li>
                        <li class="active">
                            <i class="fa fa-repeat"></i> أدارة المقترحات
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>    
                </div>
            </div> 
            <!-- /.row --> 
            <h2> <i class="fa fa-bar-chart"></i> أحصائيات سريعة لمقترحات المشاريع</h2> <hr> 
            <div class="row">
           
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge">
                                        {{ isset($New)  ?  $New : 'هناك خطأ!' }}
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><strong>مقترحات جديدة لم تراجع</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($New != 0)
                            <a title="التفاصيل" href="{{ url('review/1') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">التفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge">
                                        {{ isset($Certified)  ?  $Certified : 'هناك خطأ!' }}
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                   
                                    <div><strong>مقترحات معتمده</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($Certified !=0)
                            <a title="التفاصيل" href="{{ url('review/2') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">التفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green"> 
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge">
                                        {{ isset($Selected)  ?  $Selected : 'هناك خطأ!' }}
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><strong>مقترحات تم أختيارها</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($Selected !=0)
                            <a title="التفاصيل" href="{{ url('review/3') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">التفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div> 
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-Default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 pull-left">
                                    <div class="huge badge"> {{ isset($All)  ?  $All : 'هناك خطأ!' }}</div>
                                </div>
                                <div class="col-xs-9 text-right">
                                   
                                    <div><strong>جميع المقترحات</strong></div>
                                </div>
                            </div>
                        </div>
                        @if($All !=0)
                            <a title="التفاصيل" href="{{ url('review/4') }}">
                                <div class="panel-footer">
                                    <span class="pull-right">التفاصيل</span>
                                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection