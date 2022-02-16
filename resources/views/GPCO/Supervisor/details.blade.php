@extends('layouts.Master.GPCO') 

@section('title')
    بيانات المشرفين | 
    @if($Result_Type == 1)
        جميع المشرفين
    @endif
    @if($Result_Type == 2)
        المشرفين المعفيين من الاشراف
    @endif
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-bar-chart"></i>  بيانات المشرفين
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <a title="بيانات المشرفين" href="{{ url('supervisors-data') }}"> <i class="fa fa-bar-chart"></i> بيانات المشرفين </a> 
                        </li>
                        <li class="active">
                            @if($Result_Type == 1)
                                جميع المشرفين
                            @endif
                            @if($Result_Type == 2)
                                المشرفين المعفيين من الاشراف
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
                        @if(count($Supervisors)==0)
                            <hr>
                            <div class="alert alert-danger text-center" role="alert">
                                <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong>لاتوجد بيانات</strong>
                            </div>
                        @endif
                        @if( count($Supervisors) != 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><span class="label label-default">الرقم الوظيفي</span></th>
                                        <th><span class="label label-default">أسم المشرف</span></th>
                                        <th><span class="label label-default">التخصص</span></th>
                                        <th><span class="label label-default">الدرجة العلمية</span></th>
                                        <th><span class="label label-default">تاريخ التسجيل</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Supervisors as $s)
                                        <tr>
                                            <td title="الرقم الوظيفي">{{ isset( $s->FunctionalNumber ) !=null ?  $s->FunctionalNumber  : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                                            <td title="اسم المشرف">{{ isset($s->users->Name) !=null ? $s->users->Name : 'لاتوجد أي بيانات ليتم عرضها !'	}}</td>
                                            <td title="تخصص المشرف">{{ isset($s->programs->ProgramName) !=null ? $s->programs->ProgramName : 'لاتوجد أي بيانات ليتم عرضها !' 	}}</td>
                                            <td  title=" الدرجة العلمية" >{{ isset($s->scientific_degrees->NameDegree) !=null ? $s->scientific_degrees->NameDegree : 'لاتوجد أي بيانات ليتم عرضها !' }}</td>
                                            <td title="تاريخ تسجيل المشرف">{{ isset( $s->created_at) !=null ?  $s->created_at : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                                            <th><a title="مشاهدة تفاصيل اكثر" href="{{url("supervisors-data/show/$s->FunctionalNumber")}}"> <i class="fa fa-plus-circle"></i> تفاصيل أكثر</a></th>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                @if( count($Supervisors) != 0)
                    <div class="col-md-12">
                        {!! $Supervisors->render() !!}
                    </div>
                @endif
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection