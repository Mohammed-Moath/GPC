@extends('layouts.Master.Student') 

@section('title')
       مقترحات مشاريع التخرج
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
             مقترحات مشاريع التخرج
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h3 class="page-header">
      مقترحات مشاريع التخرج
    </h3>
    @if( Group_has_depended() == 'no' )
        <strong>
            <i class="fa fa-info-circle"></i>  قم بأختيار مقترح مشروع التخرج من المقترحات المعتمده من لجنة المشاريع من الجدول ادني<i class="fa fa-arrow-down"></i>  ، او قم بالاختيار من قائمة المقترحات الخاصة بك </br>التي قدمتها  للجنة المشاريع <a title="مقترحاتي" href="{{ url('student/my-proposals')}}"> أضغط الرابط هنا.</a> <br><br> 
        </strong>
    @endif
   
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="info">
                    <th colspan="3" class="text-center">مقترحات مشاريع التخرج المعتمدة للعام الجامعي {{ isset($condtion->AcademicYear) !=null ? $condtion->AcademicYear : 'لا توجد اي بيانات ليتم عرضها!' }}</th>
                </tr>
                <tr>
                    <th class="text-center">الرقم</th>
                    <th class="text-center">عنوان المشروع المقترح</th>
                    <th class="text-center">تاريخ النشر</th>
                </tr>
            </thead>
            <tbody>
                @if(count($Proposal)==0)
                    <tr>
                        <td colspan="3" class="alert alert-danger text-center"><h4><i class="fa fa-exclamation-triangle"></i> لا يوجد أي مقترح مشروع !!</h4></td>
                    </tr>
                @endif
                @unless(count($Proposal)==0)
                    @foreach($Proposal as $p)
                        <tr>
                            <td>{{ isset($p->id) ? $p->id : 'لايوجد أي بيانات ليتم عرضها!.'  }}</td>
                            <td>{{ isset($p->ProjectProposalTitle) ? $p->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.'  }}</td>
                            <td>{{ isset($p->created_at) ? $p->created_at : 'لايوجد أي بيانات ليتم عرضها!.'  }}</td>
                            <td><a href="{{ url("student/proposals/$p->id/details") }}">تفاصيل أكثر <i class="fa fa-plus-circle"></i></a></td>
                        </tr>
                    @endforeach    
                @endif 
            </tbody>
        </table>
       
    </div> 
    
    <div class="text-center">
        {{ $Proposal->links() }}
    </div>
@endsection   