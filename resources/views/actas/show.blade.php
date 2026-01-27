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
                        <i class="fas fa-file-invoice text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Visualización de Acta</h5>
                        <p class="text-muted mb-0 small">Estado: <span class="badge {{ $acta->estado == 'final' ? 'bg-success' : 'bg-warning text-dark' }} bg-opacity-10 text-{{ $acta->estado == 'final' ? 'success' : 'warning' }} rounded-pill px-3">{{ ucfirst($acta->estado) }}</span></p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('actas.index') }}" class="btn btn-light rounded-3 border">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <a href="{{ route('actas.pdf', $acta) }}" class="btn btn-danger rounded-3 px-4 shadow-sm" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                    </a>
                    <a href="{{ route('actas.edit', $acta) }}" class="btn btn-warning rounded-3 px-4 shadow-sm text-dark fw-bold">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Document -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="acta-document shadow-2xl animate__animated animate__fadeInUp">
                <!-- Document Header -->
                <div class="document-header d-flex border-bottom">
                    <div class="header-logo border-end p-4 d-flex align-items-center justify-content-center" style="width: 20%;">
                        <img src="{{ asset('images/Sena_Logo.png') }}" alt="SENA" style="width: 70px;">
                    </div>
                    <div class="header-title p-4 flex-grow-1 text-center d-flex flex-column justify-content-center">
                        <h4 class="fw-black mb-1 tracking-tighter">ACTA No. {{ $acta->acta_numero }} - {{ $acta->acta_año }}</h4>
                        <p class="text-muted small mb-0 text-uppercase fw-bold letter-spacing-1">Gestión de Formación Profesional / CEFA</p>
                    </div>
                </div>

                <!-- Document Body -->
                <div class="document-body p-5">
                    <!-- Basic Info Grid -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-12">
                            <div class="info-block">
                                <span class="label">Nombre del comité o de la reunión</span>
                                <div class="value fw-bold fs-5 text-primary">{{ $acta->nombre_comite }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-block">
                                <span class="label">Ciudad y Fecha</span>
                                <div class="value">{{ $acta->ciudad }}, {{ \Carbon\Carbon::parse($acta->fecha)->locale('es')->isoFormat('LL') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-block">
                                <span class="label">Hora Inicio / Fin</span>
                                <div class="value">
                                    <i class="far fa-clock text-muted me-1"></i> 
                                    {{ \Carbon\Carbon::parse($acta->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($acta->hora_fin)->format('H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-block">
                                <span class="label">Lugar / Enlace</span>
                                <div class="value">{{ $acta->lugar }}</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="info-block">
                                <span class="label">Dirección / Regional / Centro</span>
                                <div class="value">{{ $acta->regional }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Solicitud Info Section (NEW) -->
                    @if($acta->solicitud)
                    <div class="solicitud-summary mb-5 p-4 rounded-4 bg-light border-start border-4 border-info">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle text-info fs-5 me-2"></i>
                            <h6 class="mb-0 fw-bold text-dark text-uppercase small letter-spacing-1">Información de la Solicitud Inicial</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <span class="label small text-muted d-block">Reportado por:</span>
                                <span class="value fw-bold">{{ $acta->solicitud->reportado_por }}</span>
                                <div class="text-muted small">{{ $acta->solicitud->correo_reporte }}</div>
                                <div class="text-muted small">{{ $acta->solicitud->telefono_reporte }}</div>
                            </div>
                            <div class="col-md-4">
                                <span class="label small text-muted d-block">Programa y Ficha:</span>
                                <span class="value fw-bold text-dark">{{ $acta->solicitud->programa }}</span>
                                <div class="text-muted small">Ficha: {{ $acta->solicitud->ficha_numero }} - {{ $acta->solicitud->tipo_programa }}</div>
                            </div>
                            <div class="col-md-4">
                                <span class="label small text-muted d-block">Aprendiz Involucrado:</span>
                                <span class="value fw-bold text-dark">{{ $acta->solicitud->aprendiz_nombre }}</span>
                                <div class="text-muted small">{{ $acta->solicitud->aprendiz_tipo_doc }} {{ $acta->solicitud->aprendiz_documento }}</div>
                                <div class="badge bg-info bg-opacity-10 text-info rounded-pill px-2" style="font-size: 0.7rem;">{{ $acta->solicitud->aprendiz_estado }}</div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <span class="label small text-muted d-block">Motivo de la Solicitud:</span>
                                <div class="value mt-1 italic text-muted" style="font-size: 0.95rem;">
                                    {!! nl2br(e($acta->solicitud->motivo_solicitud)) !!}
                                </div>
                            </div>
                            @if($acta->solicitud->evidencia_archivo)
                            <div class="col-md-12 mt-2">
                                <a href="{{ Storage::url($acta->solicitud->evidencia_archivo) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                    <i class="fas fa-paperclip me-1"></i> Ver Evidencia Adjunta
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Agenda Section -->
                    <div class="section-wrapper mb-5">
                        <h6 class="section-title">
                            <i class="fas fa-list-ul me-2"></i>Agenda o puntos para desarrollar
                        </h6>
                        <div class="section-content bg-light p-4 rounded-4">
                            {!! nl2br(e($acta->agenda)) !!}
                        </div>
                    </div>

                    <!-- Objectives Section -->
                    <div class="section-wrapper mb-5">
                        <h6 class="section-title">
                            <i class="fas fa-bullseye me-2"></i>Objetivo(s) de la reunión
                        </h6>
                        <div class="section-content border-start border-4 border-primary p-4 bg-primary bg-opacity-5 rounded-end-4">
                            {!! nl2br(e($acta->objetivos)) !!}
                        </div>
                    </div>

                    <!-- Development Section -->
                    <div class="section-wrapper mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <h6 class="section-title mb-0 flex-grow-1">
                                <i class="fas fa-pen-nib me-2"></i>Desarrollo de la reunión
                            </h6>
                            <hr class="flex-grow-1 ms-3 opacity-10">
                        </div>
                        <div class="section-content mb-5 fs-6 lh-lg text-dark">
                            {!! nl2br(e($acta->descripcion_desarrollo)) !!}
                        </div>

                        <!-- Fichas and Aprendices -->
                        @foreach($acta->fichas as $ficha)
                            <div class="ficha-card mb-5 border rounded-4 overflow-hidden shadow-sm">
                                <div class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="fas fa-users-rectangle me-2 text-warning"></i>
                                        FICHA: {{ $ficha->numero }}
                                    </h6>
                                    <span class="badge bg-light text-dark">{{ $ficha->programa }}</span>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th colspan="7" class="text-center py-3 text-primary text-uppercase small fw-black">
                                                    {{ $ficha->pivot->tema ?? 'Aprendices que aún no aprueban trimestre de la etapa lectiva' }}
                                                </th>
                                            </tr>
                                            <tr class="small text-muted text-uppercase fw-bold">
                                                <th class="px-4 py-2 border-0">No</th>
                                                <th class="py-2 border-0">Nombre del Aprendiz</th>
                                                <th class="py-2 border-0">ID</th>
                                                <th class="py-2 border-0">Novedad</th>
                                                <th class="py-2 border-0">Instructor</th>
                                                <th class="py-2 border-0">Evidencia</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-top-0">
                                            @php 
                                                $aprendices = \App\Models\Aprendiz::where('ficha_id', $ficha->id)->get();
                                                $aprendicesData = $ficha->pivot->aprendices_data ? json_decode($ficha->pivot->aprendices_data, true) : null;
                                            @endphp
                                            @forelse($aprendices as $key => $aprendiz)
                                                <tr>
                                                    <td class="px-4 text-muted">{{ $key + 1 }}</td>
                                                    <td class="fw-bold">{{ $aprendiz->nombre }}</td>
                                                    <td class="text-muted">{{ $aprendiz->identificacion }}</td>
                                                    
                                                    @if($key === 0)
                                                        <td rowspan="{{ $aprendices->count() }}" class="border-start bg-light bg-opacity-50 small align-middle">
                                                            {{ $ficha->pivot->novedad }}
                                                        </td>
                                                        <td rowspan="{{ $aprendices->count() }}" class="border-start bg-light bg-opacity-50 small align-middle">
                                                            {{ $ficha->pivot->instructor }}
                                                        </td>
                                                        @if(!$aprendicesData)
                                                            <td rowspan="{{ $aprendices->count() }}" class="border-start bg-light bg-opacity-50 small align-middle">
                                                                {{ $ficha->pivot->evidencia }}
                                                            </td>
                                                        @endif
                                                    @endif

                                                    @if($aprendicesData)
                                                        <td class="border-start small text-info italic">
                                                            <i class="fas fa-paperclip me-1"></i>
                                                            {{ $aprendicesData[$aprendiz->id]['evidencia'] ?? 'Sin evidencia' }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4 text-muted italic">No hay aprendices registrados</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Conclusions Section -->
                    <div class="section-wrapper mb-5 p-4 bg-light rounded-4">
                        <h6 class="section-title text-uppercase small text-muted mb-3 fw-black">
                            Conclusiones
                        </h6>
                        <div class="fs-6 italic">
                            {!! nl2br(e($acta->conclusiones)) !!}
                        </div>
                    </div>

                    <!-- Compromisos Section -->
                    <div class="section-wrapper mb-5">
                        <h6 class="section-title mb-4">
                            <i class="fas fa-handshake-alt me-2 text-primary"></i>Compromisos / Decisiones
                        </h6>
                        <div class="table-responsive rounded-4 border shadow-sm">
                            <table class="table table-hover mb-0">
                                <thead class="bg-primary text-white">
                                    <tr class="small text-uppercase fw-bold">
                                        <th class="px-4 py-3 border-0">Actividad</th>
                                        <th class="py-3 border-0">Responsable</th>
                                        <th class="py-3 border-0">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(is_array($acta->compromisos) && count($acta->compromisos) > 0)
                                        @foreach($acta->compromisos as $compromiso)
                                            <tr>
                                                <td class="px-4 py-3 fw-semibold text-dark">{{ $compromiso['actividad'] ?? 'N/A' }}</td>
                                                <td class="py-3">{{ $compromiso['responsable'] ?? 'N/A' }}</td>
                                                <td class="py-3 text-muted small">{{ $compromiso['fecha'] ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">No se registraron compromisos</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Assistants / Participants -->
                    <div class="row g-4 mt-5 pt-5 border-top">
                        <div class="col-md-6">
                            <h6 class="section-title small text-muted text-uppercase mb-3 fw-black">Asistentes</h6>
                            <div class="value lh-base text-slate-700" style="white-space: pre-line;">{{ $acta->asistentes }}</div>
                            @if($acta->evidencia_asistentes)
                            <div class="mt-3">
                                <a href="{{ Storage::url($acta->evidencia_asistentes) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-eye me-1"></i> Ver Firma de Asistencia
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6 class="section-title small text-muted text-uppercase mb-3 fw-black">Participantes Invitados</h6>
                            <div class="value lh-base text-slate-700" style="white-space: pre-line;">{{ $acta->participantes }}</div>
                        </div>
                    </div>
                </div>

                <!-- Document Footer -->
                <div class="document-footer bg-light p-4 text-center border-top">
                    <p class="mb-0 text-muted small">
                        Acta generada por el sistema el {{ \Carbon\Carbon::parse($acta->created_at)->format('d/m/Y') }}
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
        background-color: #f1f5f9;
    }

    .acta-document {
        background: white;
        border-radius: 0;
        min-height: 1000px;
    }

    .fw-black { font-weight: 800; }
    .letter-spacing-1 { letter-spacing: 0.1em; }
    .tracking-tighter { letter-spacing: -0.05em; }
    
    .info-block {
        margin-bottom: 0.5rem;
    }

    .info-block .label {
        display: block;
        font-size: 0.65rem;
        text-transform: uppercase;
        font-weight: 800;
        color: #64748b;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .info-block .value {
        color: #1e293b;
    }

    .section-title {
        font-size: 0.85rem;
        font-weight: 800;
        color: #0f172a;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }

    .italic { font-style: italic; }
    
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    @media print {
        .btn, .navbar, .header-actions { display: none !important; }
        body { background: white; padding: 0 !important; }
        .container { max-width: 100% !important; width: 100% !important; padding: 0 !important; }
        .acta-document { shadow: none !important; border: none !important; }
    }
</style>
@endsection
