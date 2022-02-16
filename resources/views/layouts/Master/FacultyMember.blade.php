<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        GPC
        |
      @yield('title')

    </title> 

    <!-- Bootstrap Core CSS -->
    {!! Html::style('css/bootstrap.css') !!}

    <!-- Bootstrap Core CSS RTL-->
    {!! Html::style('admin/css/bootstrap-rtl.css') !!}

    <!-- Custom CSS -->
    {!! Html::style('admin/css/FacultyMember.css') !!}
    {!! Html::style('css/style.css') !!}

    <!-- Custom Fonts -->
    {!! Html::style('css/font-awesome.css') !!}
     
    <!-- Sweetalert -->
    {!! Html::style('css/sweetalert.css') !!}
   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('header')

</head>

<body id="FacltyMemberBody">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                 <a class="navbar-brand" href="{{ url('/')}}">GPC <i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('home/FacultyMember')}}"><i class="fa fa-home"></i> الرئيسية</a>
                    </li>
                    <li>
                        <a title="مقترحاتي" href="{{ url('FacultyMember/my-proposal') }}"><i class="fa fa-lightbulb-o"></i> مقترحاتي</a>
                    </li>
                    <li>
                        <a title="طلابي"href="{{ url('FacultyMember/my-student/group') }}"> <i class="fa fa-group"></i> طلابي</a>
                    </li>    
                    <li>
                        <a title="اللقاءات"href="{{ url('FacultyMember/meetings') }}"><i class="fa fa-video-camera"></i>  اللقاءات</a> 
                    </li>
                    <li>
                        <a title="التسليمات"href="{{ url('FacultyMember/deliveries') }}"><i class="fa fa-book"></i>  التسليمات</a> 
                    </li>
                    <li>
                        <a title="التقييم"href="{{ url('FacultyMember/grades') }}"><i class="fa fa-check-square-o"></i> التقييم</a> 
                    </li>
                    <li>
                        <a title="أعتزال مهمة الاشراف"href="{{ url('#') }}"><span class="label label-danger">أعتزال مهمة الاشراف</span></a> 
                    </i>
                </ul>
                <ul class="nav navbar-nav navbar-left">    
                    @if(Auth::check()) 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    </li>
                    <li class="dropdown"> 
                        <a title="انقر لعرض المزيد" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="User-Profile">
                                <img title="{{ Auth::user()->username }}" class="img-rounded"  src="{{ asset(Auth::user()->PresonalPicture) }}" alt=" #">
                            </span>
                            {{ Auth::user()->Name }}
                            <span class="caret"></span>
                        </a>
                      <ul class="dropdown-menu">
                      <li>
                            <a href="{{ url('FacultyMember/x') }}"><i class="fa fa-fw fa-user"></i> صفحتي الشخصية</a>
                        </li>
                        <li role="separator" class="divider"></li>
                       <li>
                            <a href="{{ url('/logout')}}"><i class="fa fa-fw fa-power-off"></i> الخروج</a>
                        </li>
                      </ul>
                    </li>
                   
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
           <div class="col-md-8">
                    @yield('content')
           </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>عن ماذا تبحث ؟</h4>
                    <div class="input-group">
                    
                        <input type="text" class="form-control" placeholder=" أبحث هنا...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>خيارات GPC <i class="fa fa-graduation-cap" aria-hidden="true"></i></h4>
                    <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li>
                                        <a title="تقديم مقترح مشروع" href="{{ url('create/proposal/FacultyMember') }}"> تقديم مقترح مشروع</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li>
                                        <a title="مقترحات مشاريع التخرج" href="{{ url('all-proposals') }}">مقترحات مشاريع التخرج </a>        
                                    </li>
                                </ul>
                            </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>أخر اعلانات اللجنة <i class="fa fa-bullhorn"></i></h4>
                    <p>لا يوجد اى اعلانات جديدة</p>
                </div>

            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12 text-center">
                   <p>Copyright &copy; <strong> <i class="fa fa-graduation-cap" aria-hidden="true"></i>GPC-UST</strong> 2017-2018</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    {!! Html::script('js/jquery-3.2.1.min.js') !!}

    <!-- Bootstrap Core JavaScript -->
    {!! Html::script('js/bootstrap.min.js') !!}

    <!-- Morris Charts JavaScript -->
    {!! Html::script('admin/js/FacultyMember.js') !!}

    <!-- Sweetalert -->
    {!! Html::script('js/sweetalert.min.js') !!}
    {!! Html::script('js/sweetalert-dev.js') !!}
      
    @yield('footer')
    
    <!-- Sweet alert page -->
    @include('layouts.Messag.messag') 
</body>

</html>
