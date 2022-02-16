<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="img\graduationcap.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        GPC |
        كلية الحاسبات وتكنولوجيا المعلومات |
        جامعة العلوم والتكنولوجيا
    </title>
    <!-- Bootstrap Core CSS -->
    {{!! Html::style('css/bootstrap.css')!!}}
    <!-- Bootstrap Core CSS RTL-->
    {!! Html::style('css/bootstrap-rtl.css') !!}
    <!-- Font-Awesome -->
    {{!! Html::style('css/font-awesome.css')!!}}
    <!-- Custom CSS -->
    {{!! Html::style('css/welcome.css')!!}}

    <!-- Sweetalert -->
    {!! Html::style('css/sweetalert.css') !!}

    {!! Html::style('css/skitter.css') !!}



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body id="WelcomeBody">
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
                <a class="navbar-brand" href="{{ url('/') }}">GPC <i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav  navbar-left ">
                    @if(Auth::check() )
                    <li>
                        <a>مرحباً بك : {{ Auth::user()->Name }}</a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}">تسجيل الخروج <i class="fa fa-sign-out"></i></a>
                    </li>
                    @else
                    <li>
                        <a href="{{ url('/login') }}">دخول <i class="fa fa-sign-in"></i></a>
                    </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav  navbar-right ">
                    @if( Auth::check() && Auth::user()->Roles == 1)
                    <li>
                        <a href="{{ url('administrator/home')}}"><i class="fa fa-home"></i> الرئيسية</a>
                    </li>
                    @elseif( Auth::check() && Auth::user()->Roles == 2)
                    <li>
                        <a href="{{ url('home/GPCO')}}"><i class="fa fa-home"></i> الرئيسية</a>
                    </li>
                    @elseif( Auth::check() && Auth::user()->Roles == 3)
                    <li>
                        <a href="{{ url('home/student')}}"><i class="fa fa-home"></i> الرئيسية</a>
                    </li>
                    @elseif( Auth::check() && Auth::user()->Roles == 4)
                    <li>
                        <a href="{{ url('home/FacultyMember')}}"><i class="fa fa-home"></i> الرئيسية</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->

        </div>
        <!-- /.container -->

    </nav>
    <!-- Half Page Image Background Carousel Header -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <header id="myCarousel" class="carousel slide">
            <div class="skitter skitter-large with-dots">
                <ul>
                    <li>
                        <a href="#cut">
                            <img src="{{url('img/01.jpg')}}" class="cut" />
                        </a>
                        <div class="label_text">
                            <p>
                                البوابة الإلكترونية للجنة مشاريع التخرج
                                <a href="#see-more" class="btn btn-xs btn-warning">GPC</a>
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="#directionRight">
                            <img src="{{url('img/02.jpg')}}" class="directionRight" />
                        </a>
                        <div class="label_text">
                            <p>
                                البوابة الإلكترونية للجنة مشاريع التخرج
                                <a href="#see-more" class="btn btn-xs btn-primary">GPC</a>
                            </p>
                        </div>
                    </li>
                    <li>
                        <a href="#cubeSpread">
                            <img src="{{url('img/03.jpg')}}" class="cubeSpread" />
                        </a>
                        <div class="label_text">
                            <p>
                                البوابة الإلكترونية للجنة مشاريع التخرج
                                <a href="#see-more" class="btn btn-xs btn-danger">GPC</a>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
    </div>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="GPC col-lg-12 text-center" id="containerGPC">
                <p>جامعة العلوم والتكنولوجيا </p>
                <p>كلية الحاسبات وتكنولوجيا المعلومات</p>
                <h1>
                    البوابة الإلكترونية
                    <span id="GPC_Color"> للجنة مشاريع التخرج
                        <!--a href="{{ url('/login') }}" class="btn btn-success form-control" title="دخول"><strong>دخول</strong> <i class="fa fa-sign-in"></i></a-->
                    </span>
                </h1>

            </div>
            <!-- Footer -->
            <footer>
                <div class="col-lg-12 text-left">
                    <p>Copyright &copy; <strong> <i class="fa fa-graduation-cap" aria-hidden="true"></i>GPC-UST</strong> 2017-2018</p>
                </div>
            </footer>
        </div>
    </div>
    <!-- / Container -->


    <!-- jQuery -->
    {!! Html::script('js/jquery-3.2.1.min.js') !!}
    {!! Html::script('js/jquery-2.1.1.min.js') !!}
    {!! Html::script('js/jquery.easing.1.3.js') !!}
    {!! Html::script('js/jquery.skitter.min.js') !!}
    <!-- Bootstrap Core JavaScript -->


    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/welcome.js') !!}

    <!-- Sweetalert -->
    {!! Html::script('js/sweetalert.min.js') !!}
    {!! Html::script('js/sweetalert-dev.js') !!}

    <script>
        $(function() {
            $('.skitter-large').skitter();
        });
    </script>
    @include('layouts.Messag.messag')
</body>

</html>