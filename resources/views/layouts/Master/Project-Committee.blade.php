<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="{{ asset('img\graduationcap.png') }}" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>
    لجنة المشاريع |
    @yield('title')
  </title>
  <!-- Bootstrap core CSS-->
  {!! Html::style('Templates/Shared-files/css/bootstrap.css') !!}

  <!-- Bootstrap rtl-->
  {!! Html::style('Templates/Management/css/bootstrap-rtl.css') !!}

  <!-- Custom fonts for this template-->
  {!! Html::style('Templates/Shared-files/css/font-awesome.min.css') !!}

  <!-- Sweetalert -->
  {!! Html::style('Templates/Shared-files/css/sweetalert.css') !!}

  <!-- Custom styles for this template-->
  {!! Html::style('Templates/Management/css/sb-admin.css') !!}
  {!! Html::style('Templates/Shared-files/css/Project-Committee.css') !!}

  @yield('header')
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">G<span style="color:red;">p</span>C <i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="التهيئة">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseConfiguration" data-parent="#exampleAccordion">
              <i class="fa fa-gear"></i>
              <span class="nav-link-text">التهيئة</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseConfiguration">
              <li>
                <a href="{{ url('project-committee/configuration/constraint') }}"> قيود</a>
              </li>
              <li>
                <a href="{{ url('project-committee/configuration/grades')}}"> درجات</a>
              </li>
            </ul>
          </li>
          <li class="nav-item border-nav-bottom" data-toggle="tooltip" data-placement="right" title="التقويم">
            <a class="nav-link" href="{{ url('project-committee/calendar') }}">
              <i class="fa fa-calendar"></i>
              <span class="nav-link-text">التقويم</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="المقترحات">
            <a class="nav-link" href="{{ url('project-committee/proposal') }}">
              <i class="fa fa-file-powerpoint-o"></i>
              <span class="nav-link-text">المقترحات</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="المجموعات">
            <a class="nav-link" href="{{ url('project-committee/groups') }}">
              <i class="fa fa-group"></i>
              <span class="nav-link-text">المجموعات</span>
            </a>
          </li>
          <li class="nav-item border-nav-bottom" data-toggle="tooltip" data-placement="right" title="إقرار المشاريع">
            <a class="nav-link" href="{{ url('project-committee/approval-projects') }}">
              <i class="fa fa-legal"></i>
              <span class="nav-link-text">إقرار المشاريع</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="المتابعة">
            <a class="nav-link" href="{{ url('project-committee/follow') }}">
              <i class="fa fa-eye"></i>
              <span class="nav-link-text">المتابعة</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="البيانات">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#date" data-parent="#exampleAccordion">
              <i class="fa fa-bar-chart"></i>
              <span class="nav-link-text">البيانات</span>
            </a>
            <ul class="sidenav-second-level collapse" id="date">
              <li>
                <a href="{{ url('project-committee/data/students') }}">بيانات الطلبة </a>
              </li>
              <li>
                <a href="{{ url('project-committee/data/supervisors')}}"> بيانات المشرفين </a>
              </li>
            </ul>
          </li>
          <li class="nav-item border-nav-bottom" data-toggle="tooltip" data-placement="right" title="التقارير">
            <a class="nav-link" href="{{ url('project-committee/reports') }}">
              <i class="fa fa-pie-chart"></i>
              <span class="nav-link-text">التقارير</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="التخريج">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#graduation" data-parent="#exampleAccordion">
              <i class="fa fa-check-square-o"></i>
              <span class="nav-link-text">التخريج</span>
            </a>
            <ul class="sidenav-second-level collapse" id="graduation">
              <li>
                <a href="{{ url('under-construction') }}"> رصد الدرجات</a>
              </li>
              <li>
                <a href="{{ url('under-construction')}}"> إنهاء تقويم</a>
              </li>
            </ul>
          </li>
        </ul>

        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>

        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('home/GPCO')}}">
              <i class="fa fa-home "></i> الرئيسية</a>
          </li>
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
              <div class="input-group">
                <input class="form-control" type="text" placeholder="البحث...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-envelope"></i>
              <span class="d-lg-none">Messages
                <span class="badge badge-pill badge-primary">12 New</span>
              </span>
              <span class="indicator text-primary d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">الرسائل الجديدة : </h6>
              <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <strong>David Miller</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <strong>Jane Smith</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <strong>John Doe</strong>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
              </a>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item small" href="#">View all messages</a> -->
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-bell"></i>
              <span class="d-lg-none">Alerts
                <span class="badge badge-pill badge-warning">6 New</span>
              </span>
              <span class="indicator text-warning d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">التنبيهات الجديدة :</h6>
              <!--<div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <span class="text-success">
                  <strong>
                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <span class="text-danger">
                  <strong>
                    <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <span class="text-success">
                  <strong>
                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item small" href="#">View all alerts</a> -->
            </div>
          </li>
          @if(Auth::check())
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="user-profile">
                <img title="{{ Auth::user()->username }}" class="rounded-right" src="{{ asset(Auth::user()->PresonalPicture) }}" alt=" #">
              </span>
              {{ Auth::user()->username }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href=" {{ url('/under-construction')}}"><i class="fa fa-fw fa-user"></i> صفحتي الشخصية</a>
              <a class="dropdown-item" href="{{ url('/under-construction')}}"><i class="fa fa-wrench"></i> الاعدادات</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ url('/logout')}}"><i class="fa fa-fw fa-sign-out"></i>تسجيل الخروج</a></a>
            </div>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      @yield('content')
    </div>
    <!-- /.container-fluid-->
    <footer class="sticky-footer ">
      <div class="container">
        <div class="text-center">

          <small>Copyright © <strong> <i class="fa fa-graduation-cap" aria-hidden="true"></i>G<span style="color:red;">p</span>C-UST</strong> 2017-2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- jQuery -->
    {!! Html::script('Templates/Shared-files/js/jquery.min.js') !!}

    <!-- Bootstrap core JavaScript-->
    {!! Html::script('Templates/Shared-files/js/bootstrap.bundle.min.js') !!}


    <!-- Core plugin JavaScript-->
    {!! Html::script('Templates/Shared-files/js/jquery.easing.min.js') !!}


    <!-- Sweetalert -->
    {!! Html::script('Templates/Shared-files/js/sweetalert.min.js') !!}

    <!-- Custom scripts for all pages-->
    {!! Html::script('Templates/Management/js/sb-admin.min.js') !!}
    {!! Html::script('Templates/Shared-files/js/Project-Committee.js') !!}
    @yield('footer')

    <!-- Sweet alert page -->
    @include('layouts.Messag.messag')

  </div>
  <!-- /.content-wrapper-->
</body>

</html>