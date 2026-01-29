@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-5">
    <!-- Header / Actions Bar -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded-4 shadow-sm border animate__animated animate__fadeInDown">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="fas fa-file-signature text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Detalle de Solicitud</h5>
                        <p class="text-muted mb-0 small">ID: #{{ $solicitud->id }} | Estado: 
                            <span class="status-pill-small {{ $solicitud->estado }}">
                                {{ ucfirst($solicitud->estado) }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-light rounded-3 border">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    @if($solicitud->estado == 'pendiente' && Auth::user()->isCoordinacion())
                    <form action="{{ route('solicitudes.reject', $solicitud) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded-3 px-4 fw-bold" onclick="return confirm('¿Está seguro de rechazar esta solicitud?')">
                            <i class="fas fa-times-circle me-1"></i> Rechazar
                        </button>
                    </form>
                    @endif
                    @if($solicitud->estado == 'pendiente')
                    <a href="{{ route('actas.create.solicitud', $solicitud) }}" class="btn btn-primary rounded-3 px-4 shadow-sm fw-bold">
                        <i class="fas fa-file-medical me-1"></i> Generar Acta de Comité
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-2xl rounded-5 overflow-hidden animate__animated animate__fadeInUp">
                <div class="card-body p-0">
                    <!-- Top Section: Requester Info -->
                    <div class="p-5 border-bottom bg-slate-50">
                        <h6 class="text-uppercase fw-black text-primary mb-4 letter-spacing-1">
                            <i class="fas fa-user-tie me-2"></i>Información del Solicitante
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Nombre Completo</label>
                                <p class="fs-5 fw-bold text-slate-800 mb-0">{{ $solicitud->reportado_por }}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Correo Electrónico</label>
                                <p class="fs-5 text-slate-700 mb-0">{{ $solicitud->correo_reporte }}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Teléfono</label>
                                <p class="fs-5 text-slate-700 mb-0">{{ $solicitud->telefono_reporte ?? 'No proporcionado' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Middle Section: Program & Apprentice Info -->
                    <div class="p-5 border-bottom">
                        <h6 class="text-uppercase fw-black text-primary mb-4 letter-spacing-1">
                            <i class="fas fa-graduation-cap me-2"></i>Programa y Aprendiz
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-light border-start border-4 border-primary">
                                    <label class="text-muted small fw-bold text-uppercase d-block mb-2">Programa de Formación</label>
                                    <p class="fs-4 fw-black text-slate-900 mb-1">{{ $solicitud->programa }}</p>
                                    <div class="d-flex gap-3">
                                        <span class="badge bg-white text-primary border rounded-pill px-3 py-2">Ficha: {{ $solicitud->ficha_numero }}</span>
                                        <span class="badge bg-white text-primary border rounded-pill px-3 py-2">Tipo: {{ $solicitud->tipo_programa }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-light border-start border-4 border-info">
                                    <label class="text-muted small fw-bold text-uppercase d-block mb-2">Datos del Aprendiz</label>
                                    <p class="fs-4 fw-black text-slate-900 mb-1">{{ $solicitud->aprendiz_nombre }}</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="text-muted small">
                                            <i class="fas fa-id-card me-1"></i> {{ $solicitud->aprendiz_tipo_doc }} {{ $solicitud->aprendiz_documento }}
                                        </span>
                                        <span class="text-muted small mx-2">|</span>
                                        <span class="text-muted small">
                                            <i class="fas fa-envelope me-1"></i> {{ $solicitud->aprendiz_correo }}
                                        </span>
                                        <span class="text-muted small mx-2">|</span>
                                        <span class="text-muted small">
                                            <i class="fas fa-phone me-1"></i> {{ $solicitud->aprendiz_telefono }}
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">{{ $solicitud->aprendiz_estado }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Section: Motive & Evidence -->
                    <div class="p-5">
                        <div class="row g-5">
                            <div class="col-md-8">
                                <h6 class="text-uppercase fw-black text-primary mb-4 letter-spacing-1">
                                    <i class="fas fa-comment-alt me-2"></i>Motivo de la Solicitud
                                </h6>
                                <div class="p-4 rounded-4 bg-slate-50 fs-5 lh-lg text-slate-700 italic border">
                                    {!! nl2br(e($solicitud->motivo_solicitud)) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-uppercase fw-black text-primary mb-4 letter-spacing-1">
                                    <i class="fas fa-paperclip me-2"></i>Evidencia Adjunta
                                </h6>
                                @if($solicitud->evidencia_archivo)
                                <div class="card border rounded-4 overflow-hidden">
                                    <div class="card-body p-4 text-center">
                                        <div class="bg-light p-4 rounded-circle d-inline-block mb-3">
                                            <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                        </div>
                                        <h6 class="fw-bold mb-3">Archivo de Evidencia</h6>
                                        <a href="{{ Storage::url($solicitud->evidencia_archivo) }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4 w-100">
                                            <i class="fas fa-external-link-alt me-2"></i>Ver Archivo
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="p-4 rounded-4 bg-light text-center border-dashed">
                                    <i class="fas fa-info-circle text-muted mb-2"></i>
                                    <p class="text-muted small mb-0">No se adjuntaron archivos de evidencia.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-slate-50 border-top p-4 text-center">
                    <p class="text-muted small mb-0">
                        Solicitud creada el {{ \Carbon\Carbon::parse($solicitud->created_at)->format('d/m/Y \a \l\a\s H:i') }} por {{ $solicitud->user->name ?? 'Usuario' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-black { font-weight: 800; }
    .letter-spacing-1 { letter-spacing: 0.1em; }
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    }
    .bg-slate-50 { background-color: #f8fafc; }
    .text-slate-800 { color: #1e293b; }
    .text-slate-900 { color: #0f172a; }
    .italic { font-style: italic; }
    .border-dashed { border: 2px dashed #e2e8f0; }

    .status-pill-small {
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pill-small.pendiente {
        background-color: #fff7ed;
        color: #9a3412;
    }
    
    .status-pill-small.procesada {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-pill-small.rechazada {
        background-color: #fee2e2;
        color: #991b1b;
    }
</style>
@endsection
