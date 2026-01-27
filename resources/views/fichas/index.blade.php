@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-4 px-md-5">
    <!-- Page Header -->
    <div class="row mb-5 align-items-center animate__animated animate__fadeIn">
        <div class="col-md-6">
            <h1 class="fw-black tracking-tighter mb-1">Gestión de Fichas</h1>
            <p class="text-muted mb-0">Administra los programas de formación y sus aprendices.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('fichas.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm transition-hover">
                <i class="fas fa-plus-circle me-2"></i> Nueva Ficha
            </a>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card border-0 shadow-2xl rounded-5 overflow-hidden animate__animated animate__fadeInUp">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted small text-uppercase fw-bold">
                            <th class="px-5 py-4 border-0">Número de Ficha</th>
                            <th class="py-4 border-0">Programa de Formación</th>
                            <th class="py-4 border-0">Aprendices</th>
                            <th class="px-5 py-4 border-0 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($fichas as $ficha)
                            <tr>
                                <td class="px-5">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-3">
                                            <i class="fas fa-id-card fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="fw-black text-dark fs-5">{{ $ficha->numero }}</span>
                                            <div class="text-muted small">ID: #{{ $ficha->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $ficha->programa }}</div>
                                    <div class="text-muted small">Centro: CEFA</div>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill fw-bold">
                                        <i class="fas fa-users me-1"></i> {{ $ficha->aprendices->count() }}
                                    </span>
                                </td>
                                <td class="px-5 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-icon rounded-circle shadow-sm" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                            <li>
                                                <a class="dropdown-item rounded-3 py-2" href="{{ route('fichas.show', $ficha) }}">
                                                    <i class="fas fa-eye me-2 text-info"></i> Ver Detalles
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item rounded-3 py-2" href="{{ route('fichas.edit', $ficha) }}">
                                                    <i class="fas fa-pen-to-square me-2 text-warning"></i> Editar Ficha
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('fichas.destroy', $ficha) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item rounded-3 py-2 text-danger" onclick="return confirm('¿Está seguro de eliminar esta ficha?')">
                                                        <i class="fas fa-trash-can me-2"></i> Eliminar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted italic">
                                    <div class="mb-3">
                                        <i class="fas fa-folder-open fs-1 opacity-25"></i>
                                    </div>
                                    No hay fichas registradas actualmente.
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

    .dropdown-item {
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background-color: #f8fafc;
    }

    .badge {
        font-size: 0.75rem;
    }
</style>
@endsection
