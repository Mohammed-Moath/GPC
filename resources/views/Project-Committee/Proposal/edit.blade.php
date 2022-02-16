@extends('layouts.Master.Project-Committee') 

@section('title')
  تعديل مقترح
@endsection


@section('header')
    {!! Html::style('Templates/Shared-files/css/bootstrap-datetimepicker.min.css') !!}
    <!-- select2 -->
    {!! Html::style('css/select2.min.css') !!}
@endsection 



@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a  title="المقترحات" href="{{ url('project-committee/proposal') }}"> <i class="fa fa-file-powerpoint-o"></i> المقترحات</a></li>
                    <li class="breadcrumb-item active"> تعديل مقترح</li>
                </ol>
            </nav>
        </div>

        <div class="col-4">
            <div class="text-left">
                <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
                <a title="الرئيسية" href="{{ url('project-committee/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col">
            <div class="card ">
                {!! Form::model($Proposal,array('method'=>'PATCH','url'=>['project/committee/proposal',$Proposal->id,'update'],'files'=>'fales')) !!}
                    <div class="card-header text-center ">
                        <span class="badge badge-pill badge-success"> تعديل مقترح</span>
                        <div class="btn-group btn-group-sm float-left" role="group">
                            <button title="تعديل" type="submit" class="btn btn-outline-success"> <i class="fa fa-edit"></i> تعديل</button>
                            <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle-o"></i> الغاء</button>   
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-sm-5 {{ $errors->has('calendar_id') ? ' has-error' : '' }}">
                                    <label for="calendar_id"><span style="color:red;">*</span><strong> التقويم :</strong></label>
                                    {{ Form::select('calendar_id',Calendars(), null, ['required','class'=>"select2",'placeholder' => '--- أختر التقويم ---','title'=>'التقويم']) }}
                                    @if ($errors->has('Semester'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('calendar_id') }}</strong>
                                        </span>
                                    @endif   
                                </div>
                                <div class="col-sm-5 form-group {{ $errors->has('ProjectProposalTitle') ? ' has-error' : '' }}">
                                    <label for="ProjectProposalTitle"> <span style="color:red;">*</span><strong> عنوان المشروع</strong></label>
                                    {!! Form::text('ProjectProposalTitle',null,['required','maxlength'=>'150','id'=>'ProjectProposalTitle','class'=>'form-control','placeholder'=>'عنوان المشروع المقترح لا يتجاوز 150 حرف.','title'=>'عنوان المشروع المقترح','value'=>"{{Request::old('ProjectProposalTitle')}}"]) !!}
                                    @if ($errors->has('ProjectProposalTitle'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('ProjectProposalTitle') }}</strong>
                                        </span>
                                    @endif   
                                </div>
                                <div class="form-group col-sm-2 {{ $errors->has('NumberOfStudents') ? ' has-error' : '' }} ">
                                    <label for="NumberOfStudents"> <span style="color:red;">*</span><strong> عدد الطلاب :</strong></label>
                                    {{ Form::select('NumberOfStudents', Number(), null, ['id'=>'NumberOfStudents','class'=>" form-control form-control-sm custom-select",'required','title'=>'ماعدد الطلاب المناسب لهذا المقترح ؟']) }}
                                    @if ($errors->has('NumberOfStudents'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('NumberOfStudents') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                                <div class="form-group col-sm-12 {{ $errors->has('descrdiption') ? ' has-error' : '' }} ">
                                    <label for="descrdiption"> <span style="color:red;">*</span><strong> الوصف</strong></label>
                                    {!! Form::textarea('descrdiption',null,['required','id'=>'descrdiption','class'=>'form-control text-create-popposal','placeholder'=>'وصف مختصر للمشروع المقترح بحيث تحدد فكرته بوضوح.','title'=>'وصف المشروع المقترح','value'=>"{{Request::old('descrdiption')}}"]) !!}
                                    @if ($errors->has('descrdiption'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('descrdiption') }}</strong>
                                        </span>
                                    @endif   
                                </div> 
                                <div class="form-group col-sm-6 {{ $errors->has('scope') ? ' has-error' : '' }} ">
                                    <label for="descrdiption"> <span style="color:red;">*</span><strong> الحدود Scope :</strong></label>
                                    {!! Form::textarea('scope',null,['required','id'=>'scope','class'=>'form-control text-create-popposal','placeholder'=>'وصف مختصر لحدود المشروع بحيث تحدد فكرته بوضوح.','title'=>'حدود المشروع','value'=>"{{Request::old('scope')}}"]) !!}
                                    @if ($errors->has('scope'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('scope') }}</strong>
                                        </span>
                                    @endif   
                                </div> 
                                <div class="form-group col-sm-6 {{ $errors->has('Outputs') ? ' has-error' : '' }} ">
                                    <label for="descrdiption"> <span style="color:red;">*</span><strong> المخرجات :</strong></label>
                                    {!! Form::textarea('Outputs',null,['required','id'=>'Outputs','class'=>'form-control text-create-popposal','placeholder'=>'وصف مختصر لمخرجات المشروع بحيث تحدد فكرته بوضوح.','title'=>'مخرجات المشروع']) !!}
                                    @if ($errors->has('Outputs'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('Outputs') }}</strong>
                                        </span>
                                    @endif   
                                </div>
                                <div class="form-group col-sm-6 {{ $errors->has('ImportanceProposal') ? ' has-error' : '' }} ">
                                    <label for="ImportanceProposal"> <span style="color:red;">*</span><strong> الاهمية :</strong></label>
                                    {!! Form::textarea('ImportanceProposal',null,['required','id'=>'ImportanceProposal','class'=>'form-control text-create-popposal','placeholder'=>'وصف مختصر لاهمية المشروع المقترح بحيث تحدد فكرته بوضوح.','title'=>'ما أهمية هذا المقترح ؟']) !!}
                                    @if ($errors->has('ImportanceProposal'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('ImportanceProposal') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                <div class="form-group col-md-6 {{ $errors->has('Tools') ? ' has-error' : '' }} ">
                                    <label for="ImportanceProposal"> <span style="color:red;">*</span><strong> الادوات :</strong></label>
                                    {!! Form::textarea('Tools',null,['required','id'=>'Tools','class'=>'form-control text-create-popposal','placeholder'=>'اذكر الادوات والبرمجيات المتوقع استخدامها في المشروع','title'=>'ماهي الأدوات والبرمجيات المتوقع استخدامها ؟']) !!}
                                    @if ($errors->has('Tools'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('Tools') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('Program') ? ' has-error' : '' }} ">
                                    <label for="Program"> <span style="color:red;">*</span><strong> التخصصات التي يناسبها هذا المشروع :</strong></label>
                                    @if ($errors->has('Program'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('Program') }}</strong>
                                        </span>
                                    @endif 
                                    <div class="table-responsive ProgramChoose">
                                        <table class="table table-sm table-hover  table-bordered">
                                            <thead>
                                                <tr class="table-dark">
                                                <th scope="col"></th>
                                                <th scope="col">القسم</th>
                                                <th scope="col">نوع البرنامج</th>
                                                <th scope="col">التخصص</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(Program() as $p)
                                                    <tr>
                                                    
                                                        <th scope="row"> 
                                                            <label class="custom-control custom-checkbox ">
                                                                <input class="custom-control-input" title="هل تريد اختيار هذا التخصص  : {{$p->ProgramName}}؟" type="checkbox" name="Program[]" value="{{$p->id}}" {{ in_array($p->id,$ProgramID) ? 'checked' : ''}}>
                                                                <span class="custom-control-indicator"></span>
                                                            </label>
                                                        </th>
                                                    
                                                        <td>{{ isset($p->scientific_departments->DepartmentName) !=null ? $p->scientific_departments->DepartmentName : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                        <td>{{ isset($p->program_types->name) !=null ? $p->program_types->name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                        <td>{{ isset($p->ProgramName) !=null ? $p->ProgramName : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>      
                                <div class="form-group col-sm-6 {{ $errors->has('Supervisor') ? ' has-error' : '' }} ">
                                    <label for="Program"> <span style="color:red;">*</span><strong> أعضاء هيئة التدريس المتوقع أشرافهم على المشروع :</strong></label>
                                    <select title="المشرفين المتوقع اشرافهم على هذا المقترح" id="Supervisor" class=" select2 js-example-basic-multiple" name="Supervisor[]" multiple="multiple">
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
                                    @if ($errors->has('Supervisor'))
                                        <span class="masseg_error">
                                            <strong>{{ $errors->first('Supervisor') }}</strong>
                                        </span>
                                    @endif 
                                </div> 
                            </div>
                        </div> 

                    </div>
                {{ Form::close() }}          
            </div>
        </div>
    </div>
@Stop

@section('footer')
    <!-- select2 -->
    {!! Html::script('js/select2.min.js') !!}
    <script>
        $('.select2').select2({
            dir: "rtl"
        });
    </script>
     <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                dir: "rtl"
            });
           
            
        });
    </script>
@Stop