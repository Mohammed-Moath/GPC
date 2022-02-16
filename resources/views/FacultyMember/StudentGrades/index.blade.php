@extends('layouts.Master.FacultyMember') 

@section('title')
التقييم
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-check-square-o"></i> التقييم
        </li>
        <li  class="pull-left">
         <a title="الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h3 class="page-header">
        <strong>رصد درجات  الطلاب</strong>
    </h3>
    @if(count($Group->project_groups) == 0)
        <div  class="alert alert-danger text-center"><h4><i class="fa fa-exclamation-triangle"></i> لا يوجد لديك مجموعات</h4></div>
    @endif
    @if(count($Group->project_groups) != 0)
        @foreach($Group->project_groups as $g)
            @if(count($g->ProjectStudent) !=0)
                <div class="panel panel-info"> 
                    <div class="panel-heading ">
                        <h3 class="panel-title text-center">
                            <strong>{{ isset($g->proposals->ProjectProposalTitle) !=null ? $g->proposals->ProjectProposalTitle : 'لاتوجد بيانات ليتم عرضها !' }}</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">أسماء الطلبة</th>
                                        <th>درجة الحضور</th>
                                        <th>درجة التسليمات</th>
                                        <th>درجة المناقشة النصفية</th>
                                        <th>درجة المناقشة النهائية</th>
                                        <th>درجاتي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($g->ProjectStudent as $s)
                                    <tr class="text-center">
                                        <td>{{ isset($s->users->Name) !=null ? $s->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        <td><span class="badge">{{ isset($s->Degree_attendance) !=null ? $s->Degree_attendance : '' }}</span></td>
                                        <td><span class="badge">{{ isset($s->Degree_delivery) !=null ? $s->Degree_delivery : '' }}</span></td>
                                        <td><span class="badge">{{ isset($s->Degree_Midterm_discussion) !=null ? $s->Degree_Midterm_discussion : '' }}</span></td>
                                        <td><span class="badge">{{ isset($s->Degree_Final_discussion) !=null ? $s->Degree_Final_discussion : '' }}</span></td>
                                        {!! Form::open(["url"=>"FacultyMember/grades/$s->AcdameicNumber/add"]) !!} 
                                            <td><input name="Degree_Supervisor"  title="ضع درجة للطالب"  type="number" class="text-center" placeholder="{{ isset($s->Degree_Supervisor) !=null ? $s->Degree_Supervisor : '' }}" style="width: 77px;" ></td>
                                            <td><button type="submit" title="تحديث" class="btn btn-success btn-xs"><i class="fa fa-refresh"></i></button></td>
                                        {!! Form::close() !!}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                </div>
            @endif
        @endforeach
    @endif
  

   
   
  
@endsection           
