@extends('layouts.Master.Student') 

@section('title')
    عرض المقترح رقم : {{ isset($Proposal->id) !=null ? $Proposal->id : 'لم يتم التحديد' }}
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            تفاصيل مقترح المشروع رقم : {{ isset($Proposal->id)  !=null ? $Proposal->id : 'لم يتم التحديد' }}
        </li>
        <li  class="pull-left" >
            <a title=" pdf" href="{{ url('download/pdf') }}"><i class="fa fa-file-pdf-o"></i></a>
        </li>
        <li  class="pull-left" >
            <a title=" طباعة" href="{{ url('#') }}"><i class="fa fa-print"></i></a>
        </li>
        <li  class="pull-left">
            <a title=" الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
            <a title=" رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
   
    <div class="blockquote-box clearfix table-responsive">
        <h4>
              <i class="fa fa-caret-left"></i>عنوان المقترح:
        </h4>
        <p>
           {{ isset($Proposal->ProjectProposalTitle) !=null ?  $Proposal->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.' }}
        </p>
    </div>

        @if($Proposal->References ==0 && $Proposal->Certified ==0)
            <hr>
            <div class="alert alert-info text-left" role="alert">
                <strong> <i class="fa fa-gears"></i>  التحكم في المقترح | </strong>
                <a title="تعديل" href="{{ url("student/proposals/$Proposal->id/edit") }}"> <button type="button" class="btn btn-warning "><i class="fa fa-edit"></i> تعديل</button></a>
                <button title="حذف" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger"><i class="fa fa-trash"></i> حذف</button> 
            </div>
        @endif
    @if(Group_has_depended() == 'no')
        @if($Proposal->References ==1 && $Proposal->Certified ==1)
            <hr>
            <div class="alert alert-info text-left" role="alert">
                {!! Form::open(['url'=>['student/add/wish',$Proposal->id]]) !!}
                    <strong> <i class="fa fa-gears"></i>  التحكم في المقترح | </strong>
                    <button title="أضافة هذا المقترح كرغبة لمجموعتي" type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> أضافة هذا المقترح كرغبة لمجموعتي</button>
                {!! Form::close() !!}
            </div>
        @endif
        @if($Proposal->References ==1 && $Proposal->Certified ==0)
            <hr>
            <div class="alert alert-danger text-center" role="alert"><h4> هذا المقترح غير معتمد من اللجنة <i class="fa fa-frown-o"></i></h4></div>
        @endif
    @endif
    
    <hr>
    <div class="table-responsive">
        <h5>
           <i class="fa fa-caret-left"></i> وصف المشروع :
        </h5>
        <p>
           {{  $Proposal->descrdiption !=null ?  $Proposal->descrdiption : 'لايوجد أي بيانات ليتم عرضها!.' }}
        </p>
    </div><hr>
    <div  class="table-responsive">
        <h5>
           <i class="fa fa-caret-left"></i> حدود المشروع Scope :
        </h5>
        <p>
           {{  $Proposal->scope !=null ?  $Proposal->scope : 'لايوجد أي بيانات ليتم عرضها!.' }}
        </p>
    </div><hr>
    <div  class="table-responsive">
        <h5>
            <i class="fa fa-caret-left"></i> مخرجات المشروع المتوقع إنجازها :
        </h5>
        <p>
           {{ $Proposal->Outputs !=null ? $Proposal->Outputs :  'لايوجد أي بيانات ليتم عرضها!.'}}
        </p> 
    </div><hr>
    <div  class="table-responsive">
        <h5><strong><i class="fa fa-caret-left"></i> مدى أهمية هذا المشروع :</strong></h5>
        <p>{{ $Proposal->ImportanceProposal !=null ? $Proposal->ImportanceProposal : 'لايوجد أي بيانات ليتم عرضها!.' }}</p>
    </div><hr>
    <div  class="table-responsive">
       <h5><strong><i class="fa fa-caret-left"></i> الأدوات المستخدمة في المشروع :</strong></h5>
       <p>{{ $Proposal->Tools !=null ? $Proposal->Tools : 'لايوجد أي بيانات ليتم عرضها!.' }}</p>
    </div><hr>
    <div  class="table-responsive">
        <h5><strong><i class="fa fa-caret-left"></i> التخصصات التي تلائم هذا المقترح : </strong></h5>
        <p>
            @if( count($p) ==0)
                لايوجد أي بيانات ليتم عرضها !!
            @endif
            @if( count($Programs) !=0)
                @foreach($Programs as $pro)
                    @if( in_array($pro->id,$p) )
                        - {{$pro->ProgramName}}  <br>
                    @endif
                @endforeach
            @endif
           
        </p>
    </div><hr>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>تفاصيل أضافية عن هذا المقترح </strong>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>عدد الطلبة المسموح بالاشتراك في هذا المشروع</th>
                            <th>العام الجامعي</th>
                            <th>الفصل الدراسي </th>
                            <th>مقدم هذا المقترح</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $Proposal->NumberOfStudents !=null ?  $Proposal->NumberOfStudents : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            <td>{{ $Proposal->calendars->AcademicYear !=null ?  $Proposal->calendars->AcademicYear : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            <td>{{ $Proposal->calendars->Semester !=null ? $Proposal->calendars->Semester : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            <td>{{ isset($Proposal->users->Name) ? $Proposal->users->Name : 'لايوجد أي بيانات ليتم عرضها!.'  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    @include('student.proposal.delete')
@endsection           
