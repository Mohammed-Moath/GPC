@extends('layouts.Master.GPCO') 

@section('title')
 بيانات الطلاب |
    @if($Result_Type == 1)
        جميع الطلاب
    @endif 
    @if($Result_Type == 2)
      المركز الرئيسي
    @endif 
    @if($Result_Type == 3)
       فرع الطالبات
    @endif 
    @if($Result_Type == 4)
       لايوجد لديهم مجموعات
    @endif 
    
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
           
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-bar-chart"></i>  بيانات الطلاب
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <a title="بيانات الطلاب"  href="{{ url('students-data') }}"><i class="fa fa-bar-chart"></i> بيانات الطلاب </a>
                        </li>
                        <li class="active">
                            @if($Result_Type == 1)
                                جميع الطلاب
                            @endif 
                            @if($Result_Type == 2)
                                المركز الرئيسي
                            @endif 
                            @if($Result_Type == 3)
                                فرع الطالبات
                            @endif 
                            @if($Result_Type == 4)
                                لايوجد لديهم مجموعات
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
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><span class="label label-default">الرقم الاكاديمي</span></th>
                                    <th><span class="label label-default">اسم الطالب</span></th>
                                    <th><span class="label label-default">التخصص</span></th>
                                    <th><span class="label label-default">المركز الدراسي</span></th>
                                    <th><span class="label label-default">تاريخ التسجيل</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Student as $s)
                                        <tr>
                                            <td title="الرقم الاكاديمي للطالب.">{{ isset( $s->AcdameicNumber ) !=null ?  $s->AcdameicNumber  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                                            <td title="اسم الطالب الرباعي">{{ isset($s->users->Name) !=null ? $s->users->Name : 'لاتوجد أي بيانات ليتم عرضها !'	}}</td>
                                            <td title="تخصص الطالب ">{{ isset($s->programs->ProgramName) !=null ? $s->programs->ProgramName : 'لاتوجد أي بيانات ليتم عرضها !' 	}}</td>
                                            <th  title="المركز الدراسي"class="text-center" >{{ isset($s->branches->BrancheNameAR) !=null ? $s->branches->BrancheNameAR : 'لاتوجد أي بيانات ليتم عرضها !' }}</th>
                                            <td title="تاريخ تسجيل الطالب">{{ isset( $s->created_at) !=null ?  $s->created_at : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                                            <th><a title="تفاصيل اكثر" href="{{url("student-data/show/$s->AcdameicNumber")}}"> <i class="fa fa-plus-circle"></i> تفاصيل أكثر</a></th>
                                        </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    {!! $Student->render() !!}
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection