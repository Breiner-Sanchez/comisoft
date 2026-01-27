@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center p-0" style="background: #f8fafc;">
    <div class="row w-100 m-0 justify-content-center">
        <div class="col-12 col-md-8 col-lg-5 col-xl-4 animate__animated animate__zoomIn">
            <div class="card border-0 shadow-2xl rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-block mb-4">
                            <i class="fas fa-lock-open fs-3 text-primary"></i>
                        </div>
                        <h3 class="fw-black tracking-tighter">Nueva Contraseña</h3>
                        <p class="text-muted small">Establece tu nueva contraseña de acceso</p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-4">
                            <label for="email" class="form-label-modern">Correo Electrónico</label>
                            <div class="input-group-modern @error('email') border-danger @enderror">
                                <i class="fas fa-envelope icon-left"></i>
                                <input id="email" type="email" class="form-control-modern" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <span class="text-danger small mt-2 d-block fw-bold">
                                    <i class="fas fa-circle-exclamation me-1"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label-modern">Contraseña</label>
                            <div class="input-group-modern @error('password') border-danger @enderror">
                                <i class="fas fa-lock icon-left"></i>
                                <input id="password" type="password" class="form-control-modern" name="password" required autocomplete="new-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="text-danger small mt-2 d-block fw-bold">
                                    <i class="fas fa-circle-exclamation me-1"></i> {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label-modern">Confirmar Contraseña</label>
                            <div class="input-group-modern">
                                <i class="fas fa-shield-check icon-left"></i>
                                <input id="password-confirm" type="password" class="form-control-modern" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn-modern primary py-3 fs-6">
                                <i class="fas fa-rotate me-2"></i> Restablecer Contraseña
                            </button>
                        </div>
                    </form>
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

    /* Hide standard app sidebar/nav on these pages */
    #app > nav { display: none; }
</style>
@endsection
