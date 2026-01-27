@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-5 px-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <!-- Header -->
            <div class="text-center mb-5 animate__animated animate__fadeIn">
                <h1 class="fw-black tracking-tighter mb-2">Editar Ficha</h1>
                <p class="text-muted">Actualiza los detalles del programa de formación.</p>
            </div>

            <!-- Main Card -->
            <div class="card border-0 shadow-2xl rounded-5 overflow-hidden animate__animated animate__fadeInUp">
                <div class="card-header border-0 py-4 px-5 bg-warning bg-gradient d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                        <i class="fas fa-pen-to-square fs-3 text-white"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 text-white fw-bold tracking-tight">Modificar Información</h4>
                        <p class="text-white-50 mb-0 small">Editando ficha #{{ $ficha->numero }}</p>
                    </div>
                </div>

                <div class="card-body p-5 bg-white">
                    <form action="{{ route('fichas.update', $ficha) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-modern">Número de Ficha *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-hashtag icon-left"></i>
                                    <input type="text" name="numero" class="form-control-modern @error('numero') is-invalid @enderror" 
                                           value="{{ old('numero', $ficha->numero) }}" placeholder="Ej: 231231" required autofocus>
                                    <div class="focus-line"></div>
                                </div>
                                @error('numero')
                                    <div class="text-danger small mt-2 animate__animated animate__headShake">
                                        <i class="fas fa-circle-exclamation me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label-modern">Programa de Formación *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-graduation-cap icon-left"></i>
                                    <input type="text" name="programa" class="form-control-modern @error('programa') is-invalid @enderror" 
                                           value="{{ old('programa', $ficha->programa) }}" placeholder="Ej: Gestión Agroempresarial" required>
                                    <div class="focus-line"></div>
                                </div>
                                @error('programa')
                                    <div class="text-danger small mt-2 animate__animated animate__headShake">
                                        <i class="fas fa-circle-exclamation me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 d-flex justify-content-between align-items-center">
                            <a href="{{ route('fichas.index') }}" class="btn-modern secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn-modern warning px-5">
                                <i class="fas fa-rotate me-2"></i> Actualizar Ficha
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
        background-color: #f1f5f9;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .fw-black { font-weight: 800; }
    .tracking-tighter { letter-spacing: -0.05em; }
    .tracking-tight { letter-spacing: -0.025em; }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.12);
    }

    .rounded-5 { border-radius: 2rem !important; }

    /* Modern Form Controls */
    .form-label-modern {
        font-weight: 700;
        font-size: 0.85rem;
        color: #475569;
        margin-bottom: 0.75rem;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .input-group-modern {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-group-modern .icon-left {
        position: absolute;
        left: 1.25rem;
        color: #94a3b8;
        transition: color 0.3s ease;
        z-index: 10;
    }

    .form-control-modern {
        width: 100%;
        padding: 1rem 1rem 1rem 3.25rem;
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 1rem;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.3s ease;
    }

    .form-control-modern:focus {
        outline: none;
        background-color: #fff;
        border-color: #f59e0b;
    }

    .form-control-modern:focus + .focus-line {
        width: 100%;
    }

    .input-group-modern:focus-within .icon-left {
        color: #f59e0b;
    }

    .focus-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: #f59e0b;
        transition: width 0.3s ease;
        border-radius: 0 0 1rem 1rem;
    }

    /* Modern Buttons */
    .btn-modern {
        padding: 0.875rem 1.5rem;
        border-radius: 1rem;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .btn-modern.warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.2);
    }

    .btn-modern.warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);
    }

    .btn-modern.secondary {
        background-color: #f1f5f9;
        color: #475569;
    }

    .btn-modern.secondary:hover {
        background-color: #e2e8f0;
        color: #1e293b;
    }
</style>
@endsection
