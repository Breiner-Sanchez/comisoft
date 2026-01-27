@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center p-0" style="background: #f8fafc;">
    <div class="row w-100 m-0 justify-content-center">
        <div class="col-12 col-md-8 col-lg-5 col-xl-4 animate__animated animate__zoomIn">
            <div class="card border-0 shadow-2xl rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/Sena_Logo.png') }}" alt="SENA" class="mb-4" style="width: 80px;">
                        <h3 class="fw-black tracking-tighter">Bienvenido de nuevo</h3>
                        <p class="text-muted small">Ingresa tus credenciales para acceder al sistema</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label-modern">Correo Electrónico</label>
                            <div class="input-group-modern @error('email') border-danger @enderror">
                                <i class="fas fa-envelope icon-left"></i>
                                <input id="email" type="email" class="form-control-modern" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nombre@correo.com">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-2 d-block fw-bold">
                                    <i class="fas fa-circle-exclamation me-1"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="password" class="form-label-modern mb-0">Contraseña</label>
                                @if (Route::has('password.request'))
                                    <a class="text-primary small fw-bold text-decoration-none" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>
                            <div class="input-group-modern @error('password') border-danger @enderror">
                                <i class="fas fa-lock icon-left"></i>
                                <input id="password" type="password" class="form-control-modern" name="password" required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="text-danger small mt-2 d-block fw-bold">
                                    <i class="fas fa-circle-exclamation me-1"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check custom-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small fw-bold text-muted" for="remember">
                                    Recordar mi sesión
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn-modern primary py-3 fs-6">
                                <i class="fas fa-right-to-bracket me-2"></i> Iniciar Sesión
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="small text-muted mb-0">ComiSoft v2.0 &bull; Sistema de Gestión de Actas</p>
                        </div>
                    </form>
                </div>
                <div class="bg-light p-4 text-center border-top">
                    <p class="small text-muted mb-0">¿No tienes una cuenta? <span class="text-primary fw-bold">Contacta al administrador</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.12);
    }

    .rounded-5 { border-radius: 2rem !important; }
    .fw-black { font-weight: 800; }
    .tracking-tighter { letter-spacing: -0.05em; }

    /* Modern Form Inputs */
    .form-label-modern {
        display: block;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
        font-size: 0.85rem;
        padding-left: 4px;
    }

    .input-group-modern {
        position: relative;
        background: #f8fafc;
        border-radius: 14px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s;
        overflow: hidden;
    }

    .input-group-modern:focus-within {
        background: #fff;
        border-color: #3b82f6;
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1);
    }

    .input-group-modern .icon-left {
        position: absolute;
        left: 18px;
        top: 15px;
        color: #94a3b8;
        transition: color 0.3s;
        z-index: 10;
    }

    .input-group-modern:focus-within .icon-left {
        color: #3b82f6;
    }

    .form-control-modern {
        width: 100%;
        padding: 12px 18px 12px 50px;
        background: transparent;
        border: none;
        font-weight: 500;
        color: #1e293b;
        outline: none;
        font-size: 0.95rem;
    }

    .btn-modern {
        padding: 12px 30px;
        border-radius: 14px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-modern.primary { background: #3b82f6; color: #fff; }
    .btn-modern:hover { transform: translateY(-2px); filter: brightness(1.1); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }

    .custom-check .form-check-input {
        width: 1.2em;
        height: 1.2em;
        margin-top: 0.2em;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Hide standard app sidebar/nav on login if needed, or adjust spacing */
    #app > nav { display: none; }
</style>
@endsection
