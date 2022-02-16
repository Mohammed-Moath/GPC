@extends('layouts.Master.Student') 

@section('title')
  الصفحة الرئيسية للطالب
@endsection

@section('content')
    <div class="col-lg-4"> 
        <img title="GPC" class="img-rounded img-responsive"  src="{{ asset('img\GPC1.png') }}" alt=" #">
    </div>
    <div class="col-lg-8 pull-left"> 
      <h2> <small>مرحباُ بك في GPC | البوابة الالكترونية للجنة مشاريع التخرج <br/> كلية الحاسبات وتكنولوجيا المعلومات بجامعة العلوم والتكنولوجيا </small></h2>
    </div>   
@endsection           
