@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container py-5 px-md-5">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Editar Acta de Reunión</h2>
                <p class="text-muted">Actualice la información detallada del acta</p>
            </div>
            <a href="{{ route('actas.index') }}" class="btn-modern secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver al listado
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <form action="{{ route('actas.update', $acta) }}" method="POST" id="form-acta" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                                    <input type="text" name="acta_numero" class="form-control-modern" value="{{ $acta->acta_numero }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label-modern">Año *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar icon-left"></i>
                                    <input type="text" name="acta_año" class="form-control-modern" value="{{ $acta->acta_año }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Nombre del Comité / Reunión</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-heading icon-left"></i>
                                    <input type="text" name="nombre_comite" class="form-control-modern" value="{{ $acta->nombre_comite }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-modern">Ciudad</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-location-dot icon-left"></i>
                                    <input type="text" name="ciudad" class="form-control-modern" value="{{ $acta->ciudad }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-modern">Fecha *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar-day icon-left"></i>
                                    <input type="date" name="fecha" class="form-control-modern" value="{{ $acta->fecha }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label-modern">Hora Inicio</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-clock icon-left"></i>
                                    <input type="time" name="hora_inicio" class="form-control-modern" value="{{ $acta->hora_inicio }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label-modern">Hora Fin</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-clock-rotate-left icon-left"></i>
                                    <input type="time" name="hora_fin" class="form-control-modern" value="{{ $acta->hora_fin }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Lugar y/o Enlace</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-link icon-left"></i>
                                    <input type="text" name="lugar" class="form-control-modern" value="{{ $acta->lugar }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Dirección / Regional / Centro</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-building icon-left"></i>
                                    <input type="text" name="regional" class="form-control-modern" value="{{ $acta->regional }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-modern">Estado del Acta *</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-toggle-on icon-left"></i>
                                    <select name="estado" class="form-control-modern" required>
                                        <option value="borrador" {{ $acta->estado == 'borrador' || $acta->estado == 'solicitud' ? 'selected' : '' }}>Borrador</option>
                                        <option value="final" {{ $acta->estado == 'final' ? 'selected' : '' }}>Finalizada</option>
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
                                    <textarea name="agenda" class="form-control-modern pt-3" rows="4">{{ $acta->agenda }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label-modern">Objetivo(s) de la reunión</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-crosshairs icon-left"></i>
                                    <textarea name="objetivos" class="form-control-modern pt-3" rows="3">{{ $acta->objetivos }}</textarea>
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
                                    <textarea name="descripcion_desarrollo" class="form-control-modern pt-3" rows="6">{{ $acta->descripcion_desarrollo }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-tags me-2"></i>Fichas Relacionadas</h5>
                                <div id="fichas-container" class="p-4 bg-light rounded-4 border border-dashed d-flex flex-wrap gap-3" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($fichas as $ficha)
                                        <div class="ficha-selection-card">
                                            <input class="form-check-input ficha-checkbox d-none" type="checkbox" value="{{ $ficha->id }}" id="ficha_{{ $ficha->id }}" name="fichas[]" @if($acta->fichas->contains('id', $ficha->id)) checked @endif>
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
                                    <textarea name="conclusiones" class="form-control-modern pt-3" rows="4">{{ $acta->conclusiones }}</textarea>
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
                                    @if(is_array($acta->compromisos) && count($acta->compromisos) > 0)
                                        @foreach($acta->compromisos as $index => $compromiso)
                                            <div class="compromiso-item mb-3 animate__animated animate__fadeIn">
                                                <div class="row g-3">
                                                    <div class="col-md-5">
                                                        <div class="input-group-modern">
                                                            <i class="fas fa-comment-dots icon-left"></i>
                                                            <input type="text" name="compromisos[{{ $index }}][actividad]" class="form-control-modern" value="{{ $compromiso['actividad'] ?? '' }}" placeholder="Actividad">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group-modern">
                                                            <i class="fas fa-user-tag icon-left"></i>
                                                            <input type="text" name="compromisos[{{ $index }}][responsable]" class="form-control-modern" value="{{ $compromiso['responsable'] ?? '' }}" placeholder="Responsable">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group-modern">
                                                            <i class="fas fa-calendar-check icon-left"></i>
                                                            <input type="date" name="compromisos[{{ $index }}][fecha]" class="form-control-modern" value="{{ $compromiso['fecha'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-center">
                                                        <button type="button" class="btn btn-link text-danger remove-compromiso">
                                                            <i class="fas fa-trash-can fs-5"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 5: Cierre y Asistentes -->
                <div class="card border-0 shadow-2xl rounded-5 overflow-hidden mb-5 animate__animated animate__fadeIn">
                    <div class="card-header border-0 py-4 px-5 bg-primary bg-gradient d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle me-4">
                            <i class="fas fa-file-signature fs-3 text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 text-white fw-bold tracking-tight">5. Cierre y Asistentes</h4>
                            <p class="text-white-50 mb-0 small">Finalización y registro de participantes</p>
                        </div>
                    </div>
                    <div class="card-body p-5 bg-white">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label-modern">Participantes (Asistentes registrados)</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-users icon-left"></i>
                                    <textarea name="asistentes" class="form-control-modern pt-3" rows="3" placeholder="Nombres de los asistentes">{{ $acta->asistentes }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label-modern">Evidencia de Asistencia (Imagen o PDF)</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-cloud-upload-alt icon-left"></i>
                                    <input type="file" name="evidencia_asistentes" class="form-control-modern" accept="image/*,.pdf">
                                </div>
                                @if($acta->evidencia_asistentes)
                                    <div class="mt-2 p-2 bg-light rounded-3 d-inline-block">
                                        <i class="fas fa-paperclip me-2"></i>
                                        <span class="small">Archivo actual: {{ basename($acta->evidencia_asistentes) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-5 d-flex justify-content-center">
                            <button type="submit" class="btn-modern success px-5 py-3 fs-5 shadow-lg">
                                <i class="fas fa-save me-2"></i> Guardar Todos los Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --accent-color: #3b82f6;
    }

    body {
        background-color: #f1f5f9;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    }

    .rounded-5 { border-radius: 2rem !important; }

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
        border-color: #3b82f6;
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1);
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
        color: #3b82f6;
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

    textarea.form-control-modern {
        min-height: 100px;
    }

    /* Ficha selection cards */
    .ficha-selection-card {
        cursor: pointer;
    }

    .ficha-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        background: #fff;
        border: 2px solid #e2e8f0;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s;
        min-width: 140px;
    }

    .ficha-num {
        font-weight: 800;
        color: #475569;
        font-size: 1.1rem;
    }

    .check-icon {
        color: #e2e8f0;
        font-size: 1.2rem;
        transition: all 0.3s;
    }

    .ficha-checkbox:checked + .ficha-label {
        border-color: #10b981;
        background: #f0fdf4;
    }

    .ficha-checkbox:checked + .ficha-label .ficha-num {
        color: #065f46;
    }

    .ficha-checkbox:checked + .ficha-label .check-icon {
        color: #10b981;
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

    .btn-modern.primary { background: #3b82f6; color: #fff; }
    .btn-modern.secondary { background: #64748b; color: #fff; }
    .btn-modern.success { background: #10b981; color: #fff; }

    .btn-modern:hover {
        transform: translateY(-3px);
        filter: brightness(1.1);
        box-shadow: 0 15px 25px -5px rgba(0,0,0,0.1);
    }

    .tracking-tight { letter-spacing: -0.025em; }

    /* Dynamic Table Styles */
    .table-ficha-card {
        background: #fff;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid #f1f5f9;
    }

    .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #64748b;
        background: #f8fafc;
    }

    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Compromisos Logic ---
    let compromisoIndex = {{ count($acta->compromisos ?? []) }};
    const compromisosContainer = document.getElementById('compromisos-container');
    const addCompromisoBtn = document.getElementById('add-compromiso');

    addCompromisoBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'compromiso-item mb-3 animate__animated animate__fadeIn';
        div.innerHTML = `
            <div class="row g-3">
                <div class="col-md-5">
                    <div class="input-group-modern">
                        <i class="fas fa-comment-dots icon-left"></i>
                        <input type="text" name="compromisos[${compromisoIndex}][actividad]" class="form-control-modern" placeholder="Actividad">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group-modern">
                        <i class="fas fa-user-tag icon-left"></i>
                        <input type="text" name="compromisos[${compromisoIndex}][responsable]" class="form-control-modern" placeholder="Responsable">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group-modern">
                        <i class="fas fa-calendar-check icon-left"></i>
                        <input type="date" name="compromisos[${compromisoIndex}][fecha]" class="form-control-modern">
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-link text-danger remove-compromiso">
                        <i class="fas fa-trash-can fs-5"></i>
                    </button>
                </div>
            </div>
        `;
        compromisosContainer.appendChild(div);
        compromisoIndex++;
    });

    compromisosContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-compromiso')) {
            e.target.closest('.compromiso-item').remove();
        }
    });

    // --- Dynamic Fichas & Aprendices Logic ---
    const checkboxes = document.querySelectorAll('.ficha-checkbox');
    
    const existingFichasData = {
        @foreach($acta->fichas as $ficha)
            "{{ $ficha->id }}": {
                "titulo_tabla": "{!! addslashes($ficha->pivot->tema) !!}",
                "novedad": "{!! addslashes($ficha->pivot->novedad) !!}",
                "instructor": "{!! addslashes($ficha->pivot->instructor) !!}",
                "evidencia": "{!! addslashes($ficha->pivot->evidencia) !!}",
                "aprendices_data": {!! $ficha->pivot->aprendices_data ?: 'null' !!}
            },
        @endforeach
    };

    document.getElementById('form-acta').addEventListener('submit', function(e) {
        const fichasData = {};
        const selectedCheckboxes = Array.from(checkboxes).filter(cb => cb.checked);
        
        selectedCheckboxes.forEach(checkbox => {
            const fichaId = checkbox.value;
            const fichaContainer = document.querySelector(`[data-ficha-id="${fichaId}"]`);
            if (fichaContainer) {
                const tituloTabla = fichaContainer.querySelector('.titulo-tabla-input')?.value || '';
                const isIndividual = fichaContainer.querySelector('.mode-toggle')?.checked || false;
                
                let novedad = '';
                let instructor = '';
                let evidencia = '';
                let aprendicesData = null;
                
                if (isIndividual) {
                    aprendicesData = {};
                    novedad = fichaContainer.querySelector('.novedad-input')?.value || '';
                    instructor = fichaContainer.querySelector('.instructor-input')?.value || '';
                    
                    const rows = fichaContainer.querySelectorAll('tbody tr[data-aprendiz-id]');
                    rows.forEach(row => {
                        const aprendizId = row.getAttribute('data-aprendiz-id');
                        aprendicesData[aprendizId] = {
                            evidencia: row.querySelector('.evidencia-input-ind')?.value || ''
                        };
                    });
                } else {
                    novedad = fichaContainer.querySelector('.novedad-input')?.value || '';
                    instructor = fichaContainer.querySelector('.instructor-input')?.value || '';
                    evidencia = fichaContainer.querySelector('.evidencia-input')?.value || '';
                }
                
                fichasData[fichaId] = {
                    titulo_tabla: tituloTabla,
                    is_individual: isIndividual,
                    novedad: novedad,
                    instructor: instructor,
                    evidencia: evidencia,
                    aprendices_data: aprendicesData
                };
            }
        });
        
        document.getElementById('fichas-data').value = JSON.stringify(fichasData);
    });
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateTables();
        });
    });

    function updateTables() {
        const selectedCheckboxes = Array.from(checkboxes).filter(cb => cb.checked);
        if (selectedCheckboxes.length > 0) {
            cargarAprendices(selectedCheckboxes);
        } else {
            document.getElementById('tabla-aprendices').style.display = 'none';
        }
    }

    updateTables();

    function cargarAprendices(selectedCheckboxes) {
        const tabla = document.getElementById('tabla-aprendices');
        const contenedor = document.getElementById('contenedor-tablas');
        
        contenedor.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted fw-bold">Actualizando información de fichas...</p></div>';
        tabla.style.display = 'block';
        
        let aprendicesPorFicha = {};
        let fichasInfo = {};
        let promisesCount = 0;
        let completedCount = 0;
        
        selectedCheckboxes.forEach(checkbox => {
            const fichaId = checkbox.value;
            const fichaLabel = checkbox.nextElementSibling.querySelector('.ficha-num').textContent.trim();
            fichasInfo[fichaId] = fichaLabel;
            
            promisesCount++;
            
            fetch(`/fichas/${fichaId}/aprendices`)
                .then(res => res.json())
                .then(data => {
                    if (Array.isArray(data)) {
                        aprendicesPorFicha[fichaId] = data;
                    }
                    completedCount++;
                    if (completedCount === promisesCount) {
                        mostrarAprendices(aprendicesPorFicha, fichasInfo, selectedCheckboxes);
                    }
                })
                .catch(error => {
                    aprendicesPorFicha[fichaId] = [];
                    completedCount++;
                    if (completedCount === promisesCount) {
                        mostrarAprendices(aprendicesPorFicha, fichasInfo, selectedCheckboxes);
                    }
                });
        });
    }

    function mostrarAprendices(aprendicesPorFicha, fichasInfo, selectedCheckboxes) {
        const contenedor = document.getElementById('contenedor-tablas');
        contenedor.innerHTML = '';
        
        selectedCheckboxes.forEach(checkbox => {
            const fichaId = checkbox.value;
            const fichaNum = fichasInfo[fichaId];
            const aprendices = aprendicesPorFicha[fichaId] || [];
            const dataAnterior = existingFichasData[fichaId] || {};
            
            const isIndividual = dataAnterior.aprendices_data !== null;
            
            const card = document.createElement('div');
            card.className = 'table-ficha-card animate__animated animate__fadeIn';
            card.setAttribute('data-ficha-id', fichaId);
            
            let html = `
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0">
                        <span class="badge bg-primary me-2">Ficha ${fichaNum}</span>
                        Configuración de reporte
                    </h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input mode-toggle" type="checkbox" id="mode_${fichaId}" ${isIndividual ? 'checked' : ''}>
                        <label class="form-check-label small fw-bold" for="mode_${fichaId}">Modo Individual</label>
                    </div>
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label small fw-bold text-muted uppercase">Título de la tabla en el PDF</label>
                        <input type="text" class="form-control titulo-tabla-input" value="${dataAnterior.titulo_tabla || 'Aprendices que aún no aprueban trimestre de la etapa lectiva'}" placeholder="Ej: Reporte de deserción...">
                    </div>
                </div>

                <div class="general-mode" style="display: ${isIndividual ? 'none' : 'block'}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted uppercase">Novedad</label>
                            <input type="text" class="form-control novedad-input" value="${!isIndividual ? (dataAnterior.novedad || '') : ''}" placeholder="Ej: Citación a comité">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted uppercase">Instructor</label>
                            <input type="text" class="form-control instructor-input" value="${!isIndividual ? (dataAnterior.instructor || '') : ''}" placeholder="Nombre del instructor">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted uppercase">Evidencia</label>
                            <input type="text" class="form-control evidencia-input" value="${!isIndividual ? (dataAnterior.evidencia || '') : ''}" placeholder="Ej: Reporte LMS">
                        </div>
                    </div>
                </div>

                <div class="individual-mode" style="display: ${isIndividual ? 'block' : 'none'}">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted uppercase">Novedad (General)</label>
                            <input type="text" class="form-control novedad-input" value="${isIndividual ? (dataAnterior.novedad || '') : ''}" placeholder="Ej: Citación a comité">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted uppercase">Instructor (General)</label>
                            <input type="text" class="form-control instructor-input" value="${isIndividual ? (dataAnterior.instructor || '') : ''}" placeholder="Nombre del instructor">
                        </div>
                    </div>
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="40%">Aprendiz</th>
                                    <th width="60%">Evidencia / Observación Individual</th>
                                </tr>
                            </thead>
                            <tbody>
            `;
            
            aprendices.forEach(ap => {
                const obsAnterior = (isIndividual && dataAnterior.aprendices_data && dataAnterior.aprendices_data[ap.id]) 
                    ? dataAnterior.aprendices_data[ap.id].evidencia 
                    : '';
                    
                html += `
                    <tr data-aprendiz-id="${ap.id}">
                        <td>
                            <div class="fw-bold">${ap.nombre}</div>
                            <div class="small text-muted">${ap.documento}</div>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm evidencia-input-ind" value="${obsAnterior}" placeholder="Especifique evidencia para este aprendiz">
                        </td>
                    </tr>
                `;
            });
            
            if (aprendices.length === 0) {
                html += `<tr><td colspan="2" class="text-center p-4 text-muted small italic">No hay aprendices registrados en esta ficha</td></tr>`;
            }
            
            html += `
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
            
            card.innerHTML = html;
            contenedor.appendChild(card);
            
            // Toggle Logic inside card
            const toggle = card.querySelector('.mode-toggle');
            const genMode = card.querySelector('.general-mode');
            const indMode = card.querySelector('.individual-mode');
            
            toggle.addEventListener('change', function() {
                if (this.checked) {
                    genMode.style.display = 'none';
                    indMode.style.display = 'block';
                } else {
                    genMode.style.display = 'block';
                    indMode.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection
