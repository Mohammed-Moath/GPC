<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GPC | خطأ في الحصول على الصفحة</title>
  <!-- Bootstrap Core CSS -->
  {!! Html::style('css/bootstrap.css')!!}
  <!-- Bootstrap Core CSS RTL-->
  {!! Html::style('css/bootstrap-rtl.css') !!}
  <!-- Font-Awesome -->
  {!! Html::style('css/font-awesome.css')!!}
  <!-- Custom CSS -->
  {!! Html::style('css/welcome.css')!!}
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body class="nav-md">
  <div class="container body ">
    <div class="main_container error_404">
      <!-- page content -->

      <div class="text-center"><i class="fa fa-5x fa-frown-o" style="color:#d9534f;"></i></div>
      <h1 class="text-center">هناك بيانات مفقودة !! <p> </p>
        <p><small class="text-center"> GPC <i class="fa fa-graduation-cap" aria-hidden="true"></i> | نأسف لهذا الخطأ</small></p>
      </h1>
      @if(Session::has('flash_message'))
      <div class="alert alert-danger text-center">
        <strong>الخطأ ناتج عن :</strong> {{session::get('flash_message')}}
        <p class="text-left"><a title="ارسال الخطأ لمسؤول صيانة النظام" class="btn btn-warning" href=" mailto:mohammed.moath1@gmail.com?Subject=Message of error : {{session::get('flash_message')}}""><i class="fa fa-envelope-o"></i> ارسال الخطأ لمسؤول صيانة النظام </a></p>
      </div>
      @endif
      <p class="text-center"><a title="ذهاب للصفحة الرئيسية" class="btn btn-primary" href="/"><i class="fa fa-home"></i> ذهاب للصفحة الرئيسية</a></p>
      <!-- /page content -->

    </div>
  </div>
  <!-- jQuery -->
  {!! Html::script('js/jquery-3.2.1.min.js') !!}
  <!-- Bootstrap Core JavaScript -->
  {!! Html::script('js/bootstrap.min.js') !!}
  {!! Html::script('js/welcome.js') !!}
</body>

</html>