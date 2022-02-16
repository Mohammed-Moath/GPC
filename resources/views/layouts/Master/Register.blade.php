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
        GPC | 
        @yield('title')
        </title>

        <!-- Bootstrap Core CSS -->
        {!! Html::style('css/bootstrap.css') !!}
        {!! Html::style('css/bootstrap-rtl.css') !!}
        <!-- Font-Awesome -->
        {!! Html::style('css/font-awesome.css') !!}

        <!-- Sweetalert -->
        {!! Html::style('css/sweetalert.css') !!}

        <!-- My Style -->
        {!! Html::style('css/style.css') !!}

        @yield('style')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body id="Register">
        
        <content>
            <div class="container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </content>
       
            
        <footer id="footer-Register">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center" >
                        <p>Copyright &copy; <strong> <i class="fa fa-graduation-cap" aria-hidden="true"></i> GPC-UST</strong> 2017-2018</p>
                    </div>
                </div>
            </div>
            <!-- jQuery -->
            {!! Html::script('js/jquery-3.2.1.min.js') !!}

            <!-- Bootstrap Core JavaScript -->
            {!! Html::script('js/bootstrap.min.js') !!}

            <!-- Sweetalert -->
            {!! Html::script('js/sweetalert.min.js') !!}
            {!! Html::script('js/sweetalert-dev.js') !!}

            {!! Html::script('js/backend.js') !!} 

            @yield('footer')  
        </footer>
        @include('layouts.Messag.messag')
    </body>

</html>
