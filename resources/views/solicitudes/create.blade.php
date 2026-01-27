@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-5 px-md-5">
    <!-- Header Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-12 text-center animate__animated animate__fadeIn">
            <h1 class="display-4 fw-black text-slate-900 mb-2">Nueva Solicitud de Comité</h1>
            <p class="text-muted fs-5">Complete los datos para reportar una novedad de aprendiz.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <form action="{{ route('solicitudes.store') }}" method="POST" id="solicitud-form" enctype="multipart/form-data">
                @csrf

                <!-- SECTION 1: Información del Solicitante -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeInUp">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-user-circle fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">1. Información del Solicitante</h4>
                            <p class="text-white-50 mb-0 small">Identificación de quien reporta la novedad</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-modern">Nombre Completo *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-id-card-clip icon-left"></i>
                                    <input type="text" name="reportado_por" class="form-control-modern" placeholder="Ingrese su nombre completo" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Correo Electrónico *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-envelope icon-left"></i>
                                    <input type="email" name="correo_reporte" class="form-control-modern" placeholder="ejemplo@correo.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Teléfono de Contacto</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-phone icon-left"></i>
                                    <input type="text" name="telefono_reporte" class="form-control-modern" placeholder="Opcional">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Programa de Formación -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeInUp">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-graduation-cap fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">2. Programa de Formación</h4>
                            <p class="text-white-50 mb-0 small">Información de la ficha y el programa</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-md-8">
                                <label class="form-label-modern">Nombre del Programa *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-book icon-left"></i>
                                    <input type="text" name="programa" class="form-control-modern" placeholder="Ej: Análisis y Desarrollo de Software" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-modern">Número de Ficha *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-tags icon-left"></i>
                                    <input type="text" name="ficha_numero" class="form-control-modern" placeholder="Ej: 2500001" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-modern">Tipo de Programa</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-award icon-left"></i>
                                    <select name="tipo_programa" class="form-control-modern">
                                        <option value="Tecnólogo">Tecnólogo</option>
                                        <option value="Técnico">Técnico</option>
                                        <option value="Operario">Operario</option>
                                        <option value="Auxiliar">Auxiliar</option>
                                        <option value="Especialización Tecnológica">Especialización Tecnológica</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: Información del Aprendiz -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeInUp">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-user-graduate fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">3. Información del Aprendiz</h4>
                            <p class="text-white-50 mb-0 small">Datos básicos del aprendiz involucrado</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-md-8">
                                <label class="form-label-modern">Nombre Completo del Aprendiz *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-user icon-left"></i>
                                    <input type="text" name="aprendiz_nombre" class="form-control-modern" placeholder="Nombre completo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-modern">Teléfono</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-mobile-screen icon-left"></i>
                                    <input type="text" name="aprendiz_telefono" class="form-control-modern" placeholder="Opcional">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-modern">Tipo Documento *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-address-card icon-left"></i>
                                    <select name="aprendiz_tipo_doc" class="form-control-modern" required>
                                        <option value="CC">Cédula de Ciudadanía</option>
                                        <option value="TI">Tarjeta de Identidad</option>
                                        <option value="CE">Cédula de Extranjería</option>
                                        <option value="PEP">PEP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label-modern">Número de Documento *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-fingerprint icon-left"></i>
                                    <input type="text" name="aprendiz_documento" class="form-control-modern" placeholder="Ingrese número" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Correo Electrónico</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-envelope-open icon-left"></i>
                                    <input type="email" name="aprendiz_correo" class="form-control-modern" placeholder="correo@misena.edu.co">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Estado Actual *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-user-check icon-left"></i>
                                    <select name="aprendiz_estado" class="form-control-modern" required>
                                        <option value="En formación">En formación</option>
                                        <option value="Inducción">Inducción</option>
                                        <option value="Condicionado">Condicionado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: Motivo y Caso -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeInUp">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-clipboard-check fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">4. Motivo y Soporte</h4>
                            <p class="text-white-50 mb-0 small">Descripción de la novedad y carga de evidencias</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-modern">Motivo de la Solicitud / Descripción del Caso *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-align-left icon-left"></i>
                                    <textarea name="motivo_solicitud" class="form-control-modern pt-3" rows="6" placeholder="Describa detalladamente el motivo por el cual reporta al aprendiz..." required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label-modern">Cargar Evidencia (Opcional)</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-cloud-arrow-up icon-left"></i>
                                    <input type="file" name="evidencia_archivo" class="form-control-modern">
                                </div>
                                <div class="small text-muted mt-2">Formatos permitidos: PDF, JPG, PNG, DOCX (Máx 5MB)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="mt-5 d-flex justify-content-center animate__animated animate__fadeInUp">
                    <button type="submit" class="btn-modern success px-5 py-3 fs-5 shadow-lg">
                        <i class="fas fa-paper-plane me-2"></i> Enviar Solicitud de Comité
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    body {
        background-color: #f1f5f9;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    }

    .rounded-5 { border-radius: 2rem !important; }

    .fw-black { font-weight: 800; }

    /* Modern Form Inputs */
    .form-label-modern {
        display: block;
        font-weight: 700;
        color: #334155;
        margin-bottom: 10px;
        font-size: 0.9rem;
        padding-left: 5px;
    }

    .input-group-modern {
        position: relative;
        background: #f8fafc;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s;
        overflow: hidden;
    }

    .input-group-modern:focus-within {
        background: #fff;
        border-color: #4e73df;
        box-shadow: 0 10px 15px -3px rgba(78, 115, 223, 0.1);
    }

    .input-group-modern .icon-left {
        position: absolute;
        left: 20px;
        top: 15px;
        color: #94a3b8;
        transition: color 0.3s;
        z-index: 10;
    }

    .input-group-modern:focus-within .icon-left {
        color: #4e73df;
    }

    .form-control-modern {
        width: 100%;
        padding: 14px 20px 14px 55px;
        background: transparent;
        border: none;
        font-weight: 500;
        color: #1e293b;
        outline: none;
        font-size: 1rem;
    }

    /* Buttons */
    .btn-modern {
        padding: 14px 35px;
        border-radius: 16px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
    }

    .btn-modern.success { background: #10b981; color: #fff; }

    .btn-modern:hover {
        transform: translateY(-3px);
        filter: brightness(1.1);
        box-shadow: 0 15px 25px -5px rgba(0,0,0,0.1);
    }

    .tracking-tight { letter-spacing: -0.025em; }
</style>
@endsection
