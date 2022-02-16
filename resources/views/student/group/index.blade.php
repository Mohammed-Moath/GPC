@extends('layouts.Master.Student') 

@section('title')
    مجموعات مشاريع التخرج 
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
          مجموعات مشاريع التخرج
        </li>
        <li  class="pull-left">
         <a title="ذهاب للصفحة الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h3 class="page-header">
     مجموعات مشاريع التخرج 
    </h3>
    <div>
        @if( Group_has_depended() == 'no')
            <strong>
                <i class="fa fa-hand-o-left"></i>  قم بأختيار مجموعتك لمشروع التخرج من المجموعات التي قد تم تكوينها من قبل زملائك  من الجدول ادني<i class="fa fa-arrow-down"></i>  ،او قم بأنشاء مجموعتك الخاصة </br> <a title="أنشاء مجموعة عمل" href="{{ url('student/create/group')}}"> أضغط الرابط هنا.</a> <br><br> 
            </strong>
        @endif    
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="info">
                    <th colspan="3" class="text-center">مجموعات مشاريع التخرج للعام الجامعي / {{ $condtion->AcademicYear !=null ? $condtion->AcademicYear : 'لايوجد أي بيانات ليتم عرضها!.' }}</th>
                </tr>
                <tr>
                    <th class="text-center">رقم المجموعة</th>
                    <th class="text-center">تاريخ الانشاء</th>
                    <th class="text-center">رئيس المجموعة</th>
                </tr>
            </thead>
            <tbody>
                @if(count($gruop) == 0)
                    <tr>
                        <td colspan="3" class="alert alert-danger text-center"><h5><i class="fa fa-exclamation-triangle"></i> لا توجد أي مجموعة !!</h5></td>
                    </tr>
                @endif
                @if( count( $gruop) != 0)
                    @foreach($gruop as $g)
                        <tr>
                            <td>{{ $g->id }}</td>
                            <td>{{ $g->created_at !=null ? $g->created_at : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            <td>
                            {{ isset($g->project_students->users->Name) ? $g->project_students->users->Name : 'لا يوجد أي بيانات ليتم عرضها!' }}
                            </td>
                            <td><a title="تفاصيل" href="{{ url("student/group/$g->id/details") }}"><i class="fa fa-folder-open"></i> تفاصيل </a></td>
                        </tr>
                    @endforeach    
                @endif 
            </tbody>
        </table>
    </div>
    <div>
      {{ $gruop->links() }}
    </div>
@endsection           
 