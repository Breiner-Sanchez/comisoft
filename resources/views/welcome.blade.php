<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ComiSoft - Sistema de Gestión de Actas</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            overflow-x: hidden;
        }

        .hero-section {
            padding: 120px 0;
            background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.05) 0%, transparent 40%),
                        radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.05) 0%, transparent 40%);
        }

        .fw-black { font-weight: 800; }
        .tracking-tighter { letter-spacing: -0.05em; }

        .btn-modern {
            padding: 12px 32px;
            border-radius: 14px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-primary-modern {
            background: #3b82f6;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2);
        }

        .btn-primary-modern:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.3);
            color: white;
        }

        .btn-outline-modern {
            background: transparent;
            border: 2px solid #e2e8f0;
            color: #475569;
        }

        .btn-outline-modern:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #1e293b;
            transform: translateY(-2px);
        }

        .feature-card {
            padding: 40px;
            border-radius: 24px;
            background: #fff;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: #e2e8f0;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            transform: translateY(-5px);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 24px;
        }

        .navbar {
            padding: 24px 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #1e293b;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
            color: #3b82f6;
        }

        .logo-sena {
            height: 40px;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeInLeft" href="#">
                <img src="{{ asset('images/Sena_Logo.png') }}" alt="SENA" class="logo-sena">
                ComiSoft
            </a>
            <div class="ms-auto animate__animated animate__fadeInRight">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn-modern btn-primary-modern">
                            Ir al Dashboard <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-modern btn-outline-modern me-2">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-modern btn-primary-modern">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 animate__animated animate__fadeInUp">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-4">
                        ✨ Gestión Profesional de Actas
                    </span>
                    <h1 class="display-3 fw-black tracking-tighter mb-4">
                        Moderniza la gestión de tus <span class="text-primary">Comités</span>
                    </h1>
                    <p class="lead text-muted mb-5 pe-lg-5">
                        La plataforma definitiva para el seguimiento, registro y exportación de actas de comité para instructores y personal administrativo.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn-modern btn-primary-modern py-3 px-4">
                            Empezar Ahora <i class="fas fa-bolt ms-2"></i>
                        </a>
                        <a href="#features" class="btn-modern btn-outline-modern py-3 px-4">
                            Saber más
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&q=80&w=1000" 
                             alt="ComiSoft App" class="img-fluid rounded-5 shadow-2xl">
                        <div class="position-absolute top-100 start-0 translate-middle-y bg-white p-4 rounded-4 shadow-lg border animate__animated animate__bounceIn animate__delay-1s" style="width: 280px; left: -20px !important;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-success"></i>
                                </div>
                                <div class="fw-bold">Acta Generada</div>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 mb-5">
        <div class="container py-5">
            <div class="text-center mb-5 animate__animated animate__fadeIn">
                <h2 class="fw-black tracking-tighter display-5 mb-3">Todo lo que necesitas</h2>
                <p class="text-muted">Diseñado para optimizar el flujo de trabajo en el CEFA.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="feature-card">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-magic"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Wizard Inteligente</h4>
                        <p class="text-muted mb-0">Crea actas complejas paso a paso con nuestro asistente guiado intuitivo.</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="feature-card">
                        <div class="icon-box bg-success bg-opacity-10 text-success">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Exportación PDF</h4>
                        <p class="text-muted mb-0">Genera documentos profesionales listos para imprimir con un solo clic.</p>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="feature-card">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Control de Aprendices</h4>
                        <p class="text-muted mb-0">Gestiona fichas y aprendices vinculados de manera eficiente y centralizada.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 border-top">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/Sena_Logo.png') }}" alt="SENA" class="logo-sena opacity-50">
                    <span class="text-muted small">© {{ date('Y') }} ComiSoft. Centro de Formación Agroindustrial (CEFA).</span>
                </div>
                <div class="d-flex gap-4">
                    <a href="#" class="text-muted text-decoration-none small">Privacidad</a>
                    <a href="#" class="text-muted text-decoration-none small">Términos</a>
                    <a href="#" class="text-muted text-decoration-none small">Contacto</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
