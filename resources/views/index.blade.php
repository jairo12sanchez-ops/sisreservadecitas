<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Sistema de reserva de citas odontologicas</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <head>
        <style>
            .welcome h1,
            .welcome p {
                color: #000000;      /* texto más oscuro */
                font-weight: 700;    /* más grueso */
            }
        </style>
    </head>


    <!-- =======================================================
    * Template Name: Medilab
    * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="index-page">

<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto">
                <!-- Logo de la clínica -->
                <img src="{{asset('assets/img/logo_odoes.jpeg')}}" alt="JasaDent Logo" style="max-height: 100px; padding: 10px; background-color: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
            </a>

            <nav id="navmenu" class="navmenu">
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="cta-btn d-none d-sm-block" href="{{url('login')}}">Ingresar</a>

        </div>

    </div>

</header>

<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

        <img src="assets/img/imagenes de dentistas.jpg" alt="" data-aos="fade-in">

        <div class="container position-relative">

            <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
                <h1 class="welcome-text" style="font-size: 60px; color: white;">Bienvenido </h1>
                <p class="welcome-text" style="font-size: 50px; color: white;">Al Centro de Atencion de Citas De La Clinica ODOES</p>
            </div><!-- End Welcome -->

            <div class="content row gy-4">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
                        <h3>Reserva tu Cita Odontologica?</h3>
                        <div class="text-center">
                            <a href="{{url('/admin')}}" class="more-btn"><span>Reservar Ahora</span> <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div><!-- End Why Box -->
            </div><!-- End  Content-->

        </div>

    </section><!-- /Hero Section -->

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Calendario De Atención De Doctores</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="consultorio_id">Consultorios</label>
                                <select name="consultorio_id" id="consultorio_select" class="form-control">
                                    @foreach($consultorios as $consultorio)
                                        <option value="{{ $consultorio->id }}">
                                            {{ $consultorio->nombre . ' - ' . $consultorio->ubicacion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <script>
                            $('#consultorio_select').on('change',function () {
                                var consultorio_id = $('#consultorio_select').val();
                                //(consultorio_id);

                                if(consultorio_id){
                                    $.ajax({
                                        url: "{{url('/consultorios/')}}"  + '/' +consultorio_id,
                                        type:'GET',
                                        success: function (data){
                                            $('#consultorio_info').html(data);
                                        },
                                        error: function (){
                                            alert('Error al obtener los datos del consultorio');
                                        }
                                    });
                                }else{
                                    $('#consultorio_info').html('');
                                }
                            });
                        </script>
                        <hr>
                        <div id="consultorio_info">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    @if($configuracion)
    <section id="contact" class="contact section" style="background-color: #f8f9fa; padding: 60px 0;">
        <div class="container">
            <div class="section-title text-center mb-5" data-aos="fade-up">
                <h2 style="color: #2c4964; font-weight: 700; font-size: 32px;">Información de Contacto</h2>
                <p style="color: #6c757d; font-size: 16px;">Estamos aquí para atenderte</p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-item d-flex flex-column align-items-center text-center" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                        <i class="bi bi-building" style="font-size: 48px; color: #3fbbc0; margin-bottom: 15px;"></i>
                        <h3 style="font-size: 18px; font-weight: 600; color: #2c4964; margin-bottom: 10px;">Nombre</h3>
                        <p style="color: #6c757d; margin: 0;">{{ $configuracion->nombre }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="info-item d-flex flex-column align-items-center text-center" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                        <i class="bi bi-geo-alt" style="font-size: 48px; color: #3fbbc0; margin-bottom: 15px;"></i>
                        <h3 style="font-size: 18px; font-weight: 600; color: #2c4964; margin-bottom: 10px;">Dirección</h3>
                        <p style="color: #6c757d; margin: 0;">{{ $configuracion->direccion }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="info-item d-flex flex-column align-items-center text-center" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                        <i class="bi bi-telephone" style="font-size: 48px; color: #3fbbc0; margin-bottom: 15px;"></i>
                        <h3 style="font-size: 18px; font-weight: 600; color: #2c4964; margin-bottom: 10px;">Teléfono</h3>
                        <p style="color: #6c757d; margin: 0;">{{ $configuracion->telefono }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="info-item d-flex flex-column align-items-center text-center" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                        <i class="bi bi-envelope" style="font-size: 48px; color: #3fbbc0; margin-bottom: 15px;"></i>
                        <h3 style="font-size: 18px; font-weight: 600; color: #2c4964; margin-bottom: 10px;">Correo</h3>
                        <p style="color: #6c757d; margin: 0; word-break: break-word;">{{ $configuracion->correo }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End Contact Section -->

</main>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
