@extends('layouts.Master.Student') 

@section('title')
    أنشاء مجموعة عمل لمشروع التخرج
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
             أنشاء مجموعة عمل
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h3 class="page-header">
      <strong>أنشاء مجموعة العمل</strong>
    </h3>
    <div class="alert alert-danger text-center" role="alert"><h4><i class="fa fa-exclamation-triangle"></i> شروط انشاء مجموعة العمل</h4>
        1- مشارك رمز الدخول مع الطلاب الذي ترغب في الانضمام معك في نفس المجموعة
        </br>
        2- أقل عدد طلاب في المجموعة هو :  {{Min_NumberofStudentinGroups()}}
        </br>
        3- أكثر عدد طلاب في المجموعة هو : {{ Max_NumberofStudentinGroups()}}
    </div>
    <hr>
    <div class="create-group">
        {!! Form::open(['url'=>['student/create/group']]) !!}  
            <div class="form-group col-md-12">
                <label for="Claendars"> <i class="fa fa-caret-left"></i> التقويم :</label>
                {!! Form::text('Claendars',null,array('readonly','disabled','id'=>'Claendars','class'=>'form-control','placeholder'=>  Calendar_Current()->Name,'title'=>'التقويم')) !!}
            </div> <!-- div Input Project ProposaAcademic Year -->
            <div class="form-group col-md-6">
                <label for="AcademicYear"> <i class="fa fa-caret-left"></i> المركز الدراسي :</label>
                {!! Form::text('Branche',null,array('value'=>$Branch->branches->BrancheNameAR,'readonly','disabled','required','id'=>'Branche','class'=>'form-control','placeholder'=>$Branch->branches->BrancheNameAR,'title'=>'المركز الدراسي')) !!}
            </div> 
            <div class="form-group col-md-6">
                <label for="GroupLader"> <i class="fa fa-caret-left"></i> رئيس المجموعة  :</label>
                {!! Form::text('GroupLader',null,array('value'=>Auth::user()->Name,'readonly','disabled','required','id'=>'GroupLader','class'=>'form-control','placeholder'=> Auth::user()->Name ,'title'=>'رئيس المجموعة')) !!}
            </div>   
            <div class="form-group col-md-6 {{ $errors->has('GroupCode') ? ' has-error' : '' }}">
                <label for="GroupCode">* رمز الدخول الخاص بهذه المجموعة :</label>
                <input type="text"  required="required" value="{{Request::old('GroupCode')}}" title="  ضع رمز لمجموعتك الخاصة بأنجاز مشروع التخرج ،ويجب أن يكون الرمز سهل الحفظ من أجل مشاركته مع زملائك الذي ترغب بأن ينظموا معك في مجموعة العمل هذا ، يمكنك أن تكون الرمز من حروف وأرقام.." id="GroupCode" name="GroupCode" class="form-control" placeholder="ضع هنا رمز يسهل حفظه">
                @if ($errors->has('GroupCode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('GroupCode') }}</strong>
                    </span>
                @endif  
            </div>
            <div class="form-group col-md-6" style="color: #ff2b2b;">
               <p>
                * يرجىْ الأنتباه الى أن هذا الرمز هو رمز الدخول الخاص بهذا المجموعة ،  <strong>يجب أن تحفظ الرمز الذي أدخلته من أجل مشاركته مع زملائك الذي ترغب بأن ينظموا معك الى هذه المجموعة</strong> .
               </P>
            </div>
            <div class="clearfix"></div>
            <div class="form-group  col-md-6 ">
                {!! Form::submit('أنشئ هذه المجموعة',['class'=>'btn btn-success btn-block','title'=>'أنشء هذه المجموعة'])!!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::reset('ألغاء',['class'=>'btn btn-primary  ','title'=>' ألغاء '])!!}
            </div> 
        {!! Form::close() !!}
    </div>
@endsection           
