@extends('layouts.Master.GPCO') 

@section('title')

    @if($type == 1)
    كافة المجموعات التي أنُشئت
    @endif
    @if($type == 2)
    مجموعات الطلاب
    @endif
    @if($type == 3)
    مجموعات الطالبات
    @endif
    @if($type == 4)
    المجموعات النهائية معتمد لها مشروع ومشرف
    @endif
    @if($type == 5)
    مجموعات معتمد لها مشروع 
    @endif
    @if($type == 6)
    مجموعات لم يعتمد لها مشروع 
    @endif
    @if($type == 7)
    مجموعات تم توزيع مشرفين لها
    @endif
    @if($type == 8)
    مجموعات لم يوزع مشرفين لها
    @endif

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
                            <a title="أدارة المجموعات" href="{{ url('manage/groups') }}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li  class="active">
                            @if($type == 1)
                            كافة المجموعات التي أنُشئت
                            @endif
                            @if($type == 2)
                            مجموعات الطلاب
                            @endif
                            @if($type == 3)
                            مجموعات الطالبات
                            @endif
                            @if($type == 4)
                            المجموعات النهائية معتمد لها مشروع ومشرف
                            @endif
                            @if($type == 5)
                            مجموعات معتمد لها مشروع 
                            @endif
                            @if($type == 6)
                            مجموعات لم يعتمد لها مشروع 
                            @endif
                            @if($type == 7)
                            مجموعات تم توزيع مشرفين لها
                            @endif
                            @if($type == 8)
                            مجموعات لم يوزع مشرفين لها
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
                <div class="table-responsive col-md-12">
                    @if(count($Groups)==0)   
                        <div  class="alert alert-danger text-center"><h4><i class="fa fa-exclamation-triangle"></i>لاتوجد أي مجموعة </h4></div>  
                    @endif
                    @if(count($Groups) !=0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>الرقم التسلسلي</th>
                                <th>العام الجامعي</th>
                                <th>الفصل الدراسي</th>
                                <th>رئيس المجموعة</th>
                            </tr>
                            </thead>
                            <tbody>
                        
                                @foreach($Groups as $g) 
                                    <tr>
                                        <td>{{ isset($g->id) !=null ? $g->id : 'لاتوجد أي بيانات ليتم عرضها' }}</td>
                                        <td>{{ isset($g->AcademicYear) !=null ?  $g->AcademicYear : 'لا توجد اي بيانات ليتم عرضها !' }}</td>
                                        <td>{{ isset($g->Semester) !=null ?  $g->Semester : 'لا توجد اي بيانات ليتم عرضها !' }}</td>
                                        <td>
                                            {{ isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لا توجد اي بيانات ليتم عرضها !' }}
                                        </td>
                                        <td><a title="تفاصيل" href="{{ url("statistics-groups/$g->id/show") }}"><button type="button" class="btn btn-primary">تفاصيل  <i class="fa fa-folder-open-o"></i></button></a></td>
                                    </tr>
                                @endforeach
                        
                        
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($Groups) !=0)
                        {{ $Groups->links() }}
                    @endif
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection