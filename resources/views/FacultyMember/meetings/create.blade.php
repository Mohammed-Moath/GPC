@extends('layouts.Master.FacultyMember') 

@section('title')
اللقاءات | فتح لقاء جديد
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
        <i class="fa fa-video-camera"></i>
         اللقاءات 
        </li>
        <li class="active">
           فتح لقاء جديد  
        </li>
        <li  class="pull-left">
            <a title="ذهاب للصفحة الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <div class="panel panel-{{ $coler }}">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong> فتح لقاء جديد مع مجموعة | {{ $TypeStudent }}</strong></h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>عنوان المشروع الخاص بالمجموعة رقم {{ isset($group->id) !=null ? $group->id : 'لاتوجد أي بيانات ليتم عرضها !' }}</label>
                <input title="عنوان مشرروع التخرج الخاص بالمجموعة" class="form-control" disabled="disabled" placeholder="{{ isset($group->proposals->ProjectProposalTitle) !=null ? $group->proposals->ProjectProposalTitle : 'لاتوجد أي بيانات ليتم عرضها !' }}">
            </div>
            <div class="form-group">
                <label>رئيس هذه المجموعة</label>
                <input title="رئيس هذه المجموعة" class="form-control" disabled="disabled" placeholder="{{ isset($group->project_students->users->Name) !=null ?  $group->project_students->users->Name : 'لاتوجد أي بيانات ليتم عرضها !' }}    ">
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"> تفاصيل اللقاء  {{ $NameOfMeetings }} </h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url'=>"FacultyMember/meetings/create/$group->id/$NumberOfMeetingsNow"]) !!}
                        <div class="form-group {{ $errors->has('TitleMeeting') ? ' has-error' : '' }}">
                            {!! Form::label('TitleMeeting','* موضوعات اللقاء :')!!}
                            {!! Form::textarea('TitleMeeting',null,array('required','id'=>'TitleMeeting','class'=>'form-control','placeholder'=>'ضع هنا موضوعات اللقاء.','title'=>'موضوعات اللقاء')) !!}
                            @if ($errors->has('TitleMeeting'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('TitleMeeting') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group {{ $errors->has('TaskName') ? ' has-error' : '' }}">
                            {!! Form::label('TaskName','* تكاليف اللقاء :')!!}
                            {!! Form::textarea('TaskName',null,array('required','id'=>'TaskName','class'=>'form-control','placeholder'=>'ضع هنا تكاليف اللقاء.','title'=>'تكاليف اللقاء')) !!}
                            @if ($errors->has('TaskName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('TaskName') }}</strong>
                                </span>
                            @endif   
                        </div>
                        <div class="form-group {{ $errors->has('StudentAN') ? ' has-error' : '' }}">
                            <h5><strong>الحضور</strong></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="success">
                                        <th>الاسم</th>
                                        <th>التخصص</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Team as $t)
                                        <tr>
                                            <td>
                                                {{ isset($t->users->Name) !=null ? $t->users->Name : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                            </td>
                                            <td>{{ isset($t->programs->ProgramName) !=null ? $t->programs->ProgramName : 'لاتوجد أي بيانات ليتم عرضها !'}}</td>
                                            <td> <input title="هل هذا الطالب حاضر؟" type="checkbox" name="StudentAN[]" value="{{$t->AcdameicNumber}}"> <strong>حاضر</strong> </td>
                                        </tr>
                                    @endforeach                            
                                </tbody>
                            </table>
                            @if ($errors->has('StudentAN'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('StudentAN') }}</strong>
                                </span>
                            @endif  
                        </div>
                        <hr>    
                        <div class="form-group col-lg-4">
                            <button type="submit" class="btn btn-primary form-control"> <strong>تقديم</strong> <i class="fa fa-arrow-circle-left"></i> </button>
                        </div>
                        <div class="form-group col-lg-2">
                            <button type="reset" class="btn btn-danger form-control"> <strong>ألغاء</strong> <i class="fa fa-times-circle"></i> </button>
                        </div>        
                    {!! Form::close() !!}  
                </div>
            </div>
        </div>
    </div>
   
   
  
@endsection           
