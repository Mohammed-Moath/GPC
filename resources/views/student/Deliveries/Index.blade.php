@extends('layouts.Master.Student') 

@section('title')
    التسليمات
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-book"></i>  التسليمات
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>تسليمات مطلوب تقديمها</strong></h3>
        </div>
        <div class="panel-body">
            @if(count(Deliveries())==0)
                <div class="alert alert-success text-center" role="alert"><h5><i class="fa fa-smile-o"></i> لاتوجد تسليمات مطلوب تقديمها</h5></div>
            @endif
            @if(count(Deliveries())!=0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>العنوان</th>
                                <th class="danger">أخر موعد للتقديم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Deliveries() as $d)
                                <tr>
                                    <td>{{isset($d->name) !=null ? $d->name : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                    <td>{{isset($d->time_close) !=null ? $d->time_close : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                                    <td><a title="تقديم" href="{{ url("student/deliveries/$d->id/submit") }}"><i class="fa fa-upload"></i> تقديم</a></td>  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>تسليمات تم تقديمها</strong></h3>
        </div>
        <div class="panel-body">
            @if(count($Deliver)==0)
                <div class="alert alert-danger text-center" role="alert"><h5><i class="fa fa-warning"></i> لاتوجد تسليمات تم تقديمها</h5></div>
            @endif
            @if(count($Deliver)!=0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>موضوع التسليم</th>
                            <th>الحالة</th>
                            <th>تاريخ التقديم</th>
                            <th>قدم بواسطة</th>
                            <th>ملاحظات المشرف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Deliver as $d)
                            <tr>
                                <td>
                                    <a href="{{ asset("uploads/deliveries/$d->path") }}" download title="تنزيل">
                                        <button  type="button" class="btn btn-default  btn-xs" >
                                            <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                                        </button>
                                    </a>
                                </td>
                                   
                                <td>{{ isset($d->type_delivs->name) !=null ? $d->type_delivs->name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                <td>
                                    @if($d->statu == 0)
                                        <span class="label label-default">تم التقديم</span>
                                    @endif
                                    @if($d->statu == 1)
                                        <span class="label label-warning">قيد المراجعة</span>
                                    @endif
                                    @if($d->statu == 2)
                                        <span class="label label-danger">مرفوض</span>
                                    @endif
                                    @if($d->statu == 3)
                                        <span class="label label-success">مقبول</span>
                                    @endif
                                </td>
                                <td>{{ isset($d->created_at) !=null ? $d->created_at : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                <td>{{ isset($d->project_students->users->Name) !=null ? $d->project_students->users->Name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                <td>{{ isset($d->Note) !=null ? $d->Note : '' }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

  
   
 
 
@endsection           
 