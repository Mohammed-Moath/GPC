@extends('layouts.Master.FacultyMember') 

@section('title')
    التسليمات
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-book"></i>
         التسليمات 
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>

    @if(count($GroupB)==0 && count($GroupG)==0)
      <div  class="alert alert-danger text-center"><h4><i class="fa fa-exclamation-triangle"></i> لا يوجد لديك مجموعات</h4></div>
    @endif

    @unless(count($GroupB)==0 && count($GroupG)==0)
        <h3 class="page-header">
            <strong>تسليمات المجموعات التي تشرف عليها</strong>
        </h3>
        @if(count($GroupB)!=0)
            <div class="panel panel-info"> 
                <div  class="panel-heading text-center">
                    <h3 class="panel-title">
                        <strong>الطلاب</strong></h3>
                </div>

                <div class="panel-body">

                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover col-lg-12">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>رئيس مجموعة العمل</th>
                                    <th>عنوان المشروع</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($GroupB as $g)
                                <tr>
                                <td>
                                    <a title="عرض التسليمات" href="{{ url("FacultyMember/deliveries/$g->id") }}"  class="btn btn-success btn-xs">  عرض التسليمات <span class="label label-default">({{count($g->delivs )}})</span></a>
                                </th>
                                <td>
                                    <a title="تفاصيل المجموعة" href="{{url('FacultyMember/my-student/group',$g->id)}}"  class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i>  </a>
                                    | {{isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                <td>
                                    <a title="تفاصيل المشروع" href="{{url('FacultyMember/proposal/show',$g->proposals_id)}}"  class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i>  </a>
                                    | 
                                    {{isset($g->proposals->ProjectProposalTitle) !=null ? $g->proposals->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}
                                </td>
                                </tr>
                            @endforeach    
                            </tbody>
                        </table>
                    </div>
            
                </div>
            </div>
        @endif

        @if(count($GroupG)!=0)
            <div class="panel panel-danger"> 
                <div  class="panel-heading text-center">
                    <h3 class="panel-title">
                        <strong>الطالبات</strong></h3>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th>رئيس مجموعة العمل</th>
                                <th>عنوان المشروع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($GroupG as $g)
                                <tr>
                                    <td>
                                        <a title="فتح لقاء" href="{{url('FacultyMember/meetings/create',$g->id)}}"  class="btn btn-success btn-xs">فتح لقاء</a>
                                    </th>
                                    <th>
                                        <a title="التسليمات السابقة" href="{{ url("FacultyMember/meeting/$g->id/show") }}"  class="btn btn-info btn-xs">التسليمات السابقة</a>
                                    </th>
                                    <td>
                                    <a title="تفاصيل المجموعة" href="{{url('FacultyMember/my-student/group',$g->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> تفاصيل </a>
                                    | {{isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                    <td>
                                    <a title="تفاصيل المشروع" href="{{url('FacultyMember/proposal/show',$g->proposals_id)}}"  class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> تفاصيل </a>
                                    | 
                                    {{isset($g->proposals->ProjectProposalTitle) !=null ? $g->proposals->ProjectProposalTitle : 'لاتوجد اي بيانات ليتم عرضها !'}}
                                    </td>
                                </tr>
                            @endforeach    
                        </tbody>
                    </table>
                </div>
                
                </div>
            </div>
        @endif

        @if(count($GroupB)==0)
            <div  class="alert alert-danger text-center"><h5><i class="fa fa-exclamation-triangle"></i> لا يوجد لديك مجموعة طلاب</h5></div>
        @endif

        @if(count($GroupG)==0)
            <div  class="alert alert-danger text-center"><h5><i class="fa fa-exclamation-triangle"></i> لا يوجد لديك مجموعة طالبات</h5></div>
        @endif

      

          
     

    @endif
   
   
  
@endsection           
