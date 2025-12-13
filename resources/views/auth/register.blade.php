<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Citas Odontológicas</title>

    <!-- Fuentes y estilos -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
</head>
<body class="hold-transition register-page"
      style="background-image: url('{{ asset('assets/img/about.jpg') }}');
             background-repeat: no-repeat;
             background-size: 100vw 100vh;
             background-attachment: fixed;">

<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>JasaDent</b></a>
        </div>

        <div class="card-body">
            <p class="login-box-msg"><b>Registro de Usuario</b></p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- NOMBRE --}}
                <div class="input-group mb-3">
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}"
                           placeholder="Nombre" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="input-group mb-3">
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}"
                           placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="input-group mb-3">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="contraseña" placeholder="contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- CONFIRMAR PASSWORD --}}
                <div class="input-group mb-3">
                    <input id="password-confirm" type="password"
                           class="form-control"
                           name="password_confirmation"
                           placeholder="Confirmar contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                {{-- BOTÓN --}}
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-0 text-center">
                <a href="{{ route('login') }}" class="text-center">¿Ya tienes cuenta? Inicia sesión</a>
            </p>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>
</html>
