@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-5 px-md-5">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Generar Nueva Acta</h2>
                <p class="text-muted">Inicie el proceso de creación de un acta de comité o reunión</p>
            </div>
            <a href="{{ route('actas.index') }}" class="btn-modern secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver al listado
            </a>
        </div>
    </div>

    @if(isset($solicitud))
    <!-- Solicitud Context Card -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-12">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden animate__animated animate__fadeInDown border-start border-5 border-info">
                <div class="card-body p-4 bg-info bg-opacity-10">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-info-circle fs-3 text-info"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-info">Generando Acta desde Solicitud #{{ $solicitud->id }}</h5>
                            <p class="mb-0 text-slate-700">
                                <strong>Aprendiz:</strong> {{ $solicitud->aprendiz_nombre }} | 
                                <strong>Ficha:</strong> {{ $solicitud->ficha_numero }} | 
                                <strong>Motivo:</strong> {{ Str::limit($solicitud->motivo_solicitud, 100) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <form action="{{ route('actas.store') }}" method="POST" id="form-acta" enctype="multipart/form-data">
                @csrf

                @if(isset($solicitud))
                    <input type="hidden" name="solicitud_id" value="{{ $solicitud->id }}">
                @endif

                <!-- SECTION 1: Datos de Identificación -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeIn">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-file-invoice fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">1. Datos de Identificación</h4>
                            <p class="text-white-50 mb-0 small">Información básica y localización del acta</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-md-3">
                                <label class="form-label-modern">Número de Acta *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-hashtag icon-left"></i>
                                    <input type="text" name="acta_numero" class="form-control-modern" placeholder="Ej: 001" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-modern">Año *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar icon-left"></i>
                                    <input type="text" name="acta_año" class="form-control-modern" value="{{ date('Y') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Nombre del Comité / Reunión</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-heading icon-left"></i>
                                    <input type="text" name="nombre_comite" class="form-control-modern" placeholder="Ej: Comité de Evaluación y Seguimiento" value="{{ isset($solicitud) ? 'Comité de Seguimiento - ' . $solicitud->aprendiz_nombre : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-modern">Ciudad</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-location-dot icon-left"></i>
                                    <input type="text" name="ciudad" class="form-control-modern" value="Medellín">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-modern">Fecha *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar-day icon-left"></i>
                                    <input type="date" name="fecha" class="form-control-modern" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label-modern">Hora Inicio</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-clock icon-left"></i>
                                    <input type="time" name="hora_inicio" class="form-control-modern">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label-modern">Hora Fin</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-clock-rotate-left icon-left"></i>
                                    <input type="time" name="hora_fin" class="form-control-modern">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Lugar y/o Enlace</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-link icon-left"></i>
                                    <input type="text" name="lugar" class="form-control-modern" placeholder="Ej: Sala 1 o Enlace Meet">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Dirección / Regional / Centro</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-building icon-left"></i>
                                    <input type="text" name="regional" class="form-control-modern" value="Antioquia / CEFA">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Estado del Acta *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-toggle-on icon-left"></i>
                                    <select name="estado" class="form-control-modern" required>
                                        <option value="borrador" selected>Borrador</option>
                                        <option value="final">Finalizada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Agenda y Objetivos -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeIn">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-bullseye fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">2. Agenda y Objetivos</h4>
                            <p class="text-white-50 mb-0 small">Puntos a desarrollar y metas de la reunión</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-modern">Agenda o puntos para desarrollar</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-list-ol icon-left"></i>
                                    <textarea name="agenda" class="form-control-modern pt-3" rows="4" placeholder="1. Verificación del quórum...">{{ isset($solicitud) ? "1. Verificación del quórum\n2. Presentación del caso: " . $solicitud->aprendiz_nombre . "\n3. Análisis de descargos y evidencias\n4. Recomendación del comité" : "" }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label-modern">Objetivo(s) de la reunión</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-crosshairs icon-left"></i>
                                    <textarea name="objetivos" class="form-control-modern pt-3" rows="3" placeholder="Definir acciones para...">{{ isset($solicitud) ? "Analizar la situación académica/disciplinaria del aprendiz " . $solicitud->aprendiz_nombre . " relacionada con: " . $solicitud->motivo_solicitud : "" }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: Desarrollo y Fichas -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeIn">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-pen-to-square fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">3. Desarrollo de la Reunión</h4>
                            <p class="text-white-50 mb-0 small">Relato detallado y selección de fichas</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4 mb-5">
                            <div class="col-12">
                                <label class="form-label-modern">Descripción detallada del desarrollo</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-align-left icon-left"></i>
                                    <textarea name="descripcion_desarrollo" class="form-control-modern pt-3" rows="6" placeholder="Siendo las... se dio inicio a..."></textarea>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-tags me-2"></i>Fichas Relacionadas</h5>
                                <div id="fichas-container" class="p-4 bg-light rounded-4 border border-dashed d-flex flex-wrap gap-3" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($fichas as $ficha)
                                        <div class="ficha-selection-card">
                                            <input class="form-check-input ficha-checkbox d-none" type="checkbox" value="{{ $ficha->id }}" id="ficha_{{ $ficha->id }}" name="fichas[]" {{ isset($solicitud) && $solicitud->ficha_numero == $ficha->numero ? 'checked' : '' }}>
                                            <label class="ficha-label shadow-sm" for="ficha_{{ $ficha->id }}">
                                                <span class="ficha-num">{{ $ficha->numero }}</span>
                                                <i class="fas fa-check-circle check-icon"></i>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Tables Section -->
                        <div id="tabla-aprendices" style="display:none">
                            <hr class="my-5 opacity-10">
                            <h5 class="fw-bold mb-4 text-primary"><i class="fas fa-user-graduate me-2"></i>Detalle por Ficha / Aprendiz</h5>
                            <div id="contenedor-tablas"></div>
                        </div>
                        
                        <textarea name="desarrollo" id="desarrollo" style="display:none"></textarea>
                        <input type="hidden" id="fichas-data" name="fichas_data" value="">
                    </div>
                </div>

                <!-- SECTION 4: Conclusiones y Compromisos -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeIn">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-handshake-angle fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">4. Conclusiones y Compromisos</h4>
                            <p class="text-white-50 mb-0 small">Resultados finales y tareas asignadas</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-modern">Conclusiones</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-clipboard-check icon-left"></i>
                                    <textarea name="conclusiones" class="form-control-modern pt-3" rows="4" placeholder="Se concluye que..."></textarea>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-tasks me-2"></i>Compromisos</h5>
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" id="add-compromiso">
                                        <i class="fas fa-plus me-1"></i> Agregar Compromiso
                                    </button>
                                </div>
                                <div id="compromisos-container">
                                    <!-- Aquí se agregarán los compromisos -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 5: Participantes -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeIn">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-users-viewfinder fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">5. Participantes</h4>
                            <p class="text-white-50 mb-0 small">Listado de asistentes y evidencia</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-modern">Participantes (Nombres de asistentes)</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-users icon-left"></i>
                                    <textarea name="asistentes" class="form-control-modern pt-3" rows="3" placeholder="Nombre Apellido - Rol...">{{ isset($solicitud) ? $solicitud->reportado_por . " - Instructor Reportante" : "" }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label-modern">Participantes Invitados (Opcional)</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-user-plus icon-left"></i>
                                    <textarea name="participantes" class="form-control-modern pt-3" rows="2" placeholder="Nombres de otros invitados...">{{ isset($solicitud) ? $solicitud->aprendiz_nombre . " - Aprendiz" : "" }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label-modern">Evidencia de Asistencia (Imagen o PDF)</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-file-arrow-up icon-left"></i>
                                    <input type="file" name="evidencia_asistentes" class="form-control-modern">
                                </div>
                                <p class="text-muted small mt-2">Adjunte el listado de asistencia firmado o capturas de pantalla.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-center gap-3 mb-5">
                    <button type="submit" class="btn-modern primary shadow-lg px-5">
                        <i class="fas fa-save me-2"></i> Guardar Acta
                    </button>
                    <a href="{{ route('actas.index') }}" class="btn-modern secondary px-5">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    .fw-bold { font-weight: 700; }
    .fw-black { font-weight: 800; }
    .tracking-tight { letter-spacing: -0.025em; }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    }

    /* Modern Form Controls */
    .form-label-modern {
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 0.75rem;
        display: block;
    }

    .input-group-modern {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-group-modern .icon-left {
        position: absolute;
        left: 1.25rem;
        color: #94a3b8;
        transition: color 0.3s;
    }

    .form-control-modern {
        width: 100%;
        padding: 0.85rem 1rem 0.85rem 3rem;
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.3s;
    }

    .form-control-modern:focus {
        background-color: #fff;
        border-color: #4e73df;
        box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.1);
        outline: none;
    }

    .form-control-modern:focus + .icon-left {
        color: #4e73df;
    }

    /* Buttons */
    .btn-modern {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-modern.primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
    }

    .btn-modern.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(78, 115, 223, 0.4);
    }

    .btn-modern.secondary {
        background-color: #f1f5f9;
        color: #475569;
    }

    .btn-modern.secondary:hover {
        background-color: #e2e8f0;
    }

    /* Ficha Selection */
    .ficha-selection-card {
        cursor: pointer;
    }

    .ficha-label {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.25rem;
        background-color: white;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
    }

    .ficha-checkbox:checked + .ficha-label {
        border-color: #4e73df;
        background-color: #eff6ff;
    }

    .ficha-num {
        font-weight: 800;
        color: #1e293b;
        margin-right: 0.75rem;
    }

    .check-icon {
        color: #4e73df;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.2s;
    }

    .ficha-checkbox:checked + .ficha-label .check-icon {
        opacity: 1;
        transform: scale(1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fichasCheckboxes = document.querySelectorAll('.ficha-checkbox');
        const tablaAprendices = document.getElementById('tabla-aprendices');
        const contenedorTablas = document.getElementById('contenedor-tablas');
        const fichasDataInput = document.getElementById('fichas-data');
        const addCompromisoBtn = document.getElementById('add-compromiso');
        const compromisosContainer = document.getElementById('compromisos-container');
        
        let selectedFichasData = {};
        let compromisoCount = 0;

        // Cargar aprendices cuando se selecciona una ficha
        fichasCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateFichasView();
            });
            // Si viene pre-seleccionada
            if (checkbox.checked) {
                updateFichasView();
            }
        });

        async function updateFichasView() {
            const selectedFichas = Array.from(fichasCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selectedFichas.length > 0) {
                tablaAprendices.style.display = 'block';
                
                // Limpiar contenedores que ya no están seleccionados
                const currentContainerIds = Array.from(contenedorTablas.children).map(child => child.id.replace('ficha-table-', ''));
                currentContainerIds.forEach(id => {
                    if (!selectedFichas.includes(id)) {
                        document.getElementById(`ficha-table-${id}`).remove();
                        delete selectedFichasData[id];
                    }
                });

                // Agregar nuevos contenedores
                for (const fichaId of selectedFichas) {
                    if (!document.getElementById(`ficha-table-${fichaId}`)) {
                        await createFichaTable(fichaId);
                    }
                }
            } else {
                tablaAprendices.style.display = 'none';
                contenedorTablas.innerHTML = '';
                selectedFichasData = {};
            }
            updateHiddenInput();
        }

        async function createFichaTable(fichaId) {
            const label = document.querySelector(`label[for="ficha_${fichaId}"]`).innerText;
            const response = await fetch(`/fichas/${fichaId}/aprendices`);
            const aprendices = await response.json();

            const tableHtml = `
                <div class="card border mb-4 rounded-4 overflow-hidden animate__animated animate__fadeIn" id="ficha-table-${fichaId}">
                    <div class="card-header bg-slate-800 text-white p-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">Ficha: ${label}</h6>
                        <span class="badge bg-primary">Aprendices: ${aprendices.length}</span>
                    </div>
                    <div class="p-4 bg-light border-bottom">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Título para la tabla en el Acta</label>
                                <input type="text" class="form-control form-control-sm border-2 rounded-3" 
                                    onchange="updateFichaMetadata(${fichaId}, 'titulo_tabla', this.value)"
                                    placeholder="Ej: Aprendices con faltas injustificadas"
                                    value="Aprendices que aún no aprueban trimestre de la etapa lectiva">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Novedad / Motivo</label>
                                <input type="text" class="form-control form-control-sm border-2 rounded-3" 
                                    onchange="updateFichaMetadata(${fichaId}, 'novedad', this.value)"
                                    placeholder="Ej: Deserción">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Instructor Reporta</label>
                                <input type="text" class="form-control form-control-sm border-2 rounded-3" 
                                    onchange="updateFichaMetadata(${fichaId}, 'instructor', this.value)"
                                    placeholder="Nombre del instructor">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted text-uppercase mb-2 d-block">Evidencia Soporte</label>
                                <input type="text" class="form-control form-control-sm border-2 rounded-3" 
                                    onchange="updateFichaMetadata(${fichaId}, 'evidencia', this.value)"
                                    placeholder="Ej: Formato de inasistencia">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0 align-middle">
                            <thead class="bg-white">
                                <tr class="small text-muted text-uppercase fw-bold">
                                    <th class="ps-4">No</th>
                                    <th>Aprendiz</th>
                                    <th>Documento</th>
                                    <th>Acción / Evidencia Individual</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${aprendices.map((a, i) => `
                                    <tr>
                                        <td class="ps-4 text-muted">${i+1}</td>
                                        <td class="fw-bold">${a.nombre}</td>
                                        <td>${a.identificacion}</td>
                                        <td class="pe-4">
                                            <input type="text" class="form-control form-control-sm border-0 bg-white" 
                                                placeholder="Observación individual..."
                                                onchange="updateAprendizData(${fichaId}, ${a.id}, 'evidencia', this.value)">
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
            contenedorTablas.insertAdjacentHTML('beforeend', tableHtml);
            
            selectedFichasData[fichaId] = {
                titulo_tabla: 'Aprendices que aún no aprueban trimestre de la etapa lectiva',
                novedad: '',
                instructor: '',
                evidencia: '',
                aprendices_data: {}
            };
        }

        window.updateFichaMetadata = function(fichaId, field, value) {
            if (selectedFichasData[fichaId]) {
                selectedFichasData[fichaId][field] = value;
                updateHiddenInput();
            }
        };

        window.updateAprendizData = function(fichaId, aprendizId, field, value) {
            if (selectedFichasData[fichaId]) {
                if (!selectedFichasData[fichaId].aprendices_data[aprendizId]) {
                    selectedFichasData[fichaId].aprendices_data[aprendizId] = {};
                }
                selectedFichasData[fichaId].aprendices_data[aprendizId][field] = value;
                updateHiddenInput();
            }
        };

        function updateHiddenInput() {
            fichasDataInput.value = JSON.stringify(selectedFichasData);
        }

        // Manejo de Compromisos
        addCompromisoBtn.addEventListener('click', function() {
            const html = `
                <div class="compromiso-item mb-3 animate__animated animate__fadeIn">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group-modern">
                                <i class="fas fa-comment-dots icon-left"></i>
                                <input type="text" name="compromisos[${compromisoCount}][actividad]" class="form-control-modern" placeholder="Actividad">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group-modern">
                                <i class="fas fa-user-tag icon-left"></i>
                                <input type="text" name="compromisos[${compromisoCount}][responsable]" class="form-control-modern" placeholder="Responsable">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group-modern">
                                <i class="fas fa-calendar-day icon-left"></i>
                                <input type="date" name="compromisos[${compromisoCount}][fecha]" class="form-control-modern">
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" class="btn btn-link text-danger remove-compromiso">
                                <i class="fas fa-trash-can fs-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            compromisosContainer.insertAdjacentHTML('beforeend', html);
            compromisoCount++;
        });

        compromisosContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-compromiso')) {
                e.target.closest('.compromiso-item').remove();
            }
        });
    });
</script>
@endsection
