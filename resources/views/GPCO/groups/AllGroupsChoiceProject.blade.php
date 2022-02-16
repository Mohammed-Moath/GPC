@extends('layouts.Master.GPCO') 

@section('title')
   أعتماد الرغبات  بحسب المشاريع المختاره 
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-group"></i>المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="أدارة المجموعات" href=" {{ url('manage/groups')}}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li>
                            <a title=" أعتماد الرغبات " href=" {{ url('approval-as-project')}}"><i class="fa fa-check-circle-o"></i> أعتماد الرغبات بحسب المشروع المختار </a> 
                        </li>
                        <li  class="active">
                          المشروع رقم : {{ $Proposal->id}} 
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
                <div class="col-lg-12 table-responsive"> 
                    <h3>
                        مشروع :
                        <a href="{{ url("review/proposal/$Proposal->id/show") }}" title="أنقر لمشاهدة تفاصيل المشروع"><span class="label label-default">{{$Proposal->ProjectProposalTitle}}</span> </a>
                        <hr>   
                    </h3>
                </div>    
              
                

                @if(count($Wishes)==0)
                    <hr>
                    <div class="alert alert-danger col-lg-12" role="alert">
                        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> لا توجد مجموعات ليتم عرضها
                    </div>
                @endif
                @if(count($Wishes)!=0)  
                    <div class="col-lg-12 table-responsive">
                        <h4><span class="label label-warning">المجموعات التي أبدت رغبتها في اخذ هذا المشروع :</span></h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الرقم التسلسلي للاختيار</th>
                                    <th>تاريخ الاختيار</th>
                                    <th>رئيس المجموعة</th>
                                    <th>المركز الدراسي</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Wishes as $w)
                                <tr>
                                    <th>
                                        {{ isset($w->id) !=null ? $w->id : 'لايوجد أي بيانات ليتم عرضها!' }}
                                    </th>
                                    <th> {{ isset($w->created_at) !=null ? $w->created_at : 'لايوجد أي بيانات ليتم عرضها!' }}</th>
                                    <th>
                                        @if( $Proposal->users_id === $w->project_groups->project_students->users->id )
                                            <i title="هذا الشخص هو من مقدم المقترح " class="fa fa-warning"></i>
                                        @endif

                                        {{ isset($w->project_groups->project_students->users->Name) !=null ? $w->project_groups->project_students->users->Name : 'لايوجد أي بيانات ليتم عرضها!' }}   
                                    </th>
                                    <th> {{ isset($w->project_groups->branches->BrancheNameAR) !=null ? $w->project_groups->branches->BrancheNameAR : 'لايوجد أي بيانات ليتم عرضها!' }}</th>
                                    <th><a title="تفاصيل" href="{{ url("statistics-groups/$w->groups_id/show")}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> تفاصيل </a></th>
                                    <th> <button data-title="Approval" data-toggle="modal" data-target="#Approval-{{$w->id}}" class="btn btn-success btn-xs" title="أعتماد المشروع للمجموعة"><i class="fa fa-check-circle-o"></i> أعتماد المشروع للمجموعة</button></th>
                                </tr>
                            @endforeach    
                            </tbody>
                        </table>    
                    </div>
                @endif
                
            </div> 
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @if(count($Wishes)!=0) 
        @include('GPCO.groups.NotesCommittee')
    @endif  
@endsection