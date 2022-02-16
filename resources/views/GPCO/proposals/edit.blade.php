@extends('layouts.Master.GPCO') 

@section('title')
  تعديل المقترح رقم : {{ isset($Proposal->id) !=null ? $Proposal->id : 'لاتوجد أي بيانات ليتم عرضها !'}}
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
                             <a title="أدارة المقترحات" href="{{ url('Proposal')}}"><i class="fa fa-repeat"></i> أدارة المقترحات </a>
                        </li>
                        <li>
                            <i class="fa fa-edit"></i> تعديل المقترح رقم : {{ isset($Proposal->id) !=null ? $Proposal->id : 'لاتوجد أي بيانات ليتم عرضها !'}}
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                    <div class="col-md-10 col-xs-12  pagetitle"><i class="fa fa-edit"></i> تعديل مقترح مشروع </div>
                </div>
            </div> 
            <!-- /.row -->
           
            <div class="row">  
                <div class="col-lg-12 col-xs-12 Proposal">
                    {!! Form::model($Proposal,array('method'=>'PATCH','action'=>['ProposalController@update',$Proposal->id],'files'=>'fales')) !!}
                        <div class="form-group col-md-6">
                            <label for="AcademicYear"> <i class="fa fa-caret-left"></i> العام الجامعي :</label>
                            {!! Form::select('AcademicYear',AcademicYear(),null,array('required','id'=>'AcademicYear','class'=>'form-control','placeholder'=>'--- أختر العام الجامعي من هنا ---','title'=>'حدد العام الجامعي الذي ترغب في أن يكون فيه هذا المقترح.')) !!}
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="Semester"> الفصل الدراسي :</label>
                            {!! Form::select('Semester',['الأول'=>'الفصل الدراسي الأول .','الثاني'=>'الفصل الدراسي الثاني .'],null,array('required','id'=>'Semester','class'=>'form-control','placeholder'=>'--- أختر الفصل الدراسي من هنا ---','title'=>'حدد الفصل الدراسي الذي ترغب في أن يكون فيه هذا المقترح.')) !!}
                        </div> 
                        <div class="form-group col-md-12 {{ $errors->has('ProjectProposalTitle') ? ' has-error' : '' }} ">
                            <label for="ProjectProposalTitle"> <i class="fa fa-caret-left"></i> عنوان المشروع المقترح :</label>
                            {!! Form::text('ProjectProposalTitle',null,['required','maxlength'=>'150','id'=>'ProjectProposalTitle','class'=>'form-control','placeholder'=>'ضع هنا عنوان المشروع المقترح ويجب ان لا يتجاوز عدد الحروف 150 حرفاً !!','title'=>'عنوان المشروع المقترح','value'=>"{{Request::old('ProjectProposalTitle')}}"]) !!}
                            @if ($errors->has('ProjectProposalTitle'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ProjectProposalTitle') }}</strong>
                                </span>
                            @endif   
                        </div> 
                        <div class="form-group col-md-12 {{ $errors->has('descrdiption') ? ' has-error' : '' }} ">
                            <label for="descrdiption"> <i class="fa fa-caret-left"></i> وصف المقترح :</label>
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
                        <div class="form-group col-md-12 ">
                            <label for="Outputs"> <i class="fa fa-caret-left"></i> مخرجات المشروع :</label>
                            {!! Form::textarea('Outputs',null,['required','maxlength'=>'500','id'=>'Outputs','class'=>'form-control','placeholder'=>'ضع هنا وصف مختصر لمخرجات المشروع بحيث لا تتجاوز عدد الحروف 500 حرفاً.','title'=>'وصف مخرجات المشروع']) !!}
                        </div>
                        <div class="form-group col-md-12 ">
                            <label for="ImportanceProposal"> <i class="fa fa-caret-left"></i> أهمية المشروع :</label>
                            {!! Form::text('ImportanceProposal',null,['required','maxlength'=>'300','id'=>'ImportanceProposal','class'=>'form-control','placeholder'=>' وضح هنا اهمية هذا المشروع ومن يخدم ؟ شرط أن لا يتجاوز عدد الحروف 300 حرفاً !!.','title'=>'ما أهمية هذا المقترح ؟']) !!}
                        </div> 
                        <div class="form-group col-md-12 ">
                            <label for="Tools"> <i class="fa fa-caret-left"></i> الادوات المستخدمة في المشروع :</label>
                            {!! Form::text('Tools',null,['required','maxlength'=>'300','id'=>'Tools','class'=>'form-control','placeholder'=>'أذكر هنا الأدوات المستخدمة والبرمجيات التي سوف تساعد على أنجاز هذه المقترح. شرط أن لا يتجاوز عدد الحروف 300 حرفاً !!.','title'=>'ماهي الأدوات والبرمجيات المتوقع استخدامها ؟']) !!}
                        </div>
                        <div class="form-group col-md-12">
                            <label for="Program"> <i class="fa fa-caret-left"></i> حدد التخصصات التي تناسب هذا المشروع :</label>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="ProgramChoose">
                                @foreach($Program as $p)
                                    <div class="form-group col-md-6">
                                        <ul>
                                            <li>
                                               <input 
                                                    @if(in_array($p->id,$ProgramID))
                                                        checked
                                                    @endif
                                                    title="هل تريد اختيار هذا التخصص  : {{$p->ProgramName}}؟" 
                                                    type="checkbox"
                                                    name="Program[]"
                                                    value="{{$p->id}}"
                                               > {{$p->ProgramName}}
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>    
                        </div>           
                        <div class="form-group col-md-12 ">
                            <label class="input-group" for="NumberOfStudents"> <i class="fa fa-caret-left"></i> عدد الطلاب المناسب:</label>
                            {!! Form::number('NumberOfStudents',null,['id'=>'NumberOfStudents','class'=>'form-control col-md-3','title'=>'ماعدد الطلاب المناسب لهذا المقترح ؟']) !!}
                        </div>
                        <!-- Submit butten -->
                        <div class="form-group col-md-12 ">
                            <label class="input-group" for="Supervisor"> <i class="fa fa-caret-left"></i> المشرفين المتوقع اشرافهم على هذا المقترح :</label>
                            <select title="المشرفين المتوقع اشرافهم على هذا المقترح" id="Supervisor" class="form-control js-example-basic-multiple" name="Supervisor[]" multiple="multiple">
                                @foreach(Supervisor() as $S)
                                    <option 
                                        @if(in_array($S->FunctionalNumber,$SupervisorID))
                                            selected 
                                        @endif
                                        @if($Proposal->users_id == $S->users_id)
                                            @if($Proposal->PropertyRight == 3)
                                                selected 
                                            @endif
                                        @endif   
                                            value="{{$S->FunctionalNumber}}"
                                        >
                                        {{$S->users->Name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <button type="submit" class="btn btn-primary form-control"> <strong>تعديل </strong> <i class="fa fa-edit"></i> </button>
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