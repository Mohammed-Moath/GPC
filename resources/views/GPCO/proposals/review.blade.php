@extends('layouts.Master.GPCO') 

@section('title')

مقترحات جديدة لم تراجع
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
                        <li>
                            <a title="أدارة المقترحات"  href="{{ url('Proposal')}}"><i class="fa fa-repeat"></i> أدارة المقترحات</a>
                        </li>
                        <li class="active">
                            مقترحات جديدة لم تراجع. 
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                        <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                    <div class="col-md-10 col-xs-12  pagetitle"> مقترحات جديدة لم تراجع</div>
                </div>
            </div> 
            <!-- /.row -->
            @foreach($Proposal as $p) 
                <div class="row"> 
               
                       <div class="col-xs-12 ">
                            <div class="blockquote-box-proposal table-responsive col-xs-12">
                                <div class=" d-img">
                                        <span class="image-user-Proposals">
                                            <img title="مقدم هذا المقترح" class="img-rounded"  src="{{ isset($p->users->PresonalPicture) !=null ?  asset($p->users->PresonalPicture) : 'لاتوجد بيانات!' }}" alt="لاتوجد صورة ">
                                        </span> 
                                </div>    
                                <div class=" d-p">
                                        <h5 title="مقدم المقترح">
                                            <i class="fa fa-user"></i> | {{ isset($p->users->Name) !=null ?  $p->users->Name : 'لايوجد أي بيانات ليتم عرضها!.' }}
                                        </h5>
                                        <h5 title="صفة مقدم المقترح">
                                        | <span class="label label-info">{{ isset($p->users->UserRoles->UserRoleAr) !=null ?  $p->users->UserRoles->UserRoleAr : 'لايوجد أي بيانات ليتم عرضها!.' }}</span>
                                        </h5>
                                        <h5 title="تاريخ التقديم">
                                            <i class="fa fa-clock-o"></i> |  {{ isset($p->created_at)  ?  $p->created_at : 'هناك خطأ!' }}
                                        </h5>
                                    
                                        <h5 title="الرقم التسلسلي للمقترح">
                                            <stron>#</strong> | {{ isset($p->id) !=null ?  $p->id : 'لايوجد أي بيانات ليتم عرضها!.' }}
                                        </h5>
                                </div>
                                    </br>

                                <div class="d-t">
                                    <a title="تفاصيل" href="Proposal/{{ $p->id }}"> {{ isset($p->ProjectProposalTitle) !=null ?  $p->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.' }}</a>
                                </div>
                                <a title="تفاصيل" href="Proposal/{{ $p->id }}"><button type="button" class="btn btn-primary">تفاصيل  <i class="fa fa-folder-open-o"></i></button></a>
                            
                                <a title="تعديل" href="Proposal/{{ $p->id }}/edit"><button type="button" class="btn btn-warning">تعديل <i class="fa fa-edit"></i></button></a>
                            </div>
                    
                        </div>    
            
                

            
                </div>
                </br>
            @endforeach
            <!-- /.row -->    
            <div class="row">
                <div class="col-md-12">
                    {{ $Proposal->links() }}
                </div>
            </div>
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


    
@endsection