@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 px-md-5 animate__animated animate__fadeIn">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5 gap-4">
        <div>
            <h1 class="display-5 fw-extrabold text-slate-900 mb-2">
                <i class="fas fa-users-cog text-primary me-3"></i>Gestión de Usuarios
            </h1>
            <p class="text-muted fs-5 mb-0">Administre los roles y permisos de los usuarios del sistema.</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-user-plus me-2"></i> Nuevo Usuario
            </button>
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0 rounded-4 p-4 mb-5 animate__animated animate__shakeX" role="alert">
            <div class="d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-4">
                    <i class="fas fa-exclamation-circle fs-3 text-danger"></i>
                </div>
                <div>
                    <h5 class="alert-heading mb-1 fw-bold">Error</h5>
                    <p class="mb-0 fs-6">{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close m-3" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0 rounded-4 p-4 mb-5" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                            <th class="ps-5 py-4 text-uppercase tracking-wider">Nombre</th>
                            <th class="py-4 text-uppercase tracking-wider">Correo Electrónico</th>
                            <th class="py-4 text-center text-uppercase tracking-wider">Rol Actual</th>
                            <th class="pe-5 py-4 text-end text-uppercase tracking-wider">Cambiar Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="transition-all hover-bg-light">
                            <td class="ps-5 py-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span class="fs-6 fw-bold text-slate-800">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-4">
                                <span class="text-muted">{{ $user->email }}</span>
                            </td>
                            <td class="py-4 text-center">
                                <span class="badge {{ $user->isCoordinacion() ? 'bg-info text-dark' : 'bg-secondary' }} px-3 py-2 rounded-pill">
                                    {{ $user->isCoordinacion() ? 'Coordinación' : 'Instructor' }}
                                </span>
                            </td>
                            <td class="pe-5 py-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('users.update-role', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm">
                                            <select name="role" class="form-select form-select-sm rounded-start-3" style="max-width: 150px;">
                                                <option value="instructor" {{ $user->role == 'instructor' ? 'selected' : '' }}>Instructor</option>
                                                <option value="coordinacion" {{ $user->role == 'coordinacion' ? 'selected' : '' }}>Coordinación</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm rounded-end-3" {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @if(Auth::id() != $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-3">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($users->hasPages())
        <div class="card-footer bg-white border-0 py-4 px-5">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-5">
            <div class="modal-header border-0 bg-primary bg-gradient text-white p-4">
                <h5 class="modal-title fw-bold" id="createUserModalLabel">
                    <i class="fas fa-user-plus me-2"></i>Registrar Nuevo Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nombre Completo</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-user text-primary"></i></span>
                            <input type="text" class="form-control bg-light border-0" id="name" name="name" required placeholder="Ej: Juan Pérez">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-primary"></i></span>
                            <input type="email" class="form-control bg-light border-0" id="email" name="email" required placeholder="nombre@correo.com">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Contraseña Temporal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-primary"></i></span>
                            <input type="password" class="form-control bg-light border-0" id="password" name="password" required placeholder="Mínimo 8 caracteres">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold">Asignar Rol</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-user-tag text-primary"></i></span>
                            <select class="form-select bg-light border-0" id="role" name="role" required>
                                <option value="instructor" selected>Instructor</option>
                                <option value="coordinacion">Coordinación</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-toggle="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i>Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .fw-extrabold { font-weight: 800; }
    .tracking-wider { letter-spacing: 0.1em; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08); }
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
</style>
@endsection
