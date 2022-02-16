@extends('layouts.Master.Student') 

@section('title') 
مقترحاتي
@endsection
 
@section('content')
    <ol class="breadcrumb">
        <li class="active">
                <i class="fa fa-lightbulb-o"></i>
            مقترحاتي
        </li>
        <li  class="pull-left">
            <a title="ذهاب للصفحة الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
            <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <div class="alert alert-danger text-center" role="alert">
        <a class="pull-left" href="{{ url('student/create/proposals') }}" title="تقديم مقترح">  <button type="button" class="btn btn-info">تقديم مقترح</button></a>
        <h6><i class="fa fa-exclamation-triangle"></i> 
        يمكنك أضافة عدد : <span class="badge bg-danger">{{Max_NumberAddProposal_Student()}}</span> من مقترحات مشاريع التخرج ، وأخر موعد للتقديم هو : 
        <span class="label label-danger">{{EndTimeSubmitProposal()}}</span>
        </h6>
       
    </div>
    <h3 class="page-header">
        <strong> مقترحات المشاريع التي قدمتها عبر نظام GPC <i class="fa fa-graduation-cap" aria-hidden="true"></i></strong>
    </h3> 
    <div class="panel panel-info"> 
        <div class="panel-heading clickable"> 
            <h3 class="panel-title">
                <strong>مقترحات قدمتها وترغب في أن تكون خاصة بك</strong>
            </h3>
            <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
        </div>
        <div class="panel-body table-responsive">
            @if(count( $TPNYes) == 0)
                <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-exclamation-triangle"></i> لايوجد أي مقترح</h5></div>
            @endif
            @unless(count( $TPNYes) == 0)
                @foreach($TPNYes as $yes)
                    <ul>
                        <a title="تفاصيل هذه المشروع" href="{{ url("student/proposals/$yes->id/details") }}"> <li> مشروع : {{ $yes->ProjectProposalTitle }}</il> </a>
                        @if($yes->References ==0 && $yes->Certified ==0)
                            <span class="label label-warning"> قيد المراجعة</span>
                        @endif
                        @if($yes->References ==1 && $yes->Certified ==1)
                            <span class="label label-success">تم اعتماده</span>
                        @endif
                        @if($yes->References == 1 && $yes->Certified ==0)
                            <span class="label label-danger"> غير معتمد</span>
                        @endif
                    </ul>
                @endforeach 
          @endif     
        </div> 
    </div>
    <div class="panel panel-success"> 
        <div class="panel-heading clickable">
            <h3 class="panel-title">
                <strong>مقترحات قدمتها ولا ترغب في ان تكون خاصة بك</strong></h3>
            <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
        </div>
        <div class="panel-body table-responsive">
            @if(count( $TPNNo) == 0)
                <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-exclamation-triangle"></i> لايوجد أي مقترح</h5></div>
            @endif
            @unless(count( $TPNNo) == 0)
                @foreach($TPNNo as  $yes)
                    <ul>
                        <a title="تفاصيل هذه المشروع" href="{{ url("student/proposals/$yes->id/details") }}"> <li> مشروع : {{ $yes->ProjectProposalTitle }}</il> </a>
                        @if($yes->References ==0 && $yes->Certified ==0)
                            <span class="label label-warning"> قيد المراجعة</span>
                        @endif
                        @if($yes->References ==1 && $yes->Certified ==1)
                            <span class="label label-success">تم اعتماده</span>
                        @endif
                        @if($yes->References == 1 && $yes->Certified ==0)
                            <span class="label label-danger"> غير معتمد</span>
                        @endif
                    </ul>
                @endforeach 
          @endif 
        </div>
    </div>
@endsection           
