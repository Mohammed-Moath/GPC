@extends('layouts.Master.FacultyMember') 

@section('title')  
   اللقاءات | القاءات السابقة لمجموعة العمل رقم {{  $group->id  }} - {{ $TypeStudent }} 
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
          <a title=" اللقاءات " href="{{ url('FacultyMember/meetings') }}">اللقاءات </a>
        </li>
        <li class="active">
           اللقاءات السابقة لمجموعة العمل رقم   {{  $group->id  }}  -  {{ $TypeStudent }}
        </li>
        <li  class="pull-left">
            <a title="ذهاب للصفحة الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ url('home/FacultyMember') }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <h3 class="page-header">
        <strong>  اللقاءات السابقة لمجموعة العمل رقم   {{  $group->id  }}  -  {{ $TypeStudent }}</strong>
    </h3>
    <div class="panel panel-{{ $coler }}"> 
        <div title="أنقر للمزيد" class="panel-heading clickable">
            <h3 class="panel-title">
                <strong>اجمالي عدد اللقاءات التي عقدت مع هذه المجموعة : {{ $MeetingNumber }}</strong></h3>
            <span class="pull-left "><i class="glyphicon glyphicon-minus"></i></span>
        </div>
        <div class="panel-body">
            @if($MeetingNumber == 0)
                <div class="alert alert-danger text-center" role="alert"><h3><i class="fa fa-exclamation-triangle"></i> لم يعقد أي لقاء مع هذه المجموعة حتي الان !!</h3></div>
            @endif 
            @unless($MeetingNumber == 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>عنوان اللقاء</th>
                            <th>تاريخ أنعقاده</th>
                        </tr>
                    </thead>
                    <tbody>  
                            @foreach($meeting as $m)
                                <tr>
                                    <td>
                                        <a title="تفاصيل أكثر عن لقاءات هذه المجموعة" href="group/{{ $B->id }}">
                                        {{ $m->TitleMeeting }}
                                        </a>    
                                    </td>
                                    <td>
                                        <a title="تفاصيل أكثر عن لقاءات هذه المجموعة" href="group/{{ $B->id }}">
                                        {{ $m->created_at }}
                                        </a>    
                                    </td>
                                </tr>
                            @endforeach 
                    </tbody>
                </table>
            @endif  
        </div>
    </div> 



    
   
  
@endsection           
