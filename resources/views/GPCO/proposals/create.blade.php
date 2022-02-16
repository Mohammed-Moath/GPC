@extends('layouts.Master.GPCO') 

@section('title')
 أضافة مقترح مشروع 
@endsection 

@section('header')
    <!-- select2 -->
    {!! Html::style('css/select2.min.css') !!}
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
                        <li class="active">
                            <i class="fa fa-plus-circle"></i> أضافة مقترح مشروع
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                        <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                    <div class="col-md-10 col-xs-12  pagetitle"><i class="fa fa-plus-circle"></i> أضافة مقترح مشروع </div>
                </div>
            </div> 
            <!-- /.row -->
            
            <div class="row"> 
                <div class="col-lg-12 col-xs-12 Proposal">
                    {!! Form::open(["url"=>"Proposal"]) !!} 
                        <div class="form-group col-md-6 {{ $errors->has('AcademicYear') ? ' has-error' : '' }}">
                            {!! Form::label('AcademicYear', '* الرقم الإكاديمي  :')!!}
                            {!! Form::select('AcademicYear',AcademicYear(),null,array('required','id'=>'AcademicYear','class'=>'form-control','placeholder'=>'--- أختر العام الجامعي ---','title'=>'العام الجامعي')) !!}
                            @if ($errors->has('AcademicYear'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('AcademicYear') }}</strong>
                                </span>
                            @endif   
                        </div> 
                        <div class="form-group col-md-6 {{ $errors->has('Semester') ? ' has-error' : '' }} ">
                            {!! Form::label('Semester', '* الفصل الدراسي  :')!!}
                            {!! Form::select('Semester',Semester(),null,array('required','id'=>'Semester','class'=>'form-control','placeholder'=>'--- أختر الفصل الدراسي  ---','title'=>'الفصل الدراسي')) !!}
                            @if ($errors->has('Semester'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Semester') }}</strong>
                                </span>
                            @endif 
                        </div> 
                        <div class="form-group col-md-12 {{ $errors->has('ProjectProposalTitle') ? ' has-error' : '' }} ">
                            {!! Form::label('ProjectProposalTitle', '* عنوان المشروع المقترح  :')!!}
                            {!! Form::text('ProjectProposalTitle',null,['required','maxlength'=>'150','id'=>'ProjectProposalTitle','class'=>'form-control','placeholder'=>'ضع هنا عنوان المشروع المقترح ويجب ان لا يتجاوز عدد الحروف 150 حرفاً !!','title'=>'عنوان المشروع المقترح','value'=>"{{Request::old('ProjectProposalTitle')}}"]) !!}
                            @if ($errors->has('ProjectProposalTitle'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ProjectProposalTitle') }}</strong>
                                </span>
                            @endif   
                        </div> 
                        <div class="form-group col-md-12 {{ $errors->has('descrdiption') ? ' has-error' : '' }} ">
                            {!! Form::label('descrdiption', '* وصف مقترح المشروع التخرج :')!!}
                            {!! Form::textarea('descrdiption',null,['required','id'=>'descrdiption','class'=>'form-control','placeholder'=>'ضع هنا وصف مختصر لمقترح المشروع الذي ترغب بتقديمه بحيث يتم توضيح فكرتة بشكل دقيق.','title'=>'وصف مقترح مشروع التخرج','value'=>"{{Request::old('descrdiption')}}"]) !!}
                            @if ($errors->has('descrdiption'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('descrdiption') }}</strong>
                                </span>
                            @endif   
                        </div> 
                        <div class="form-group col-md-12 {{ $errors->has('scope') ? ' has-error' : '' }} ">
                            {!! Form::label('scope', '* ماهو حدود هذا المشروع Scope :')!!}
                            {!! Form::textarea('scope',null,['required','id'=>'scope','class'=>'form-control','placeholder'=>'ضع هنا وصف لحدود المشروع الذي ترغب بتقديمه بحيث يتم توضيح فكرتة بشكل دقيق.','title'=>'حدود المشروع','value'=>"{{Request::old('scope')}}"]) !!}
                            @if ($errors->has('scope'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scope') }}</strong>
                                </span>
                            @endif   
                        </div> 
                        <div class="form-group col-md-12 {{ $errors->has('Outputs') ? ' has-error' : '' }} ">
                            {!! Form::label('Outputs', '* مخرجات المشروع :')!!}
                            {!! Form::textarea('Outputs',null,['required','maxlength'=>'500','id'=>'Outputs','class'=>'form-control','placeholder'=>'ضع هنا وصف مختصر لمخرجات المشروع بحيث لا تتجاوز عدد الحروف 500 حرفاً.','title'=>'مخرجات المشروع']) !!}
                            @if ($errors->has('Outputs'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Outputs') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('ImportanceProposal') ? ' has-error' : '' }} ">
                            {!! Form::label('ImportanceProposal', '* أهمية المشروع :')!!}
                            {!! Form::textarea('ImportanceProposal',null,['required','maxlength'=>'300','id'=>'ImportanceProposal','class'=>'form-control','placeholder'=>' وضح هنا اهمية هذا المشروع ومن يخدم ؟ شرط أن لا يتجاوز عدد الحروف 300 حرفاً !!.','title'=>'ما أهمية هذا المقترح ؟']) !!}
                            @if ($errors->has('ImportanceProposal'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ImportanceProposal') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="form-group col-md-12 {{ $errors->has('Tools') ? ' has-error' : '' }} ">
                            {!! Form::label('Tools', '* الادوات المستخدمة في المشروع :')!!}
                            {!! Form::textarea('Tools',null,['required','maxlength'=>'300','id'=>'Tools','class'=>'form-control','placeholder'=>'أذكر هنا الأدوات المستخدمة والبرمجيات التي سوف تساعد على أنجاز هذه المقترح. شرط أن لا يتجاوز عدد الحروف 300 حرفاً !!.','title'=>'ماهي الأدوات والبرمجيات المتوقع استخدامها ؟']) !!}
                            @if ($errors->has('Tools'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Tools') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('Program') ? ' has-error' : '' }}">
                            <label for="Program"> <i class="fa fa-caret-left"></i> حدد التخصصات التي تناسب هذا المشروع :</label>
                            @if ($errors->has('Program'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Program') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group col-md-12 ">
                            <div class="ProgramChoose">
                                @foreach($Program as $p)
                                    <div class="form-group col-md-6">
                                        <ul>
                                            <li><input title="هل تريد اختيار هذا التخصص  : {{$p->ProgramName}}؟" type="checkbox" name="Program[]" value="{{$p->id}}"> {{$p->ProgramName}}</li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>   
                           
                        </div>           
                        <div class="form-group col-md-12 {{ $errors->has('NumberOfStudents') ? ' has-error' : '' }} ">
                            <label class="input-group" for="NumberOfStudents"> <i class="fa fa-caret-left"></i> عدد الطلاب المناسب:</label>
                            {!! Form::number('NumberOfStudents',null,['id'=>'NumberOfStudents','class'=>'form-control col-md-3','title'=>'ماعدد الطلاب المناسب لهذا المقترح ؟']) !!}
                            @if ($errors->has('NumberOfStudents'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('NumberOfStudents') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('Supervisor') ? ' has-error' : '' }} ">
                            <label class="input-group" for="Supervisor"> <i class="fa fa-caret-left"></i> المشرفين المتوقع اشرافهم على هذا المقترح :</label>
                            <select title="المشرفين المتوقع اشرافهم على هذا المقترح" id="Supervisor" class="form-control js-example-basic-multiple" name="Supervisor[]" multiple="multiple">
                                @foreach(Supervisor() as $S)
                                    <option value="{{ isset($S->FunctionalNumber) !=null ? $S->FunctionalNumber :'لايوجد أي بيانات لعرضها!.' }}">{{ isset($S->users->Name) !=null ? $S->users->Name : 'لاتوجد أي بيانات لعرضها!.'}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('Supervisor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Supervisor') }}</strong>
                                </span>
                            @endif 
                        </div> 
                        <!-- Submit butten -->
                        <div class="form-group col-lg-4">
                            <button type="submit" class="btn btn-primary form-control"> <strong>أضافة </strong> <i class="fa fa-plus-circle"></i> </button>
                        </div>
                        <!-- div Reset butten -->
                        <div class="form-group col-lg-2">
                            <button type="reset" class="btn btn-danger form-control"> <strong>ألغاء</strong> <i class="fa fa-times-circle"></i> </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

@section('footer')
   
    <!-- select2 -->
    {!! Html::script('js/select2.min.js') !!}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                dir: "rtl"
            });
           
            
        });
    </script>
@Stop