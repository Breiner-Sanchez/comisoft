<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <style>
        /* Tamaño base de fuente reducido y heredado */
        html, body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            font-size: 13px; /* Tamaño base reducido */
        }

        * {
            font-size: inherit; /* Asegura que todos los elementos hereden el tamaño */
        }

        /* Ajustes específicos para mantener proporciones */
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: #fff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            box-shadow: 4px 0 24px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        #sidebar .sidebar-header {
            padding: 20px 24px; /* Reducido ligeramente */
            background: rgba(255, 255, 255, 0.03);
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 1.2rem; /* Reducido de 1.4rem */
            letter-spacing: -0.025em;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 8px; /* Reducido */
        }
        #sidebar .sidebar-header i {
            margin-right: 10px; /* Reducido */
            background: linear-gradient(135deg, #38bdf8 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        #sidebar ul.components {
            padding: 8px 12px; /* Reducido */
        }
        #sidebar ul li a {
            padding: 10px 14px; /* Reducido */
            font-size: 0.85rem; /* Reducido de 0.925rem */
            display: flex;
            align-items: center;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px; /* Reducido ligeramente */
            transition: all 0.2s;
            margin-bottom: 3px; /* Reducido */
            font-weight: 500;
        }
        #sidebar ul li a i {
            width: 18px; /* Reducido */
            margin-right: 10px; /* Reducido */
            font-size: 1rem; /* Reducido de 1.1rem */
            text-align: center;
            transition: transform 0.2s;
        }
        #sidebar ul li a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
        }
        #sidebar ul li a:hover i {
            transform: translateX(3px);
            color: #38bdf8;
        }
        #sidebar ul li.active > a {
            color: #fff;
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-left: 3px solid #3b82f6;
            font-weight: 600;
        }
        #sidebar ul li.active > a i {
            color: #38bdf8;
        }
        #sidebar .section-header {
            font-size: 0.65rem; /* Reducido de 0.7rem */
            text-transform: uppercase;
            padding: 16px 14px 6px 20px; /* Reducido */
            color: #64748b;
            font-weight: 700;
            letter-spacing: 0.1em;
        }
        
        #sidebar ul li ul li a {
            padding: 8px 14px 8px 44px; /* Reducido */
            font-size: 0.8rem; /* Reducido de 0.85rem */
            color: #64748b;
        }
        #sidebar ul li ul li a:hover {
            color: #38bdf8;
            background: transparent;
        }
        #sidebar ul li ul li a i {
            font-size: 0.75rem; /* Reducido de 0.8rem */
            margin-right: 8px;
        }

        .dropdown-toggle::after {
            position: absolute;
            right: 14px; /* Reducido */
            top: 50%;
            transform: translateY(-50%);
            border: none;
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.8rem; /* Reducido */
            transition: transform 0.3s;
        }
        .dropdown-toggle[aria-expanded="true"]::after {
            transform: translateY(-50%) rotate(180deg);
        }

        #content {
            width: 100%;
            padding: 0;
            min-height: 100vh;
            background: #f8fafc;
        }
        .topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            height: 64px; /* Reducido de 72px */
            display: flex;
            align-items: center;
            padding: 0 32px; /* Reducido de 40px */
            justify-content: space-between;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .topbar .title {
            font-size: 0.95rem; /* Reducido de 1.1rem */
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.01em;
        }
        .user-info {
            background: white;
            padding: 6px 6px 6px 16px;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .user-info:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .user-info .name .user-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }
        .user-info .name .user-role {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        /* Ajuste del contenido principal */
        main.container-fluid {
            padding: 20px !important; /* Reducido de px-4 */
        }

        /* Ajuste para formularios y contenido general */
        .form-control, .form-select, .btn, .card, .table {
            font-size: 0.9rem !important; /* Tamaño consistente */
        }

        .card-header, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-size: 0.95rem !important; /* Títulos más pequeños */
        }

        .table th, .table td {
            padding: 0.5rem !important; /* Reducido */
            font-size: 0.85rem !important;
        }

        /* Scrollbar sidebar */
        #sidebar::-webkit-scrollbar {
            width: 4px; /* Reducido de 5px */
        }
        #sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
        #sidebar:hover::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
        }

        /* Ajustes para dropdowns del usuario */
        .dropdown-menu {
            font-size: 0.85rem !important;
            min-width: 200px !important;
        }
        .dropdown-item {
            padding: 0.75rem 1rem !important;
            font-weight: 500;
            transition: all 0.2s;
        }
        .dropdown-item:hover {
            background-color: #f1f5f9 !important;
            transform: translateX(4px);
        }
        
        /* Avatar más pequeño */
        .user-info .rounded-circle {
            width: 36px !important; /* Reducido de 40px */
            height: 36px !important; /* Reducido de 40px */
            font-size: 0.9rem !important;
        }
    </style>
</head>
<body>
    <!-- El resto del código HTML permanece igual -->
    <div id="app">
        <div id="wrapper">
            @auth
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <i class="fas fa-hammer"></i> ComiSoft
                </div>

                <ul class="list-unstyled components">
                    <li class="{{ Request::is('home') ? 'active' : '' }}">
                        <a href="{{ url('/home') }}">
                            <i class="fas fa-grid-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <div class="section-header">Administración</div>
                    
                    <li>
                        <a href="#solicitudesSubmenu" data-bs-toggle="collapse" aria-expanded="{{ Request::is('solicitudes*') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <i class="fas fa-file-signature"></i> Solicitudes
                        </a>
                        <ul class="collapse list-unstyled {{ Request::is('solicitudes*') ? 'show' : '' }}" id="solicitudesSubmenu">
                            <li>
                                <a href="{{ route('solicitudes.create') }}">
                                    <i class="fas fa-plus-circle"></i> Nueva Solicitud
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('solicitudes.index') }}">
                                    <i class="fas fa-list-check"></i> Solicitudes Recibidas
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#actasSubmenu" data-bs-toggle="collapse" aria-expanded="{{ Request::is('actas*') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <i class="fas fa-file-invoice"></i> Comités y Actas
                        </a>
                        <ul class="collapse list-unstyled {{ Request::is('actas*') ? 'show' : '' }}" id="actasSubmenu">
                            <li>
                                <a href="{{ route('actas.create') }}">
                                    <i class="fas fa-pen-to-square"></i> Generar Acta
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('actas.index') }}">
                                    <i class="fas fa-box-archive"></i> Historial de Actas
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#comitesSubmenu" data-bs-toggle="collapse" aria-expanded="{{ Request::is('fichas*') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <i class="fas fa-users-gear"></i> Gestión Operativa
                        </a>
                        <ul class="collapse list-unstyled {{ Request::is('fichas*') ? 'show' : '' }}" id="comitesSubmenu">
                            <li>
                                <a href="{{ route('fichas.index') }}">
                                    <i class="fas fa-folder-tree"></i> Control de Fichas
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if(Auth::user()->isCoordinacion())
                    <li>
                        <a href="#reporteSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-chart-pie"></i> Reportes y Stats
                        </a>
                        <ul class="collapse list-unstyled" id="reporteSubmenu">
                            <li>
                                <a href="#">
                                    <i class="fas fa-file-export"></i> Exportar Datos
                                </a>
                            </li>
                        </ul>
                    </li>

                    <div class="section-header">Seguridad</div>
                    <li class="{{ Request::is('users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fas fa-user-shield"></i> Gestión de Usuarios
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            @endauth

            <!-- Page Content -->
            <div id="content">
                @auth
                <!-- Topbar -->
                <nav class="topbar">
                    <div class="title d-none d-md-block">Sistema de Gestión ComiSoft</div>
                    <div class="user-info dropdown shadow-sm" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="name d-none d-sm-block text-end me-3">
                            <span class="user-name d-block">{{ Auth::user()->name }}</span>
                            <span class="user-role {{ Auth::user()->isCoordinacion() ? 'text-primary' : 'text-muted' }}">
                                {{ Auth::user()->isCoordinacion() ? 'Coordinación' : 'Instructor' }}
                            </span>
                        </div>
                        <div class="ms-1 rounded-circle bg-primary d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 38px; height: 38px;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 p-2 rounded-4 animate__animated animate__fadeInUp" style="min-width: 220px;">
                            <li class="px-3 py-3 border-bottom mb-2 bg-light rounded-top-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark small" style="line-height: 1.2;">{{ Auth::user()->name }}</div>
                                        <div class="text-muted" style="font-size: 0.65rem;">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 rounded-3" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <div class="d-flex align-items-center text-danger">
                                        <div class="bg-danger bg-opacity-10 p-2 rounded-3 me-3">
                                            <i class="fas fa-power-off fa-fw"></i>
                                        </div>
                                        <span class="fw-bold">Cerrar Sesión</span>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
                @endauth



                <main class="container-fluid px-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>