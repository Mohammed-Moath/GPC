@extends('layouts.Master.Student') 

@section('title')
    مجموعتي
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
             <i class="fa fa-users" aria-hidden="true"></i> مجموعتي</a>
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <div class="alert alert-info">
        السلام عليكم        {{ Auth::user()->Name }} <strong> ، كيف حالك ؟</strong>
    </div>
    <div  class="col-lg-6 col-md-6" >
        <h5> لايوجد لديك اي مجموعة عمل !! 
        فهل ترغب في </h5></br>
        <a title="أنشاء مجموعة عمل " href="{{ url('student/create/group') }}">أنشاء مجموعة عمل  </a>
        </br></br><strong>أم</strong></br></br>
        <a title="الانضمام الى احدى مجموعات العمل التي قد تم أنشاءها من قبل زملائك " href="{{ url('student/group') }}">الانضمام الى احدى مجموعات العمل التي قد تم أنشاءها من قبل زملائك  </a>
    </div>
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs  "> 
        <img title="GPC" class="img-rounded img-responsive"  src="{{ asset('img\GPC-Boys.png') }}" alt="GPC">
    </div>
@endsection           
