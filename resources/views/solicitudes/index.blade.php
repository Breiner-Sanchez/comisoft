@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 px-md-5 animate__animated animate__fadeIn">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5 gap-4">
        <div>
            <h1 class="display-5 fw-extrabold text-slate-900 mb-2">
                <i class="fas fa-file-signature text-primary me-3"></i>Solicitudes Recibidas
            </h1>
            <p class="text-muted fs-5 mb-0">Gestione las solicitudes de comité enviadas por los instructores.</p>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('solicitudes.create') }}" class="btn-modern primary shadow-lg">
                <i class="fas fa-plus-circle me-2"></i> Nueva Solicitud
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 rounded-4 p-4 mb-5 animate__animated animate__bounceIn" role="alert">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-4">
                    <i class="fas fa-check-circle fs-3 text-success"></i>
                </div>
                <div>
                    <h5 class="alert-heading mb-1 fw-bold">¡Operación Exitosa!</h5>
                    <p class="mb-0 fs-6">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close m-3" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Data Table Card -->
    <div class="card border-0 shadow-2xl rounded-5 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 custom-table">
                    <thead>
                        <tr>
                            <th class="ps-5 py-4 text-uppercase tracking-wider">Solicitante</th>
                            <th class="py-4 text-uppercase tracking-wider">Aprendiz / Programa</th>
                            <th class="py-4 text-center text-uppercase tracking-wider">Fecha</th>
                            <th class="py-4 text-center text-uppercase tracking-wider">Estado</th>
                            <th class="pe-5 py-4 text-end text-uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($solicitudes as $solicitud)
                        <tr class="transition-all hover-bg-light">
                            <td class="ps-5 py-4">
                                <div class="d-flex flex-column">
                                    <span class="fs-5 fw-bold text-slate-800">{{ $solicitud->reportado_por }}</span>
                                    <span class="fs-6 text-muted">{{ $solicitud->correo_reporte }}</span>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="d-flex flex-column">
                                    <span class="fs-5 fw-bold text-primary mb-1">{{ $solicitud->aprendiz_nombre }}</span>
                                    <span class="fs-6 text-muted">
                                        <i class="fas fa-graduation-cap me-2 opacity-75"></i>{{ $solicitud->programa }} ({{ $solicitud->ficha_numero }})
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 text-center">
                                <div class="date-container p-2 rounded-4 bg-light d-inline-block">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <span class="fs-6 fw-semibold">{{ \Carbon\Carbon::parse($solicitud->created_at)->format('d/m/Y') }}</span>
                                </div>
                            </td>
                            <td class="py-4 text-center">
                                <span class="status-pill {{ $solicitud->estado }}">
                                    <span class="pulse-dot"></span>
                                    {{ ucfirst($solicitud->estado) }}
                                </span>
                            </td>
                            <td class="pe-5 py-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('solicitudes.show', $solicitud) }}" class="action-btn info" title="Ver Detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($solicitud->estado == 'pendiente')
                                    <a href="{{ route('actas.create.solicitud', $solicitud) }}" class="action-btn success" title="Generar Acta">
                                        <i class="fas fa-file-medical"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="empty-state py-5">
                                    <div class="bg-light d-inline-block p-5 rounded-circle mb-4">
                                        <i class="fas fa-inbox fa-5x text-muted opacity-50"></i>
                                    </div>
                                    <h3 class="fw-bold text-slate-800">No hay solicitudes pendientes</h3>
                                    <p class="text-muted fs-5">Las nuevas solicitudes aparecerán aquí.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($solicitudes->hasPages())
        <div class="card-footer bg-white border-0 py-4 px-5">
            <div class="pagination-modern">
                {{ $solicitudes->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    :root {
        --slate-900: #0f172a;
        --slate-800: #1e293b;
        --primary-blue: #4e73df;
    }

    .fw-extrabold { font-weight: 800; }
    .tracking-wider { letter-spacing: 0.1em; }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    }

    .custom-table thead th {
        background-color: #f1f5f9;
        font-size: 0.75rem;
        font-weight: 800;
        color: #64748b;
        border: none;
    }

    .custom-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Status Pill */
    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pill.pendiente {
        background-color: #fff7ed;
        color: #9a3412;
    }
    
    .status-pill.procesada {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-pill.rechazada {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 10px;
        background-color: currentColor;
        display: inline-block;
        animation: pulse 2s infinite;
    }

    /* Action Buttons */
    .action-btn {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
    }

    .action-btn.info { background-color: #e0f2fe; color: #0369a1; }
    .action-btn.success { background-color: #dcfce7; color: #166534; }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    @keyframes pulse {
        0% { transform: scale(0.95); opacity: 1; }
        70% { transform: scale(1.1); opacity: 0.7; }
        100% { transform: scale(0.95); opacity: 1; }
    }

    .btn-modern {
        padding: 12px 24px;
        border-radius: 14px;
        font-weight: 700;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }

    .btn-modern.primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
    }
</style>
@endsection
