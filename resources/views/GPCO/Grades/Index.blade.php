@extends('layouts.Master.GPCO') 

@section('title')
    الدرجات
@endsection 



@section('content')
   <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                        <i class="fa fa-check-square-o"></i> الدرجات 
                    </h3>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-check-square-o"></i> الدرجات 
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
                        <div class="alert alert-danger text-center col-lg-12 col-md-12" role="alert">
                            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> <strong> لاتوجد بيانات </strong>
                        </div>
                    </div>
                @endif
                @if(count($Groups)!=0)
                    <div class="col-lg-12">
                        @foreach($Groups as $g)
                            @if(count($g->ProjectStudent) != 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="6" class="text-center info">{{ isset($g->proposals->ProjectProposalTitle) !=null ? $g->proposals->ProjectProposalTitle : 'لاتوجد بيانات ليتم عرضها !'}}</th>
                                            </tr>
                                            <tr>
                                            <th>أسم الطالب</th>
                                            <th>درجة الحضور</th>
                                            <th>درجة التسليمات</th>
                                            <th>درجة المشرف</th>
                                            <th>درجة المناقشة النصفية</th>
                                            <th>درجة النهائية</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $g->ProjectStudent as $s)
                                                <tr>
                                                    <td>
                                                        <a href="{{ url("GPCO/grades/$s->AcdameicNumber/edit")}}" title="تعديل"><button  type="button" class="btn  btn-xs"> <i class="fa fa-pencil"></i></i></button></a>
                                                        {{ isset($s->users->Name) !=null ? $s->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    <td><span class="badge">{{ isset($s->Degree_attendance) !=null ? $s->Degree_attendance : 'لاتوجد بيانات ليتم عرضها !' }}</span></td>
                                                    <td><span class="badge">{{ isset($s->Degree_delivery) !=null ? $s->Degree_delivery : 'لاتوجد بيانات ليتم عرضها !' }}</span></td>
                                                    <td><span class="badge">{{ isset($s->Degree_Supervisor) !=null ? $s->Degree_Supervisor : 'لاتوجد بيانات ليتم عرضها !' }}</span></td>
                                                    {!! Form::open(["url"=>"GPCO/grades/$s->AcdameicNumber/add"]) !!} 
                                                        <td><input name="Degree_Midterm_discussion"  type="number" class="text-center" placeholder="{{ isset($s->Degree_Midterm_discussion) !=null ? $s->Degree_Midterm_discussion : '' }}" ></td>
                                                        <td><input name="Degree_Final_discussion"  type="number" class="text-center" placeholder="{{ isset($s->Degree_Final_discussion) !=null ? $s->Degree_Final_discussion : '' }}" ></td>
                                                        <td><button type="submit" title="تحديث" class="btn btn-success"><i class="fa fa-refresh"></i></button></td>
                                                        <td><button type="button" class="btn  btn-primary" disabled><i class="fa fa-check-circle"></i> تخريج</button></td>
                                                    {!! Form::close() !!}
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- /.row -->    
        </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@Stop



