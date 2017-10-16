<!DOCTYPE html>
<html  lang="{{ config('app.locale') }}">
<head>
    <title>SIUG</title>
    <meta charset="utf-8">
    <meta name="description" content="Direccion de Gestion de Tecnologica de la Informacion" />
    <meta name="author" content="DGTI" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="images/favicon.ico" type="image/x-icon" rel="shortcut icon" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="/css/screen.css" rel="stylesheet" />
    <link href="/css/app.css" rel="stylesheet" />
    <link href="/css/ugCore.css" rel="stylesheet" />
    @yield('masterCssCustom')
</head>
<body class="home" id="page">
<div id="pageLoader">
    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
</div>
@include('components.errors')
<!-- Header -->
<header class="main-header">

    <div class="container">
        <div class="header-content">
            <div style="    background-color: #ffffff;
    border-radius: 50px;
    padding: 5px;
    text-align: center;
    width: 100px;">
                <a href="/">
                    <img src="/images/logo_.png" style="height: 85px;width: 80px;"/>
                </a>
            </div>
            <nav class="site-nav">
                @if (Auth::guest())
                    <a class="btn btn-outlined" href="{{ route('login') }}">INGRESO</a>&nbsp;
                    <a class="btn btn-outlined" href="{{ route('register') }}">REGISTRO</a>
                @endif
            </nav>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="content-box">
    <!-- Hero Section -->
    <section class="section section-hero">
        <div class="hero-box" style="@yield('paddingDefaultFront','')">
            <div class="container" style="text-align:center">
                @yield('mainContent')
            </div>
        </div>

        <!-- Statistics Box -->
        <div class="container">
            <div class="statistics-box">
                <div class="statistics-item" style="text-align:center;display:block">
                    <a target="_blank" href="https://www.facebook.com/UdeGuayaquil/">
                        <img src="/images/facebook.png" style="width:48px"/>
                        <p class="title">Facebook</p>
                    </a>
                </div>

                <div class="statistics-item" style="text-align:center;display:block">
                    <a target="_blank" href="https://www.instagram.com/universidad_de_guayaquil/">
                        <img src="/images/camera.png" style="width:48px"/>
                        <p class="title">Instagram</p>
                    </a>
                </div>

                <div class="statistics-item" style="text-align:center;display:block">
                    <a target="_blank" href="https://twitter.com/udeguayaquil?lang=es">
                        <img src="/images/twitter.png" style="width:48px"/>
                        <p class="title">Twitter</p>
                    </a>
                </div>


                <div class="statistics-item" style="text-align:center;display:block">
                    <a href="https://www.youtube.com/channel/UCNjcceqnaK8eqhQ8nE2U95w" target="_blank">
                        <img src="/images/youtube.png" style="width:48px"/>
                        <p class="title">Youtube</p>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Destinations Section -->

    <section class="section section-destination">
        <!-- Title -->
        <div class="section-title">
            <div class="container">
                <h2 class="title">@yield('sectionTitle','INFORMACI&Oacute;N ACAD&Eacute;MICA')</h2>
            </div>
        </div>

        <!-- Content -->
        <div class="container">
            <div class="row">
                @yield('sectionContent','')
            </div>
        </div>
    </section>




</div>

<!-- Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <br/>

                <br/>
                <div class="widget widget_links" style="color:white;text-align:center">
                    <h5 class="widget-title">Ubicaci&oacute;n</h5>
                    <p>Ciudadela Universitaria "Salvador Allende" | Av. Delta y Av. Kennedy | Casilla Postal 471 </p>
                </div>

                <br/>
                <div class="widget widget_links" style="color:white;text-align:center">
                    <p>Creado por la <a style="font-weight:bold" href="http://www.ug.edu.ec/Centro-de-Computo/index.php">DGTI</a> Universidad de Guayaquil
                        ©2017. Derechos Reservados <a style="font-weight:bold" href="http://www.ug.edu.ec">SIUG</a></p>
                </div>
            </div>



            <div class="col-md-8">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.9239132641487!2d-79.89985358560182!3d-2.1825647378752286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x902d727815ad5a9d%3A0x1d61939b42d442f!2sUniversidad+de+Guayaquil+(UG)!5e0!3m2!1ses!2sec!4v1494868206747" width="100%" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>

            </div>


        </div>

    </div>
</footer>


<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="{{ asset('js/modules/utils.js') }}"></script>
<script src="{{ asset('js/ugCore.js') }}"></script>
@yield('masterJsCustom')
<script type="text/javascript">

    @if (count($errors) > 0)
    var options = {
            "backdrop" : "static",
            "show":true
        }

    $('#modalerrors').modal(options);
    @endif
    $('.alert').not('.important').delay(5000).slideUp(350);
</script>
</body>
</html>