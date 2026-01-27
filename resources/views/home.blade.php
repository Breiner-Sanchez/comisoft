@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid py-4 px-md-4">
    <!-- Welcome Header -->
    <div class="row mb-5 animate__animated animate__fadeIn">
        <div class="col-12">
            <div class="welcome-banner p-5 rounded-5 shadow-2xl position-relative overflow-hidden text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                <div class="position-relative z-1">
                    <h5 class="text-white-50 fw-bold mb-1">¡Bienvenido de nuevo, {{ Auth::user()->name }}!</h5>
                    <h1 class="fw-black tracking-tighter mb-3 fs-1">Tu panel de control está actualizado</h1>
                    <p class="mb-4 opacity-75 max-w-500">Gestiona comités, actas y novedades de aprendices de forma centralizada y profesional.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('actas.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                            <i class="fas fa-plus me-2"></i> Nueva Acta
                        </a>
                        <div class="bg-white bg-opacity-10 rounded-pill px-4 py-2 d-flex align-items-center">
                            <i class="fas fa-calendar-day me-2 text-primary"></i>
                            <span class="small fw-bold">{{ \Carbon\Carbon::now()->translatedFormat('l, d \d\e F') }}</span>
                        </div>
                    </div>
                </div>
                <!-- Abstract Background Shapes -->
                <div class="shape-1"></div>
                <div class="shape-2"></div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-white border h-100 transition-hover">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <i class="fas fa-file-contract fs-4"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill align-self-start px-3 py-2">+{{ $stats['actas_mes'] }} mes</span>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Total Actas</h6>
                <h2 class="fw-black mb-0">{{ $stats['total_actas'] }}</h2>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-white border h-100 transition-hover">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon bg-info bg-opacity-10 text-info p-3 rounded-4">
                        <i class="fas fa-id-card-clip fs-4"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Fichas Activas</h6>
                <h2 class="fw-black mb-0">{{ $stats['total_fichas'] }}</h2>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-white border h-100 transition-hover">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning p-3 rounded-4">
                        <i class="fas fa-user-graduate fs-4"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Total Aprendices</h6>
                <h2 class="fw-black mb-0">{{ $stats['total_aprendices'] }}</h2>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
            <div class="stat-card p-4 rounded-4 shadow-sm bg-white border h-100 transition-hover">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success p-3 rounded-4">
                        <i class="fas fa-check-double fs-4"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold small text-uppercase mb-1">Actas Finalizadas</h6>
                <h2 class="fw-black mb-0">{{ $stats['total_actas'] }}</h2>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Recent Actas -->
        <div class="col-lg-8 animate__animated animate__fadeInLeft">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Actas Recientes</h5>
                    <a href="{{ route('actas.index') }}" class="btn btn-link text-primary fw-bold text-decoration-none small">
                        Ver todas <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="text-muted small text-uppercase fw-bold">
                                    <th class="px-4 py-3 border-0">Número</th>
                                    <th class="py-3 border-0">Comité / Reunión</th>
                                    <th class="py-3 border-0">Fecha</th>
                                    <th class="py-3 border-0">Estado</th>
                                    <th class="px-4 py-3 border-0 text-end"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_actas'] as $acta)
                                    <tr>
                                        <td class="px-4">
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">
                                                {{ $acta->acta_numero }}-{{ $acta->acta_year ?? $acta->acta_año }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-truncate" style="max-width: 250px;">{{ $acta->nombre_comite }}</div>
                                            <small class="text-muted">{{ $acta->ciudad }}</small>
                                        </td>
                                        <td>
                                            <div class="small fw-bold">{{ \Carbon\Carbon::parse($acta->fecha)->format('d/m/Y') }}</div>
                                        </td>
                                        <td>
                                            <span class="status-pill completed">
                                                <span class="dot"></span> Finalizada
                                            </span>
                                        </td>
                                        <td class="px-4 text-end">
                                            <a href="{{ route('actas.show', $acta) }}" class="btn btn-icon btn-light rounded-circle shadow-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted italic">No hay actas registradas recientemente</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access -->
        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h5 class="mb-0 fw-bold">Accesos Rápidos</h5>
                </div>
                <div class="card-body px-4">
                    <div class="quick-link-item d-flex align-items-center p-3 rounded-4 mb-3 border transition-hover">
                        <div class="icon bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                            <i class="fas fa-file-export fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Exportar Reportes</h6>
                            <p class="mb-0 text-muted small">Generar consolidados del mes</p>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>
                    
                    <div class="quick-link-item d-flex align-items-center p-3 rounded-4 mb-3 border transition-hover">
                        <div class="icon bg-info bg-opacity-10 text-info p-3 rounded-4 me-3">
                            <i class="fas fa-user-plus fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Nuevo Aprendiz</h6>
                            <p class="mb-0 text-muted small">Registrar ficha técnica</p>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>

                    <div class="quick-link-item d-flex align-items-center p-3 rounded-4 border transition-hover">
                        <div class="icon bg-warning bg-opacity-10 text-warning p-3 rounded-4 me-3">
                            <i class="fas fa-gear fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">Configuración</h6>
                            <p class="mb-0 text-muted small">Ajustes del sistema</p>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>
                    
                    <div class="mt-4 p-4 rounded-4 bg-primary bg-opacity-5 border border-primary border-opacity-10">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-lightbulb text-warning me-2 fs-5"></i>
                            <h6 class="mb-0 fw-bold text-primary">Sugerencia</h6>
                        </div>
                        <p class="small text-muted mb-0">Puedes descargar todas tus actas en formato PDF profesional directamente desde el listado general.</p>
                    </div>
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
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); }
    .max-w-500 { max-width: 500px; }

    .welcome-banner .shape-1 {
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 50%;
        filter: blur(50px);
    }

    .welcome-banner .shape-2 {
        position: absolute;
        bottom: -50px;
        left: 20%;
        width: 150px;
        height: 150px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 50%;
        filter: blur(40px);
    }

    .transition-hover {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        border-color: #3b82f6 !important;
    }

    .btn-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        background: #f0fdf4;
        color: #16a34a;
    }

    .status-pill.completed .dot {
        width: 6px;
        height: 6px;
        background: #16a34a;
        border-radius: 50%;
        margin-right: 8px;
    }

    .quick-link-item:hover .icon {
        background: #3b82f6;
        color: #fff;
    }
</style>
@endsection
