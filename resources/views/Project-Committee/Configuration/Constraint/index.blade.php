@extends('layouts.Master.Project-Committee') 

@section('title')
 قيود 
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">  <i class="fa fa-gear"></i> التهيئة </li>
                    <li class="breadcrumb-item active"> قيود </li>
                </ol>
            </nav>
        </div>

        <div class="col">
        <div class="text-left">
        <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
            <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
        </div>
        </div>
    </div>

    {{ Form::model(Constraint(),array('method'=>'PATCH','url'=>['project-committee/configuration/constraint',Constraint()->id,'update'])) }}
        <div class="row">
            <div class="col">
                <div class="card card border-info border-bottom-0 mb-3">
                    <div class="card-body text-danger">
                        <i class="fa fa-info-circle"></i>
                        هنا يتم تحديد القيود المختلفة التي سيتم تطبيقها على كافة النظام
                        <div class="btn-group btn-group-sm float-left" role="group">
                            <button title="حفظ" type="submit" class="btn btn-outline-success"> <i class="fa fa-check-circle"></i> حفظ</button>
                            <button title="الغاء" type="reset" class="btn btn-outline-danger"> <i class="fa fa-times-circle"></i> الغاء</button>   
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="clearfix">
                <div class="col-sm-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2" class="text-center font-weight-bold"> المقترحات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><small>العدد المسوح أضافته من قبل الطالب</small></th>
                                <td>   {{ Form::select('Number_AddProposalStudent', Number(), null, ['id'=>'Number_AddProposalStudent','class'=>" form-control-sm custom-select",'required','title'=>'أختر رقم']) }}</td>
                            </tr>
                            <tr>
                                <th scope="row"><small>العدد المسوح أضافته من قبل أعضاء هيئة التدريس</small></th>
                                <td>{{ Form::select('Number_AddProposalTeacher', Number(), null, ['id'=>'Number_AddProposalTeacher','class'=>"form-control-sm custom-select",'required','title'=>'أختر رقم']) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2" class="text-center font-weight-bold"> المجموعات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><small>عدد رغبات المشاريع المتاح أختيارها</small></th>
                                <td>    {{ Form::select('Number_chooseWishes', Number(), null, ['id'=>'Number_chooseWishes','class'=>" form-control-sm custom-select",'required','title'=>'أختر رقم']) }}</td>
                            </tr>
                            <tr>
                                <th scope="row"><small>أقل عدد في المجموعة :</small></th>
                                <td> {{ Form::select('Min_Number_StudentinGroup', Number(), null, ['id'=>'Min_Number_StudentinGroup','class'=>"form-control-sm custom-select",'required','title'=>'أختر رقم']) }}</td>
                            </tr>
                            <tr>
                                <th scope="row"><small>أقصي عدد في المجموعة :</small></th>
                                <td> {{ Form::select('Max_Number_StudentinGroup', Number(), null, ['id'=>'Max_Number_StudentinGroup','class'=>"form-control-sm custom-select",'required','title'=>'أختر رقم']) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2" class="text-center font-weight-bold"> أقرار المشاريع</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><small>يعتمد المشروع لعدد مجموعة طلاب</small></th>
                                <td>   {{ Form::select('Max_Certified_Project_GroupB', Number(), null, ['id'=>'Max_Certified_Project_GroupB','class'=>" form-control-sm custom-select",'required','title'=>'أختر رقم']) }}</td>
                            </tr>
                            <tr>
                                <th scope="row"><small>يعتمد المشروع لعدد مجموعة طالبات</small></th>
                                <td>{{ Form::select('Max_Certified_Project_GroupG', Number(), null, ['id'=>'Max_Certified_Project_GroupG','class'=>"form-control-sm custom-select",'required','title'=>'أختر رقم']) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {{ Form::close() }} 

    <div class="row">
        <div class="clearfix">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="5" class="text-center font-weight-bold"> توزيع المجموعات على المشرفين    <button title="أضافة" type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square-o"></i></button> </th>
                        
                        </tr>
                    </thead>
                    @if(count($UndrSup) == 0)
                        <tbody>
                            <tr>
                                <th  colspan="5" class="alert alert-danger text-center">  <i class="fa fa-warning"></i> لايوجد أي قيد </th>
                            </tr>
                        </tbody>    
                    @endif
                    @if(count($UndrSup) != 0)
                        <thead>
                            <tr>
                                <th></th> 
                                <th> المسمى العلمي</th>  
                                <th>البرنامج المسموح بالاشراف عليه</th>  
                                <th>عدد الطلاب</th>  
                                <th>عدد الطالبات</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($UndrSup as $u)
                                <tr>
                                    <th scope="row"> <a title="حذف" href="{{url("project-committee/configuration/constraint/under-supervisions/$u->id/delete")}}" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash"></i></a></th>
                                    <td>{{ isset($u->scientific_degrees->name) !=null ? $u->scientific_degrees->name : 'لاتوجد بيانات ليتم عرضها !' }}  </td>
                                    <td>{{ isset($u->program_types->name) !=null ? $u->program_types->name : 'لاتوجد بيانات ليتم عرضها !' }}  </td>
                                    <td><span class="badge badge-pill badge-dark">{{ isset($u->Boys) !=null ? $u->Boys : 'لاتوجد بيانات ليتم عرضها !' }}</span></td>
                                    <td><span class="badge badge-pill badge-dark">{{ isset($u->Grilys) !=null ? $u->Grilys : 'لاتوجد بيانات ليتم عرضها !' }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">أضافة قيد توزيع المشرفين</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(["url"=>"project-committee/configuration/constraint/under-supervisions"]) }}
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('scientific_degrees_id') ? 'has-error' : '' }}">
                        <label for="scientific_degrees_id"><span style="color:red;">*</span><strong> المسمى العلمي :</strong></label>
                        {{ Form::select('scientific_degrees_id', ScientificDegree(), null, ['class'=>"form-control custom-select",'required','placeholder' => '--- أختر المسمى العلمي  ---','title'=>'المسمى العلمي']) }}
                        @if ($errors->has('scientific_degrees_id'))
                            <div class="masseg_error">
                                {{ $errors->first('scientific_degrees_id') }}
                            </div>  
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('program_types_id') ? 'has-error' : '' }}">
                        <label for="program_types_id"><span style="color:red;">*</span><strong> نوع البرنامج المسموح بالاشراف عليه :</strong></label>
                        {{ Form::select('program_types_id', ProgramType(), null, ['class'=>"form-control custom-select",'required','placeholder' => '--- أختر نوع البرنامج  ---','title'=>'نوع البرنامج']) }}
                        @if ($errors->has('program_types_id'))
                            <div class="masseg_error">
                                {{ $errors->first('program_types_id') }}
                            </div>  
                        @endif
                    </div>
                    <div class="form-group col-md-6{{ $errors->has('Boys') ? 'has-error' : '' }}">
                        <label for="Boys"><span style="color:red;">*</span><strong> العدد - طلاب :</strong></label>
                        {{ Form::select('Boys', Number(), null, ['class'=>"form-control custom-select",'required','placeholder' => '--- أختر العدد ---','title'=>'العدد طلاب']) }}
                        @if ($errors->has('Boys'))
                            <div class="masseg_error">
                                {{ $errors->first('Boys') }}
                            </div>  
                        @endif
                    </div>
                    <div class="form-group col-md-6{{ $errors->has('Grilys') ? 'has-error' : '' }}">
                        <label for="Grilys"><span style="color:red;">*</span><strong> العدد - طالبات :</strong></label>
                        {{ Form::select('Grilys', Number(), null, ['class'=>"form-control custom-select",'required','placeholder' => '--- أختر العدد ---','title'=>'العدد طالبات']) }}
                        @if ($errors->has('Grilys'))
                            <div class="masseg_error">
                                {{ $errors->first('Grilys') }}
                            </div>  
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">أغلاق</button>
                    <button type="submit" class="btn btn-primary btn-sm">حفظ التغيرات</button>
                </div>
            {{ Form::close() }}          
            </div>
        </div>  
    </div>
@Stop