@extends('layouts.app')

@section('content')
<!-- Add Animate.css for smooth transitions -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <!-- Dynamic Progress Tracker -->
            <div class="mb-4 animate__animated animate__fadeInDown">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small fw-bold">PROGRESO DEL REGISTRO</span>
                    <span id="progress-text" class="text-primary small fw-bold">0%</span>
                </div>
                <div class="progress" style="height: 8px; border-radius: 10px; background-color: #e9ecef;">
                    <div id="form-progress" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                         role="progressbar" style="width: 0%; border-radius: 10px; transition: width 0.5s ease;"></div>
                </div>
            </div>

            <div class="card border-0 shadow-2xl animate__animated animate__fadeInUp" style="border-radius: 20px; overflow: hidden;">
                <!-- Premium Header -->
                <div class="card-header border-0 py-4 px-4 px-md-5" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-1 text-white fw-extrabold tracking-tight">
                                <i class="fas fa-user-astronaut me-2 animate__animated animate__pulse animate__infinite"></i> 
                                Nuevo Aprendiz
                            </h4>
                            <p class="text-white-50 mb-0 small">Complete la información para vincularlo a la ficha</p>
                        </div>
                        <div class="col-auto">
                            <div class="bg-white bg-opacity-10 p-2 rounded-3 text-center border border-white border-opacity-25 shadow-sm">
                                <div class="text-white-50 small fw-bold text-uppercase" style="font-size: 0.65rem;">Ficha</div>
                                <div class="text-white fw-bold">{{ $ficha->numero }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('fichas.aprendices.store', $ficha) }}" method="POST" id="apprentice-form">
                        @csrf

                        <div class="row g-4">
                            <!-- Input Field Component -->
                            <div class="col-md-6 form-group-dynamic">
                                <label class="form-label-custom">Identificación</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-id-card icon-left"></i>
                                    <input type="text" name="identificacion" 
                                           class="form-control-modern @error('identificacion') is-invalid @enderror" 
                                           placeholder="Número de documento"
                                           value="{{ old('identificacion') }}" required>
                                    <div class="focus-line"></div>
                                </div>
                                @error('identificacion')
                                    <div class="text-danger mt-1 small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group-dynamic">
                                <label class="form-label-custom">Nombres</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-user icon-left"></i>
                                    <input type="text" name="nombre" 
                                           class="form-control-modern @error('nombre') is-invalid @enderror" 
                                           placeholder="Nombres completos"
                                           value="{{ old('nombre') }}" required>
                                    <div class="focus-line"></div>
                                </div>
                                @error('nombre')
                                    <div class="text-danger mt-1 small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group-dynamic">
                                <label class="form-label-custom">Apellidos</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-signature icon-left"></i>
                                    <input type="text" name="apellidos" 
                                           class="form-control-modern @error('apellidos') is-invalid @enderror" 
                                           placeholder="Apellidos completos"
                                           value="{{ old('apellidos') }}">
                                    <div class="focus-line"></div>
                                </div>
                                @error('apellidos')
                                    <div class="text-danger mt-1 small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group-dynamic">
                                <label class="form-label-custom">Celular</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-mobile-alt icon-left"></i>
                                    <input type="text" name="celular" 
                                           class="form-control-modern @error('celular') is-invalid @enderror" 
                                           placeholder="Ej: 300 123 4567"
                                           value="{{ old('celular') }}">
                                    <div class="focus-line"></div>
                                </div>
                                @error('celular')
                                    <div class="text-danger mt-1 small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group-dynamic">
                                <label class="form-label-custom">Correo Institucional</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-at icon-left"></i>
                                    <input type="email" name="email" 
                                           class="form-control-modern @error('email') is-invalid @enderror" 
                                           placeholder="correo@sena.edu.co"
                                           value="{{ old('email') }}" required>
                                    <div class="focus-line"></div>
                                </div>
                                @error('email')
                                    <div class="text-danger mt-1 small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group-dynamic">
                                <label class="form-label-custom">Estado Académico</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-toggle-on icon-left"></i>
                                    <select name="estado" class="form-select-modern @error('estado') is-invalid @enderror" required>
                                        <option value="" selected disabled>Seleccione estado</option>
                                        <option value="En Formacion" {{ old('estado') == 'En Formacion' ? 'selected' : '' }}>En Formación</option>
                                        <option value="Condicionado" {{ old('estado') == 'Condicionado' ? 'selected' : '' }}>Condicionado</option>
                                        <option value="Retiro Voluntario" {{ old('estado') == 'Retiro Voluntario' ? 'selected' : '' }}>Retiro Voluntario</option>
                                        <option value="Cancelado" {{ old('estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                    <div class="focus-line"></div>
                                </div>
                                @error('estado')
                                    <div class="text-danger mt-1 small"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-5 pt-4 d-flex flex-column flex-md-row gap-3 justify-content-end border-top border-light">
                            <a href="{{ route('fichas.show', $ficha) }}" class="btn-modern secondary order-2 order-md-1">
                                <i class="fas fa-arrow-left me-2"></i> Volver
                            </a>
                            <button type="submit" class="btn-modern primary order-1 order-md-2">
                                <i class="fas fa-rocket me-2"></i> Registrar Aprendiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f0f2f5;
    }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
    }

    /* Custom Modern Inputs */
    .form-group-dynamic {
        position: relative;
    }

    .form-label-custom {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        margin-bottom: 0.5rem;
        display: block;
        transition: color 0.3s ease;
    }

    .input-group-modern {
        position: relative;
        display: flex;
        align-items: center;
        background: #f9fafb;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
    }

    .input-group-modern:focus-within {
        background: #ffffff;
        box-shadow: 0 10px 15px -3px rgba(78, 115, 223, 0.1);
    }

    .input-group-modern .icon-left {
        position: absolute;
        left: 16px;
        color: #9ca3af;
        transition: color 0.3s ease;
        z-index: 10;
    }

    .input-group-modern:focus-within .icon-left {
        color: #4e73df;
    }

    .form-control-modern, .form-select-modern {
        width: 100%;
        padding: 12px 16px 12px 48px;
        background: transparent;
        border: none;
        border-radius: 12px;
        font-weight: 500;
        color: #1f2937;
        outline: none;
        font-size: 0.95rem;
    }

    .focus-line {
        position: absolute;
        bottom: -2px;
        left: 50%;
        width: 0;
        height: 2px;
        background: #4e73df;
        transition: all 0.4s ease;
        transform: translateX(-50%);
    }

    .input-group-modern:focus-within .focus-line {
        width: 100%;
    }

    /* Buttons */
    .btn-modern {
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-modern.primary {
        background: #4e73df;
        color: white;
        box-shadow: 0 4px 6px -1px rgba(78, 115, 223, 0.2);
    }

    .btn-modern.primary:hover {
        background: #224abe;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(78, 115, 223, 0.3);
    }

    .btn-modern.secondary {
        background: #f3f4f6;
        color: #4b5563;
    }

    .btn-modern.secondary:hover {
        background: #e5e7eb;
        color: #1f2937;
    }

    /* Progress bar animation pulse */
    .progress-bar-animated {
        animation: progress-bar-stripes 1s linear infinite, pulse-bg 2s infinite;
    }

    @keyframes pulse-bg {
        0% { opacity: 1; }
        50% { opacity: 0.8; }
        100% { opacity: 1; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('apprentice-form');
        const inputs = form.querySelectorAll('input[required], select[required]');
        const progressBar = document.getElementById('form-progress');
        const progressText = document.getElementById('progress-text');

        function updateProgress() {
            let filled = 0;
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    filled++;
                }
            });
            const percent = Math.round((filled / inputs.length) * 100);
            progressBar.style.width = percent + '%';
            progressText.innerText = percent + '%';
            
            // Color feedback
            if(percent < 50) progressBar.className = 'progress-bar bg-danger';
            else if(percent < 100) progressBar.className = 'progress-bar bg-warning';
            else progressBar.className = 'progress-bar bg-success';
        }

        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
            input.addEventListener('change', updateProgress);
        });

        // Initialize progress
        updateProgress();
    });
</script>@endsection
