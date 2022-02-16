<!DOCTYPE html>
<html lang="ar">

<head>

    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
       GPC | لوحة تحكم لجنة المشاريع

        |
      @yield('title')
    </title>

    <!-- Bootstrap Core CSS -->
    {!! Html::style('admin/css/bootstrap.css') !!}


    <!-- Bootstrap Core CSS RTL-->
    {!! Html::style('admin/css/bootstrap-rtl.css') !!}

    <!-- Custom CSS -->
    {!! Html::style('admin/css/sb-admin.css') !!}
    {!! Html::style('admin/css/sb-admin-rtl.css') !!}

    {!! Html::style('admin/css/GPCO.css') !!}
    {!! Html::style('css/style.css') !!}

    <!-- Morris Charts CSS -->
    {!! Html::style('admin/css/plugins/morris.css') !!}

    <!-- Custom Fonts -->
    {!! Html::style('admin/font-awesome/css/font-awesome.min.css') !!}
   
    <!-- Sweetalert -->
    {!! Html::style('css/sweetalert.css') !!}

    @yield('header')


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="GPCOBody">

    <div id="wrapper">

         <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/')}}">GPC <i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
                </div>
                <!-- Top Menu Items -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ url('home/GPCO')}}"><i class="fa fa-home"></i> الرئيسية</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-right top-nav">
                        @if(Auth::check())
                           
                            <li class="dropdown">
                                <a title="انقر لعرض المزيد" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="User-Profile">
                                        <img title="{{ Auth::user()->username }}" class="img-rounded"  src="{{ asset(Auth::user()->PresonalPicture) }}" alt=" #">
                                    </span>
                                    {{ Auth::user()->username }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ url('GPCO/X') }}"><i class="fa fa-fw fa-user"></i> صفحتي الشخصية</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('GPCO/X') }}"><i class="fa fa-wrench"></i> الاعدادات</a>
                                    </li>  
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout')}}"><i class="fa fa-fw fa-power-off"></i> الخروج</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Settings"><i class="fa fa-gear"></i> التهيئة<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Settings" class="collapse">
                            <li>
                                <a href="{{ url('configuration/conditions')}}"><i class="fa fa-minus"></i>  الشروط</a>
                            </li>
                            <li>
                                <a href="{{ url('configuration/grades')}}"><i class="fa fa-minus"></i> الدرجات</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Appointments"><i class="fa fa-clock-o"></i> المواعيد<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Appointments" class="collapse">
                            <li>
                                <a href="{{ url('appointments/deliveries')}}"><i class="fa fa-minus"></i> التسليمات</a>
                            </li>
                        </ul>
                        <hr>
                    </li>
                    <li> 
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-file-text-o"></i>  المقترحات <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href=" {{ url('Proposal/create')}}"><i class="fa fa-plus-circle"></i> أضافة مقترح مشروع</a>
                            </li>
                            <li>
                                <a href="{{url('Proposal')}}"><i class="fa fa-repeat"></i> أدارة المقترحات </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a title="مجموعات مشاريع التخرج" href="javascript:;" data-toggle="collapse" data-target="#ProjectGroups"><i class="fa fa-group"></i> المجموعات   <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ProjectGroups" class="collapse">
                            <li>
                                <a title="أدارة المجموعات" href="{{url('manage/groups')}}"><i class="fa fa-repeat"></i> أدارة المجموعات</a>
                            </li>
                            <li>
                                <a title="متابعة المجموعات" href="{{ url('follow/groups') }}"><i class="fa fa-eye"></i> متابعة المجموعات </a>
                            </li>
                        </ul>
                        <hr>
                    </li>

                    <li>
                        <a href="{{ url('GPCO/grades')}}" title=" الدرجات "><i class="fa fa-check-square-o"></i> الدرجات</a>
                    </li>
                    
                    <li>
                        <a href="{{url('GPCO/X')}}"><i class="fa fa-book"></i> المشاريع المنجزة </a>
                        <hr>
                    </li>
                 

                    <li>
                        <a href="{{ url('students-data') }}" title=" بيانات الطلاب "><i class="fa fa-bar-chart"></i> بيانات الطلاب </a>
                    </li>
                    
                    <li>
                        <a href="{{ url('supervisors-data')}}" title=" بيانات المشرفين "><i class="fa fa-bar-chart"></i> بيانات المشرفين</a>
                    </li>

                    <li>
                        <a href="{{url('GPCO/X')}}"><i class="fa fa-pie-chart"></i> تقارير</a>
                    </li>
                   
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        @yield('content')
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    {!! Html::script('admin/js/jquery.js') !!}

    <!-- Bootstrap Core JavaScript -->
    {!! Html::script('admin/js/bootstrap.min.js') !!}

    <!-- Morris Charts JavaScript -->
    <!--
    {!! Html::script('admin/js/plugins/morris/raphael.min.js') !!}
    {!! Html::script('admin/js/plugins/morris/morris.min.js') !!}
    {!! Html::script('admin/js/plugins/morris/morris-data.js') !!}-->
    {!! Html::script('admin/js/GPCO.js') !!}

    <!-- Sweetalert -->
    {!! Html::script('js/sweetalert.min.js') !!}
    {!! Html::script('js/sweetalert-dev.js') !!}
    {!! Html::script('js/backend.js') !!}
      
    @yield('footer')
    
    <!-- Sweet alert page -->

    @include('layouts.Messag.messag')

      
</body>

</html>
