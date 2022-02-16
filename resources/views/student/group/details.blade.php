@extends('layouts.Master.Student') 

@section('title')
    تفاصيل مجموعة العمل رقم {{ $gruop->id}}
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
          <a href="{{ url('student/group') }}"> مجموعة مشاريع التخرج</a>
        </li>
        <li class="active">
           تفاصيل مجموعة العمل رقم {{ $gruop->id}}
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <div class="page-header">
        @if(Student_has_groug() == 'no')
            <button title="الانضمام الى هذه المجموعة" data-toggle="modal" data-target="#myModal" class="btn btn-primary pull-left ">   الانضمام الى هذه المجموعة <i class="fa fa-sign-in"></i></button>
        @endif
        <h3> تفاصيل مجموعة العمل رقم {{ $gruop->id}} </h3>  
    </div>
    @if( Group_has_depended() == 'no')
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><strong>رغبات المشاريع الخاصة بالمجموعة</strong></h3>
            </div>
            <div class="panel-body">
                @if(count($Wishe) == 0)
                    <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-exclamation-triangle"></i> لاتوجد أي رغبات مسجله للمجموعة</h5></div>
                @endif
                @if(count($Wishe) != 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr class="success">
                                <th>عنوان  المشروع </th>
                                <th>اولوية المشروع</th>
                                <th>تاريخ الاضافة</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($Wishe as $W)
                            <tr>
                                <th scope="row"> {{ isset($W->proposals->ProjectProposalTitle) ? $W->proposals->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.'  }}</th>
                                <td>
                                    @if($W->priority == null)
                                    <span class="label label-danger">لم يتم تحديد الاولوية بعد!</span>
                                    @endif
                                    @if($W->priority != null)
                                    <span class="label label-info">أولوية رقم : {{$W->priority}}</span>
                                    @endif
                                </td>
                                <td> {{ ($W->created_at) !=null ? $W->created_at : 'لايوجد أي بيانات ليتم عرضها!.'  }} </td>
                            </tr>
                        @endforeach  
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endif
    @if( Group_has_depended() == 'yes')
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><strong>عنوان مشروع التخرج</strong></h3>
            </div>
            <div class="panel-body">
                {{ $gruop->proposals->ProjectProposalTitle !=null ? $gruop->proposals->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.' }}
            </div>
        </div>
    @endif
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>رئيس مجموعة العمل</strong></h3>
        </div>
        <div class="panel-body">
            {{ isset( $gruop->project_students->users->Name  ) ? $gruop->project_students->users->Name  : 'لا توجد أي بيانات ليتم عرضها !'  }}
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>مشرف مجموعة العمل</strong></h3>
        </div>
        <div class="panel-body">
            {{ isset( $gruop->project_supervisors->users->Name ) ? $gruop->project_supervisors->users->Name : 'لم يتم تحديد مشرف لهذا المجموعة بعد !!'  }}
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>أعضاء الفريق لهذه المجموعة</strong></h3>
        </div>
        <div class="panel-body">
            @if(count($Team) == 0)
                <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-exclamation-triangle"></i> لا يوجد لدى هذه المجموعة اعضاء فريق!</h5></div>
            @endif
            @if(count($Team) != 0)
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
                            <th>الرقم الاكاديمي </th>
                            <th>الاسم</th>
                            <th>التخصص</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($Team as $t)
                        <tr>
                            <th scope="row">{{  $t->AcdameicNumber !=null ?  $t->AcdameicNumber : 'لايوجد أي بيانات ليتم عرضها!.' }}</th>
                            <td>
                                {{ isset($t->users->Name) !=null ?  $t->users->Name : 'لايوجد أي بيانات ليتم عرضها!.' }}
                            </td>
                            <td>{{ isset($t->programs->ProgramName) !=null ? $t->programs->ProgramName : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                        </tr>
                    @endforeach  
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>تفاصيل اخرى عن هذه المجموعة</strong></h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover ">
                <tbody>
                    <tr>
                        <td><strong>أنُشت هذه المجموعة بواسطة</strong></td>
                        <td>{{ isset($gruop->users->Name) !=null ? $gruop->users->Name : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                    </tr>
                    <tr>
                        <td><strong>العام الجامعي الذي أنشت فيه المجموعة</strong></td>
                        <td>{{ isset( $gruop->AcademicYear ) !=null ?  $gruop->AcademicYear : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                    </tr>
                    <tr>
                        <td><strong>الفصل الدراسي الذي أنشت فيه المجموعة</strong></td>
                        <td>{{ isset( $gruop->Semester ) !=null ?  $gruop->Semester : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                    </tr>
                    <tr>
                        <td><strong>المركز الدراسي لهذه المجموعة</strong></td>
                        <td>{{ isset( $gruop->branches->BrancheNameAR ) !=null ?  $gruop->branches->BrancheNameAR : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                    </tr>
                    <tr>
                        <td><strong>تاريخ انشاء هذه المجموعة</strong></td>
                        <td>{{ isset( $gruop->created_at ) !=null ?  $gruop->created_at : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if(Student_has_groug() == 'no')
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">الانضمام الى مجموعة العمل رقم {{$gruop->id}}</h4>
                </div>
                {!! Form::open(["url"=>['student/group/join',$gruop->id]]) !!}
                    <div class="modal-body">
                        <p> <strong> يرجي ادخال رمز المجموعة لكي تستطيع الانضمام اليها . </strong>غالباً ما يتم أضافة رمز الدخول من قبل رئيس المجموعة </p>
                        {!! Form::text('GroupCode',null,['required','class'=>'form-control','placeholder'=>'يرجي ادخال رمز المجموعة لكي تستطيع الانضمام اليها','title'=>'رمز المجموعة']) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">أنضمام الى المجموعة</button>
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">ألغاء</button>
                    </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    @endif
@endsection           
