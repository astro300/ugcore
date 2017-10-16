<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | @yield('masterTitle')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ugCore.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('plugins/icomoon/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/notifications/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/notifications/pnotify.custom.min.css') }}">
@yield('masterCssCustom')

<!-- Theme style -->
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skin-blue.css') }}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="pageLoader">
    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
</div>
@include('components.errors')
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>IUG</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>UG</b>System</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown">
                        <a href="{{route('about')}}" class="dropdown-toggle" title="Acerca de">
                            <i class="fa fa-info-circle "></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="https://outlook.office.com" class="dropdown-toggle" title="Office365">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="https://onedrive.live.com/" class="dropdown-toggle" title="OnDrive">
                            <i class="fa fa-cloud"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="http://www.ug.edu.ec" class="dropdown-toggle" title="Universidad de Guayaquil">
                            <i class="fa fa-university"></i>
                        </a>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    @if(!Auth::guest())
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa  fa-user"></i>
                                <span class="hidden-xs"> {{ Auth::user()->email }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <i class="fa  fa-user fa-4x  fa-fw text-white"></i>
                                    <p>
                                        {{ Auth::user()->email }}
                                        <small>Fecha
                                            Craci&oacute;n: {{ Auth::user()->created_at->format('M d, Y') }}</small>
                                        <small>&Uacute;ltimo
                                            Acceso: {{ Auth::user()->last_login->diffForHumans() }}</small>

                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{route('admin.users.changePassword')}}"
                                           class="btn bg-red btn-flat margin">Cambiar Clave</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn bg-green btn-flat margin" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    <li>
                        <a data-toggle="control-sidebar" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="fa fa-power-off"></i></a>
                    </li>
                    @endif
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    @if(!Auth::guest())
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <i class="fa fa-user fa-3x text-white"></i>
                </div>
                <div class="pull-left info">

                        <p>{{ Auth::user()->first_name }}</p>

                    <a><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="{{route('search')}}" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            @component('components.menuviewcomposer')
            @endcomponent
        </section>

        <!-- /.sidebar -->
    </aside>
    @endif
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('masterTitleModule','Titulo de M&oacute;dulo')
                <small>(@yield('masterDescription','Descripci&oacute;n del M&oacute;dulo'))</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active" id="lbl_time"></li>
            </ol>
        </section>

        <div class="col-lg-10 col-lg-offset-1">
            <br/>
            {!! Messages::render() !!}
        </div>


        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                @yield('mainBox','')
            </div>
            <!-- /.row -->


            <div class="row">
                <br/>
                <div class="col-lg-12">
                @yield('mainContent','<b>Contenido</b>')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Versi&oacute;n</b> 1.0
        </div>
        <strong>Copyright &copy; 2017 <a target="_blank" href="http://www.ug.edu.ec">Direcci&oacute;n de Gesti&oacute;n
                Tecnol&oacute;gica de la Informaci&oacute;n</a>.</strong> Derechos Reservados Universidad de Guayaquil.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<script src="{{ asset('js/app.js') }}"></script>

@yield('masterJsCustom')

<script src="{{ asset('js/modules/utils.js') }}"></script>
<script src="{{ asset('js/ugCore.js') }}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('js/appLTE.min.js') }}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('plugins/notifications/pnotify.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/select2/i18n/es.js') }}"></script>
<script type="text/javascript">
            @if(!empty($errors))
            @if (count($errors) > 0)
                var options = {
                        "backdrop": "static",
                        "show": true
                    }

    $('#modalerrors').modal(options);
    @endif
    @endif
     $('[data-popup="tooltip"]').tooltip();
        $(".select2").select2({
            language: "es",
            width: '100%'
        });
    $('.alert').not('.important').delay(5000).slideUp(350);
    $("span[class='label label-info']").attr('style','background: #2b9568 !important;')
            console.log("%c¡Detente!", "font-family: ';Arial';, serif; font-weight: bold; color: red; font-size: 45px");
            console.log("%cEsta función del navegador está pensada para desarrolladores. Si alguien te indicó que copiaras y pegaras algo aquí para habilitar una función de UGCORE o para PIRATEAR la cuenta de alguien, se trata de un fraude.", "font-family: ';Arial';, serif; color: black; font-size: 20px");
            console.log("%cSi lo haces, esta persona podrá acceder a tu cuenta y datos personales.", "font-family: ';Arial';, serif; color: black; font-size: 20px");


</script>

</body>
</html>
