@extends('GPCO.layouts.MastarGPCO') 

@section('title')
تسجيل طالب 
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
                        <li class="active">
                          <i class="fa fa-bar-chart"></i> بيانات المشرفين 
                        </li>
                        <li>
                            <i class="fa fa-plus-circle"></i> تسجيل مشرف
                        </li>
                        <li  class="pull-left">
                            <a href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a class="pull-left" href="{{ url('home/GPCO') }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                    <div class="col-md-10 col-xs-12  pagetitle"><i class="fa fa-plus-circle"></i> تسجيل مشرف مشروع تخرج </div>
                </div>
            </div> 
            <!-- /.row -->
           
            <div class="row"> 
                <div class="col-lg-12 col-xs-12 Proposal">
                    {{ Form::open(['url'=>'registration/FacultyMember']) }}
                        <div class="form-group">
                            <label for="FunctionalNumber">الرقم الوظيفي الخاص بالمشرف :</label>
                            <input type="text" id="FunctionalNumber" name="FunctionalNumber" required="required" class="form-control" placeholder="اكتب الرقم الوظيفي الخاص بك هنا">
                        </div>
                        <div class="form-group">
                            <label for="HoursOfService">عدد الساعات الفعلية  للتدريس في الاسبوع :</label>
                            <input type="text" id="HoursOfService" name="HoursOfService" required="required" class="form-control" placeholder="اكتب الرقم الوظيفي الخاص بك هنا">
                        </div>
                        <div class="form-group">
                            <label for="scientific_degrees_id">الدرجة العلمية الحاصل عليها :</label> 
                            {!! Form::select('scientific_degrees_id',['1'=>'دبلوم','2'=>'بكالوريس ','3'=>'ماجستير ','4'=>'دكتوراه '],null,array('required','id'=>'scientific_degrees_id','class'=>'form-control','placeholder'=>'--- أختر درجتك العلمية من هنا ---','title'=>'الدرجة العلمية الحاصل عليها')) !!}
                        </div>
                        <div class="form-group">
                            <label for="branches_id"> التخصص الجامعي :</label> 
                                {!! Form::select('programs_id',$ProName,null,array('required','id'=>'programs_id','class'=>'form-control','placeholder'=>'--- أختر تخصصك الجامعي من هنا ---','title'=>'التخصص الجامعي الحاصل عليها')) !!}
                        </div>
                        <button type="submit" class="btn btn-primary form-control"> تسجيل <i class="fa fa-pencil-square-o"></i></button>
                    {{ Form::close() }}
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection