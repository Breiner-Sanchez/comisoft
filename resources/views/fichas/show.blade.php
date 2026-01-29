@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-4 px-md-5">
    <!-- Page Header -->
    <div class="row mb-5 align-items-center animate__animated animate__fadeIn">
        <div class="col-md-7">
            <div class="d-flex align-items-center mb-2">
                <a href="{{ route('fichas.index') }}" class="btn btn-light btn-icon rounded-circle me-3 border shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h5 class="text-muted fw-bold mb-0">Detalles de Ficha</h5>
            </div>
            <h1 class="fw-black tracking-tighter mb-1">Ficha #{{ $ficha->numero }}</h1>
            <p class="text-primary fw-bold mb-0 fs-5">{{ $ficha->programa }}</p>
        </div>
        <div class="col-md-5 text-md-end mt-4 mt-md-0">
            <a href="{{ route('fichas.aprendices.create', $ficha) }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm transition-hover">
                <i class="fas fa-user-plus me-2"></i> Registrar Aprendiz
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-5 animate__animated animate__fadeInUp">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-start border-4 border-primary">
                <h6 class="text-muted fw-bold small text-uppercase mb-2">Total Aprendices</h6>
                <div class="d-flex align-items-center">
                    <h2 class="fw-black mb-0 me-3">{{ $ficha->aprendices->count() }}</h2>
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-start border-4 border-success">
                <h6 class="text-muted fw-bold small text-uppercase mb-2">Estado de Ficha</h6>
                <div class="d-flex align-items-center">
                    <h2 class="fw-black mb-0 me-3">Activa</h2>
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-3">
                        <i class="fas fa-circle-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-start border-4 border-info">
                <h6 class="text-muted fw-bold small text-uppercase mb-2">Centro</h6>
                <div class="d-flex align-items-center">
                    <h2 class="fw-black mb-0 me-3">CEFA</h2>
                    <div class="bg-info bg-opacity-10 text-info p-2 rounded-3">
                        <i class="fas fa-building-columns"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Apprentices Table -->
    <div class="card border-0 shadow-2xl rounded-5 overflow-hidden animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
        <div class="card-header bg-white py-4 px-5 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Listado de Aprendices</h5>
            <div class="input-group-modern border rounded-pill px-3 py-1 bg-light" style="width: 250px;">
                <i class="fas fa-search text-muted me-2"></i>
                <input type="text" class="border-0 bg-transparent small w-100 py-1" placeholder="Buscar aprendiz...">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted small text-uppercase fw-bold">
                            <th class="px-5 py-4 border-0">Identificación</th>
                            <th class="py-4 border-0">Aprendiz</th>
                            <th class="py-4 border-0">Contacto</th>
                            <th class="py-4 border-0">Estado</th>
                            <th class="px-5 py-4 border-0 text-end"></th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($ficha->aprendices as $aprendiz)
                            <tr>
                                <td class="px-5">
                                    <span class="fw-bold text-dark">{{ $aprendiz->identificacion }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3 bg-secondary bg-opacity-10 text-secondary fw-bold">
                                            {{ strtoupper(substr($aprendiz->nombre, 0, 1)) }}{{ strtoupper(substr($aprendiz->apellidos ?? 'X', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $aprendiz->nombre }} {{ $aprendiz->apellidos }}</div>
                                            <div class="text-muted small">{{ $aprendiz->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small fw-bold text-dark"><i class="fas fa-mobile-screen me-2 text-muted"></i>{{ $aprendiz->celular ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = 'completed';
                                        if ($aprendiz->estado == 'Inactivo') $statusClass = 'failed';
                                        if ($aprendiz->estado == 'Pendiente') $statusClass = 'pending';
                                    @endphp
                                    <span class="status-pill {{ $statusClass }}">
                                        <span class="dot"></span> {{ $aprendiz->estado ?? 'Activo' }}
                                    </span>
                                </td>
                                <td class="px-5 text-end">
                                    @if(Auth::user()->isCoordinacion())
                                    <form action="{{ route('aprendices.destroy', $aprendiz) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-icon rounded-circle shadow-sm text-danger border" onclick="return confirm('¿Eliminar aprendiz de esta ficha?')">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted italic">
                                    <div class="mb-3">
                                        <i class="fas fa-user-slash fs-1 opacity-25"></i>
                                    </div>
                                    No hay aprendices registrados en esta ficha.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.12);
    }

    .rounded-5 { border-radius: 2rem !important; }

    .btn-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .transition-hover {
        transition: all 0.3s ease;
    }

    .transition-hover:hover {
        transform: translateY(-2px);
    }

    .avatar-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        background: #f1f5f9;
        color: #64748b;
    }

    .status-pill.completed { background: #f0fdf4; color: #16a34a; }
    .status-pill.failed { background: #fef2f2; color: #dc2626; }
    .status-pill.pending { background: #fffbeb; color: #d97706; }

    .status-pill .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .status-pill.completed .dot { background: #16a34a; }
    .status-pill.failed .dot { background: #dc2626; }
    .status-pill.pending .dot { background: #d97706; }

    .italic { font-style: italic; }
</style>
@endsection
