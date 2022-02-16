@extends('layouts.Master.FacultyMember') 

@section('title')
    التسليمات
@endsection

@section('content')
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-book"></i>
            <a title="التسليمات" href="{{ url("FacultyMember/deliveries") }}">التسليمات </a>
        </li>
        <li>
            مجموعة | {{ isset($Group->project_students->users->Name) !=null ? $Group->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/FacultyMember') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>

    @if(count($Group->delivs)==0 )
      <div  class="alert alert-danger text-center"><h5><i class="fa fa-exclamation-triangle"></i><strong>لاتوجد تسليمات للمجموعة</strong></h5></div>
    @endif

    @unless(count($Group->delivs)==0 )
        <h3 class="page-header">
            <strong>تسليمات مجموعة |  {{ isset($Group->project_students->users->Name) !=null ? $Group->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</strong>
        </h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>موضوع التسليم</th>
                        <th>تاريخ التقديم</th>
                        <th>اخر موعد للتسليم</th>
                        <th>الحالة</th>
                        <th  class="text-center"><i class="fa fa-cog" style="color: #376fbf;"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Group->delivs as $d)
                        <tr>
                            <td>
                                <a href="{{ asset("uploads/deliveries/$d->path") }}" download title="تنزيل">
                                    <button  type="button" class="btn btn-default  btn-xs" >
                                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                                    </button>
                                </a>
                            </td>
                            <td>{{ isset($d->type_delivs->name) !=null ? $d->type_delivs->name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            <td>{{ isset($d->created_at) !=null ? $d->created_at : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            <td><span class="label label-danger">{{ isset($d->type_delivs->time_close) !=null ? $d->type_delivs->time_close : 'لاتوجد بيانات ليتم عرضها !' }}</span></td>
                            <td>
                                @if($d->statu == 0)
                                    <span class="label label-warning">غير مراجع </span>
                                @endif
                                @if($d->statu == 1)
                                    <span class="label label-success">مقبول </span>
                                @endif
                                @if($d->statu == 2)
                                    <span class="label label-danger">غير مقبول </span>
                                @endif
                                @if($d->statu > 2)
                                    <span class="label label-primary">هناك خطأ في الحالة</span>
                                @endif
                            </td>
                            <td>
                                <button title="مقبول" class="btn btn-success btn-xs" type="button" data-title="Acceptable" data-toggle="modal" data-target="#Acceptable-{{ $d->id }}"><i class="fa fa-check-circle-o"></i> مقبول</button>
                                <button title="غير مقبول" class="btn btn-danger btn-xs" type="button" data-title="Unacceptable" data-toggle="modal" data-target="#Unacceptable-{{ $d->id }}"><i class="fa fa-times-circle-o"></i> غير مقبول</button>
                                <button title="تفاصيل" class="btn btn-primary btn-xs" type="button"><i class="fa fa-folder-open"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
      
        </div>
    @endif

    @if(count($Group->delivs)!=0) 
        @include('FacultyMember.Deliveries.Acceptable')
        @include('FacultyMember.Deliveries.Unacceptable')
    @endif  
@endsection           
