@extends('layouts.Master.FacultyMember') 

@section('title')
  طلابي
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-group"></i>
          طلابي 
        </li>
        <li  class="pull-left">
          <a title="ذهاب للصفحة الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h3 class="page-header">
      <strong>المجموعات التي تشرف عليها</strong>
    </h3>

    @if(count($GroupB)==0 && count($GroupG)==0)
      <div  class="alert alert-danger text-center"><h5><i class="fa fa-exclamation-triangle"></i>لا يوجد لديك أي مجموعة</h5></div>
    @endif

    @unless(count($GroupB)==0 && count($GroupG)==0)
      
      @if(count($GroupB)!=0)

        <div class="panel panel-info"> 
            <div class="panel-heading ">
                <h3 class="panel-title text-center">
                  <strong>الطلاب</strong>
                </h3>
            </div>
            <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>رئيس مجموعة العمل</th>
                            <th>عنوان المشروع</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($GroupB as $g)
                          <tr>
                              <td>
                                <a title="تفاصيل المجموعة" href="{{url('FacultyMember/my-student/group',$g->id)}}"  class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i></a>
                                | {{isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                              <td>
                                <a title="تفاصيل المشروع" href="{{url('FacultyMember/proposal/show',$g->proposals_id)}}"  class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i></a>
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
            <div class="panel-heading ">
                <h3 class="panel-title text-center">
                    <strong>الطلابات</strong></h3>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>رئيس مجموعة العمل</th>
                              <th>عنوان المشروع</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($GroupG as $g)
                            <tr>
                                <td>
                                  <a title="تفاصيل المجموعة" href="{{url('FacultyMember/my-student/group',$g->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i></a>
                                  | {{isset($g->project_students->users->Name) !=null ? $g->project_students->users->Name : 'لاتوجد اي بيانات ليتم عرضها !'}}</td>
                                <td>
                                  <a title="تفاصيل المشروع" href="{{url('FacultyMember/proposal/show',$g->proposals_id)}}"  class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i></a>
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
        <div  class="alert alert-danger text-center"><h5><i class="fa fa-exclamation-triangle"></i> لايوجد لديك مجموعات طلاب</h5></div>
      @endif

      @if(count($GroupG)==0)
        <div  class="alert alert-danger text-center"><h5><i class="fa fa-exclamation-triangle"></i> لا يوجد لديك مجموعة طالبات </h5></div>
      @endif
     

    @endif
@endsection           
