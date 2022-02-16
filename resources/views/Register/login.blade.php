@extends('layouts.Master.Register') 

@section('title')
  تسجيل الدخول
@endsection 

@section('content')
<div class="visible-sm visible-xs text-center visible-Verification"> 
    <h3> مرحباُ بك في <strong>GPC</strong> | البوابة الإلكترونية للجنة مشاريع التخرج <br/> كلية الحاسبات وتكنولوجيا المعلومات بجامعة العلوم والتكنولوجيا</h3>
</div>
<div class="col-lg-6 col-md-6 Registration-right">
    <div class="page-header-Verification">
        <h3> تسجيل الدخول في النظام <i class="fa fa-sign-in"></i></h3>
    </div>
    <div class="Verification-form">
        <form class="form-horizontal" method="POST" action="">
            {{ csrf_field() }}
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>   
            @endif 
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label"> <i class="fa fa-user"></i> اسم المستخدم</label>
                <div class="col-md-6">
                    <input title="اسم المستخدم" id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label"> <i class="fa fa-key"></i> كلمة السر  </label>

                <div class="col-md-6">
                    <input title="كلمة السر" id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> تذكرني
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" title="دخول">
                        دخول
                    </button>

                    <a class="btn btn-link" href="" title=" هل نسيت كلمة المرور او اسم المستخدم ؟">
                        هل نسيت كلمة المرور او اسم المستخدم ؟
                    </a>

                    <a title="ذهاب للصفحة الرئيسية" class="btn btn-link btn-block" href="{{ url('/') }}">
                        الصفحة الرئيسية <i class="fa fa-home"></i>
                    </a>
                </div>   
            </div>
        </form>
       
    </div>
</div>
<!-- ************************************** -->
<div class="col-lg-6 col-md-6 hidden-sm hidden-xs Verification-left-login ">
    <h6>مرحباُ بك في نظام | <strong>GPC <i class="fa fa-graduation-cap" aria-hidden="true"></i></strong> <br/>البوابة الإلكترونية للجنة مشاريع التخرج <br/>كلية الحاسبات وتكنولوجيا المعلومات <br/> جامعة العلوم والتكنولوجيا</h6>
    <div class="col-lg-6 col-md-6 hidden-sm hidden-xs "> 
        <img title="جامعة العلوم والتكنولوجيا" class="img-rounded img-responsive"  src="{{ asset('img\logo.png') }}" alt=" جامعة العلوم والتكنولوجيا">
    </div> 
    <div class="col-lg-6 col-md-6 hidden-sm hidden-xs pull-left "> 
        <img title="GPC" class="img-rounded img-responsive"  src="{{ asset('img\GPC1.png') }}" alt="GPC">
    </div>
</div>



@endsection