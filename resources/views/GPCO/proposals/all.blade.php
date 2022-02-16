@extends('layouts.Master.GPCO') 

@section('title')
@if($type == 2)
مقترحات تم أعتمادها
@endif
@if($type == 3)
مقترحات تم أختيارهاٍ
@endif
@if($type == 4)
جميع مقترحات المشاريع
@endif
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
                           <i class="fa fa-file-text-o"></i> المقترحات </a>
                        </li>
                        <li>
                            <a title="أدارة المقترحات" href="{{ url('Proposal')}}"><i class="fa fa-repeat"></i> أدارة المقترحات</a>
                        </li>
                        <li class="active">
                            @if($type == 2)
                               مقترحات تم أعتمادها
                            @endif
                            @if($type == 3)
                                مقترحات تم أختيارها
                            @endif
                            @if($type == 4)
                                جميع مقترحات المشاريع
                            @endif
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
                <div class="table-responsive">
                    @if(count($Proposal)==0)
                            
                        <div  class="alert alert-danger text-center"><h4><i class="fa fa-exclamation-triangle"></i>لايوجد أي مقترح</h4></div>
                           
                    @endif
                    @if(count($Proposal) !=0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>الرقم التسلسلي</th>
                                <th>عنوان المقترح</th>
                                <th>مقدم المقترح</th>
                            </tr>
                            </thead>
                            <tbody>
                        
                                @foreach($Proposal as $p) 
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ isset($p->ProjectProposalTitle) !=null ?  $p->ProjectProposalTitle : 'لا توجد اي بيانات ليتم عرضها !' }}</td>
                                        <td>
                                            {{ isset($p->users->Name) !=null ? $p->users->Name : 'لا توجد اي بيانات ليتم عرضها !' }}
                                            <span class="label label-warning">{{ isset($p->users->UserRoles->UserRoleAr) !=null ? $p->users->UserRoles->UserRoleAr : 'لا توجد اي بيانات ليتم عرضها !' }}</span>
                                        </td>
                                        <td><a title="تفاصيل" href="{{ url("review/proposal/$p->id/show") }}"><button type="button" class="btn btn-primary">تفاصيل  <i class="fa fa-folder-open-o"></i></button></a></td>
                                    </tr>
                                @endforeach
                        
                        
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($Proposal) !=0)
                        {{ $Proposal->links() }}
                    @endif
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection