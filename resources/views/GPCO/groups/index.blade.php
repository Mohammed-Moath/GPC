@extends('layouts.Master.GPCO') 

@section('title')
    أدارة المجموعات
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
                        <li  class="active">
                            <i class="fa fa-repeat"></i> أدارة المجموعات
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
                <div class="col-lg-6 col-md-6">
                    <h3> <i class="fa fa-bar-chart"></i> أحصائيات سريعة للمجموعات</h3>
                    <div class="list-group">
                        <a title="كافة المجموعات التي أنُشئت" href="{{ url('statistics-groups',1) }}" class="list-group-item list-group-item-info  group-q">
                            <span class="badge">{{count($All_Groups)}}</span>
                            <strong>كافة المجموعات التي أنُشئت</strong>
                        </a>
                        <a title="مجموعات الطلاب - المركز الرئيسي" href="{{ url('statistics-groups',2) }}" class="list-group-item group-q">
                            <span class="badge">{{$Branches_Boys}}</span>
                            <strong>الطلاب - المركز الرئيسي</strong>
                        </a>
                        <a title="مجموعات الطالبات - فرع الطالبات" href="{{ url('statistics-groups',3) }}" class="list-group-item group-q">
                            <span class="badge">{{$Branches_Grils}}</span>
                            <strong>الطالبات - فرع الطالبات</strong>
                        </a>
                    </div>
                    <hr>
                    <h3><i class="fa fa-gavel"></i> إجراءات  إقرار المشاريع واعتمادها</h3>
                    {{ Form::open(['url'=>'manage/groups']) }}
                        <div class="form-group {{ $errors->has('Procedures_Committee') ? ' has-error' : '' }}">
                            {!! Form::select('Procedures_Committee',$Procedures_Committee,null,array('required','id'=>'Procedures_Committee','class'=>'form-control','placeholder'=>'--- أختر أحد الاجراءات من هنا ---','title'=>'أجراءات اللجنة للمجموعات')) !!}
                            @if ($errors->has('Procedures_Committee'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Procedures_Committee') }}</strong>
                            </span>
                        @endif
                        </div>

                        <button type="submit" class="btn btn-primary form-control"> <i class="fa fa-pencil-square-o"></i> بدء الاجراء </button>
                    {{ Form::close() }}
                    <hr>      
                </div>
                <div class="col-lg-6 col-md-6 role-GPCO">

                    <div class="list-group">
                        <a title="المجموعات النهائية معتمد لها مشروع ومشرف" href="{{ url('statistics-groups',4) }}" class="list-group-item list-group-item-info  group-q">
                            <span class="badge">{{ $WorkGroups }}</span>
                            <strong> <i class="fa fa-thumbs-up"></i>المجموعات النهائية معتمد لها مشروع ومشرف </strong>
                        </a>
                    </div>
                    <hr>

                    <div class="list-group group-q">
                        <a title="مجموعات معتمد لها مشروع " href="{{ url('statistics-groups',5) }}" class="list-group-item list-group-item-success  group-q">
                            <span class="badge">{{$Approved_Groups}}</span>
                            <strong>مجموعات معتمد لها مشروع  </strong>
                        </a>
                        <a title="مجموعات لم يعتمد لها مشروع" href="{{ url('statistics-groups',6) }}" class="list-group-item list-group-item-danger  group-q">
                            <span class="badge">{{$Null_Approved}}</span>
                            <strong> مجموعات لم يعتمد لها مشروع</strong>
                        </a>
                        
                        
                     
                    </div>
        
                    <div class="list-group">
                        <a title="مجموعات تم توزيع مشرفين لها" href="{{ url('statistics-groups',7) }}" class="list-group-item list-group-item-success  group-q">
                            <span class="badge">{{$Approved_Supervisors}}</span>
                            <strong>مجموعات تم توزيع مشرفين لها</strong>
                        </a>
                        
                        <a title="مجموعات لم يوزع مشرفين لها" href="{{ url('statistics-groups',8) }}" class="list-group-item list-group-item-danger  group-q">
                            <span class="badge">{{$Null_Supervisor}}</span>
                            <strong>مجموعات لم يوزع مشرفين لها</strong>
                        </a>
                       
                    </div>
           
                  
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection