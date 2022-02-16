@extends('layouts.Master.GPCO') 

@section('title')
  توزيع المشرف للمجموعة رقم : {{ isset($Groups->id) !=null ? $Groups->id : ''}}
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
                        <i class="fa fa-group"></i> المجموعات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-group"></i> المجموعات
                        </li>
                        <li>
                            <a title="أدارة المجموعات" href=" {{ url('manage/groups')}}"><i class="fa fa-repeat"></i> أدارة المجموعات </a>
                        </li>
                        <li>
                            <a title="توزيع المشرفين على المجموعات" href=" {{ url('supervisor-distribution')}}"><i class="fa fa-share-alt"></i>   توزيع المشرفين على المجموعات  </a>      
                        </li>
                        <li class="active">
                            توزيع مشرف للمجموعة رقم : {{ isset($Groups->id) !=null ? $Groups->id : ''}}
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
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-exclamation-circle"></i> <strong>معلومات عن المجموعة رقم : {{ $Groups->id }} </strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>المركز الدراسي: <span class="label label-default">{{ isset($Groups->branches->BrancheNameAR) !=null ? $Groups->branches->BrancheNameAR : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                            <th scope="row">عنوان مشروع المجموعة : <span class="label label-default">{{ isset($Groups->proposals->ProjectProposalTitle) !=null ? $Groups->proposals->ProjectProposalTitle : 'لم يتم أعتماد المشروع بعد !'}}</span></th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">العام الجامعي: <span class="label label-default">{{ isset($Groups->AcademicYear) !=null ? $Groups->AcademicYear : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                            <th>اعضاء الفريق في المجموعة</th>
                                        </tr>
                                        <tr>
                                            <th scope="row">الفصل الدراسي: <span class="label label-default">{{ isset($Groups->Semester) !=null ? $Groups->Semester : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                            <td rowspan="4">
                                                @if(count($Team)==0)
                                                    <span class="label label-danger">لايوجد اي عضو فريق في هذه المجموعة !!</span>
                                                @endif
                                                @if(count($Team)!=0)
                                                    @foreach($Team as $t)
                                                     - {{ isset($t->users->Name) !=null ? $t->users->Name : 'لايوجد اي بيانات ليتم عرضها !!'  }}
                                                            @if($t->AcdameicNumber == $Groups->GroupLader)
                                                                <span class="label label-success">رئيس الفريق</span>
                                                            @endif 
                                                            |
                                                        {{ isset($t->programs->ProgramName) !=null ? $t->programs->ProgramName : 'لايوجد اي بيانات ليتم عرضها !!'  }}       
                                                      </br>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">تاريخ أنشاء المجموعة : <span class="label label-default">{{ isset($Groups->created_at) !=null ? $Groups->created_at : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                        </tr>
                                        <tr>
                                            <th scope="row">أنٌشت المجموعة بواسطة : <span class="label label-default">{{ isset($Groups->users->Name) !=null ? $Groups->users->Name : 'لايوجد اي بيانات ليتم عرضها!.'}}</span></th>
                                        </tr>
                                        <tr>
                                            <th scope="row">مشرف المجموعة : <span class="label label-default">{{ isset($Groups->project_supervisors->users->Name) !=null ? $Groups->project_supervisors->users->Name : 'لم يتم تحديد مشرف بعد !'}}</span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-check-square-o"></i> <strong>تحديد المشرف للمجموعة رقم : {{ $Groups->id }} </strong></h3>
                        </div>    
                        <div class="panel-body">
                            @if($Groups->proposals->PropertyRight == 3)
                                <div class="alert alert-danger text-center">
                                    <strong><i class="fa fa-warning"></i>  تنبيه !!</strong> مقدم المشروع الخاص بهذه المجموعة  هو الاستاذ :  <strong> {{ isset($Groups->proposals->users->Name) !=null ? $Groups->proposals->users->Name : 'لاتوجد بيانات ليتم عرضها !'}} </strong> ويرغب في أن يكون مشرف عليه. 
                                </div>
                            @endif
                        
                            <div class="table-responsive col-lg-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th class="text-center">المشرفين المتوقع أشرافهم على مشروع هذه المجموعة </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($Supervisor_Expected)==0)
                                            <tr>
                                                <td class="alert alert-danger text-center"><i class="fa fa-warning"></i> لم يتم تحديد اي مشرف من قبل اللجنة</td>
                                            </tr>
                                        @endif
                                        @if(count($Supervisor_Expected)!=0)
                                            @foreach($Supervisor_Expected as $s)
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="{{url('supervisor-distribution')}}/{{$Groups->id}}/{{$s->FN_Supervisor}}" title="أختيار"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i>  أختيار</button></a>
                                                        <a href="{{url('#')}}" title="تفاصيل"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i>  تفاصيل</button></a>
                                                        {{ isset($s->project_supervisors->users->Name) !=null ? $s->project_supervisors->users->Name : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                                    </td>
                                                    
                                                    
                                                </tr>
                                            @endforeach
                                        @endif    
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive col-lg-6 {{ $errors->has('Supervisor') ? ' has-error' : '' }}">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info">
                                            <th class="text-center">أختيار المشرف لهذه المجموعة </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {!! Form::open(["url"=>"supervisor-distribution/$Groups->id"]) !!} 
                                            <tr>
                                                <td>
                                                    <select title="أختيار المشرف لهذه المجموعة" id="Supervisor" class="form-control select2" name="Supervisor" >
                                                    <option >-- حدد المشرف من هنا --</option> 
                                                        @foreach(Supervisor() as $S)
                                                            <option value="{{ isset($S->FunctionalNumber) !=null ? $S->FunctionalNumber :'لايوجد أي بيانات لعرضها!.' }}">{{ isset($S->users->Name) !=null ? $S->users->Name : 'لاتوجد أي بيانات لعرضها!.'}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <button type="submit" class="btn btn-success form-control"> <i class="fa fa-check-square-o"></i> <strong>أختيار </strong> </button></td>
                                            </tr>
                                        {!! Form::close() !!}  
                                    </tbody>
                                    
                                </table>
                                @if ($errors->has('Supervisor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Supervisor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

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
     
        $('.select2').select2({
            dir: "rtl"
        });
           
            
      
    </script>
@Stop