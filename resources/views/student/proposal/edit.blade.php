@extends('layouts.Master.Student') 

@section('title')
    تعديل مقترح المشروع 
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <strong>
                <i class="fa fa-edit"></i>
               تعديل مقترح مشروع رقم : {{ isset($Proposal->id) !=null ? $Proposal->id : 'لا توجد بيانات ليتم عرضها'}}
            </strong>
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <hr>
    <div class="Outputs">
        {!! Form::model($Proposal,array('method'=>'PATCH','url'=>['student/proposals',$Proposal->id,'update'],'files'=>'fales')) !!}
            <div class="form-group col-md-6">
                <label for="AcademicYear"> <i class="fa fa-caret-left"></i> العام الجامعي :</label>
                {!! Form::text('AcademicYear',null,array('value'=>"AcademicYear()",'readonly','disabled','id'=>'AcdameicNumber','class'=>'form-control','title'=>'العام الجامعي')) !!}
            </div>
            <div class="form-group col-md-6">
                <label for="Semester"> الفصل الدراسي :</label>
                {!! Form::text('Semester',null,array('value'=>"Semester()",'readonly','disabled','id'=>'Semester','class'=>'form-control','title'=>' الفصل الدراسي')) !!}
            </div>
            <div class="form-group col-md-12 {{ $errors->has('ProjectProposalTitle') ? ' has-error' : '' }} ">
                <label for="ProjectProposalTitle"> * عنوان المشروع المقترح</label>
                {!! Form::text('ProjectProposalTitle',null,['required','maxlength'=>'150','id'=>'ProjectProposalTitle','class'=>'form-control','placeholder'=>'يجب أضافة عنوان المقترح بحيث لايزيد عدد الحروف عن 150 حرف ولا يقل عن 10 حروف.','title'=>'عنوان المشروع','value'=>"{{Request::old('ProjectProposalTitle')}}"]) !!}
                @if ($errors->has('ProjectProposalTitle'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ProjectProposalTitle') }}</strong>
                    </span>
                @endif   
            </div>
            <div class="form-group col-md-12 {{ $errors->has('descrdiption') ? ' has-error' : '' }} ">
                <label for="descrdiption"> * وصف المشروع المقترح :</label>
                {!! Form::textarea('descrdiption',null,['required','id'=>'descrdiption','class'=>'form-control','placeholder'=>'يجب أضافة وصف للمشروع المقترح بحيث لا يقل عدد الحروف عن 100 حرف.','title'=>'وصف المشروع المقترح','value'=>"{{Request::old('descrdiption')}}"]) !!}
                @if ($errors->has('descrdiption'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descrdiption') }}</strong>
                    </span>
                @endif   
            </div> 
            <div class="form-group col-md-12 {{ $errors->has('scope') ? ' has-error' : '' }} ">
                <label for="scope"> * حدود المشروع Scope :</label>
                {!! Form::textarea('scope',null,['required','id'=>'scope','class'=>'form-control','placeholder'=>'يجب أضافة وصف مختصر لمقترح المشروع الذي ترغب بتقديمه بحيث يتم توضيح فكرتة بشكل دقيق.','title'=>'وصف حدود مشروع التخرج','value'=>"{{Request::old('scope')}}"]) !!}
                @if ($errors->has('scope'))
                    <span class="help-block">
                        <strong>{{ $errors->first('scope') }}</strong>
                    </span>
                @endif   
            </div>
            <div class="form-group col-md-12 {{ $errors->has('Outputs') ? ' has-error' : '' }}">
                <label for="Outputs"> * مخرجات المشروع :</label>
                {!! Form::textarea('Outputs',null,['required','maxlength'=>'500','id'=>'Outputs','class'=>'form-control','placeholder'=>'ضع هنا وصف مختصر لمخرجات المشروع بحيث لا تتجاوز عدد الحروف 500 حرفاً.','title'=>'وصف مخرجات المشروع']) !!}
                @if ($errors->has('Outputs'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Outputs') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-12 {{ $errors->has('ImportanceProposal') ? ' has-error' : '' }}">
                <label for="ImportanceProposal"> * أهمية المشروع :</label>
                {!! Form::textarea('ImportanceProposal',null,['required','maxlength'=>'300','id'=>'ImportanceProposal','class'=>'form-control','placeholder'=>' وضح هنا اهمية هذا المشروع ومن يخدم ؟ ولماذا يجب أن توافق اللجنة علية !. شرط أن لا يتجاوز عدد الحروف 300 حرفاً !!.','title'=>'ما أهمية هذا المقترح ؟']) !!}
                @if ($errors->has('ImportanceProposal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ImportanceProposal') }}</strong>
                    </span>
                @endif
            </div> 
            <div class="form-group col-md-12 {{ $errors->has('Tools') ? ' has-error' : '' }} ">
                <label for="Tools"> * الادوات المستخدمة في المشروع :</label>
                {!! Form::textarea('Tools',null,['required','maxlength'=>'300','id'=>'Tools','class'=>'form-control','placeholder'=>'أذكر هنا الأدوات المستخدمة والبرمجيات التي سوف تساعد على أنجاز هذه المقترح. شرط أن لا يتجاوز عدد الحروف 300 حرفاً !!.','title'=>'ماهي الأدوات والبرمجيات المتوقع استخدامها ؟']) !!}
                @if ($errors->has('Tools'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Tools') }}</strong>
                    </span>
                @endif
            </div> 
            <div class="form-group col-md-12 {{ $errors->has('Program') ? ' has-error' : '' }}">
                <label for="Program"> <i class="fa fa-caret-left"></i> حدد التخصصات التي تناسب هذا المقترح من وجهة نظرك :</label>
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
            <div class="form-group col-md-12 {{ $errors->has('NumberOfStudents') ? ' has-error' : '' }} ">
                <label class="input-group" for="NumberOfStudents">* عدد الطلاب المناسب:</label>
                {!! Form::number('NumberOfStudents',null,['id'=>'NumberOfStudents','class'=>'form-control col-md-3','title'=>'ماعدد الطلاب المناسب لهذا المقترح ؟']) !!}
                @if ($errors->has('NumberOfStudents'))
                    <span class="help-block">
                        <strong>{{ $errors->first('NumberOfStudents') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-12 {{ $errors->has('PropertyRight') ? ' has-error' : '' }} ">
                <label for="PropertyRight"> <i class="fa fa-caret-left"></i> هل ترغب في أن يبقي هذا المقترح المقدم خاص بك في حالة قبوله من قبل اللجنة أم يتم مشاركته للجميع ؟</label>
                {!! Form::select('PropertyRight',['1'=>'نعم ، أرغب في ان يبقي هذا المقترح خاص بي .','2'=>'لا ، يمكنكم مشاركته هذا المقترح لجميع الطلاب لكي يختاروه .'],null,array('required','id'=>'PropertyRight','class'=>'form-control','placeholder'=>'--- أختر أجابتك من هنا ---','title'=>'تحديد حقوق الملكية الفكرية لهذا المقترح')) !!}
                @if ($errors->has('PropertyRight'))
                    <span class="help-block">
                        <strong>{{ $errors->first('PropertyRight') }}</strong>
                    </span>
                @endif  
            </div> 
            <div class="form-group col-lg-4">
                <button title="تقديم" type="submit" class="btn btn-warning form-control">  <i class="fa fa-edit"></i> <strong>تعديل</strong> </button>
            </div>
                <!-- div Reset butten -->
            <div class="form-group col-lg-2">
                <button title="ألغاء" type="reset" class="btn btn-danger form-control"><i class="fa fa-times-circle"></i>   <strong>ألغاء</strong> </button>
            </div>
        {!! Form::close() !!}
    </div>

@endsection            

 