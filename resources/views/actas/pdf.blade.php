<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acta {{ $acta->acta_numero }}</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }
        .table-container {
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: -1px; /* Evita bordes dobles entre filas */
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
            word-wrap: break-word;
        }
        .p-0 { padding: 0 !important; }
        .no-border { border: none !important; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        
        .ficha-table th, .ficha-table td {
            font-size: 8.5px;
            padding: 4px;
        }
        .section-header {
            text-align: center;
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .content-box {
            padding: 5px;
            min-height: 20px;
        }
    </style>
</head>
<body>

<div class="table-container">
    <table>
        {{-- ACTA No. --}}
        <tr>
            <th colspan="3" class="text-center py-2" style="background-color: #f2f2f2;">
                ACTA No. {{ $acta->acta_numero }} - {{ $acta->acta_año }}
            </th>
        </tr>

        {{-- LOGO --}}
        <tr>
            <td colspan="3" class="text-center" style="border-top: none; padding: 15px;">
                <img src="{{ public_path('images/Sena_Logo.png') }}" alt="SENA" style="width: 55px;">
            </td>
        </tr>

        {{-- NOMBRE DEL COMITÉ --}}
        <tr>
            <td colspan="3">
                <span class="fw-bold">NOMBRE DEL COMITÉ O DE LA REUNIÓN:</span><br>
                <span>{{ $acta->nombre_comite }}</span>
            </td>
        </tr>

        {{-- CIUDAD, FECHA, HORA --}}
        <tr>
            <td style="width: 40%;">
                <span class="fw-bold">CIUDAD Y FECHA:</span> {{ $acta->ciudad }} {{ \Carbon\Carbon::parse($acta->fecha)->format('d/m/Y') }}
            </td>
            <td style="width: 30%;">
                <span class="fw-bold">HORA INICIO:</span> {{ \Carbon\Carbon::parse($acta->hora_inicio)->format('H:i') }}
            </td>
            <td style="width: 30%;">
                <span class="fw-bold">HORA FIN:</span> {{ \Carbon\Carbon::parse($acta->hora_fin)->format('H:i') }}
            </td>
        </tr>

        {{-- LUGAR, DIRECCIÓN, REGIONAL, CENTRO --}}
        <tr>
            <td style="width: 40%;">
                <span class="fw-bold">LUGAR Y/O ENLACE:</span> {{ $acta->lugar }}
            </td>
            <td colspan="2">
                <span class="fw-bold">DIRECCIÓN / REGIONAL / CENTRO:</span> {{ $acta->regional }}
            </td>
        </tr>

        {{-- AGENDA --}}
        <tr>
            <td colspan="3">
                <span class="fw-bold">AGENDA O PUNTOS PARA DESARROLLAR:</span><br>
                <span>{!! nl2br(e($acta->agenda)) !!}</span>
            </td>
        </tr>

        {{-- OBJETIVOS --}}
        <tr>
            <td colspan="3">
                <span class="fw-bold">OBJETIVO(S) DE LA REUNIÓN:</span><br>
                <span>{!! nl2br(e($acta->objetivos)) !!}</span>
            </td>
        </tr>

        {{-- SOLICITUD INICIAL --}}
        @if($acta->solicitud)
        <tr>
            <td colspan="3" class="section-header">
                INFORMACIÓN DE LA SOLICITUD INICIAL
            </td>
        </tr>
        <tr>
            <td style="width: 40%;">
                <span class="fw-bold">REPORTADO POR:</span><br>
                {{ $acta->solicitud->reportado_por }}<br>
                <small>{{ $acta->solicitud->correo_reporte }}</small>
            </td>
            <td colspan="2">
                <span class="fw-bold">APRENDIZ INVOLUCRADO:</span><br>
                {{ $acta->solicitud->aprendiz_nombre }} - {{ $acta->solicitud->aprendiz_documento }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="fw-bold">MOTIVO DE LA SOLICITUD:</span><br>
                <span>{!! nl2br(e($acta->solicitud->motivo_solicitud)) !!}</span>
            </td>
        </tr>
        @endif

        {{-- DESARROLLO DE LA REUNIÓN --}}
        <tr>
            <td colspan="3" class="section-header">
                DESARROLLO DE LA REUNIÓN
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="content" style="margin-bottom: 10px;">{!! nl2br(e($acta->descripcion_desarrollo)) !!}</div>
                
                @foreach($acta->fichas as $ficha)
                    <div style="margin-top: 15px;">
                        <span class="fw-bold">Ficha {{ $ficha->numero }} – {{ $ficha->programa }}</span>
                        
                        <table class="ficha-table" style="margin-top: 5px;">
                            <thead>
                                <tr>
                                    <th colspan="7" style="background-color: #fff; text-align: center;">{{ $ficha->pivot->tema ?? 'Aprendices que aún no aprueban trimestre de la etapa lectiva' }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 18%">Nombre</th>
                                    <th style="width: 15%">Identificación</th>
                                    <th style="width: 18%">Correo electrónico</th>
                                    <th style="width: 18%">Descripción de la novedad</th>
                                    <th style="width: 13%">Nombre del Instructor</th>
                                    <th style="width: 13%">Evidencia soporte de la novedad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $aprendices = \App\Models\Aprendiz::where('ficha_id', $ficha->id)->get();
                                    $aprendicesData = null;
                                    if ($ficha->pivot->aprendices_data) {
                                        $aprendicesData = json_decode($ficha->pivot->aprendices_data, true);
                                    }
                                @endphp
                                @if($aprendices->count() > 0)
                                    @foreach($aprendices as $key => $aprendiz)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $aprendiz->nombre }}</td>
                                        <td>{{ $aprendiz->identificacion }}</td>
                                        <td>{{ $aprendiz->email }}</td>
                                        
                                        @if($key === 0)
                                            <td rowspan="{{ $aprendices->count() }}">{{ $ficha->pivot->novedad }}</td>
                                            <td rowspan="{{ $aprendices->count() }}">{{ $ficha->pivot->instructor }}</td>
                                            @if(!$aprendicesData)
                                                <td rowspan="{{ $aprendices->count() }}">{{ $ficha->pivot->evidencia }}</td>
                                            @endif
                                        @endif

                                        @if($aprendicesData)
                                            <td>{{ $aprendicesData[$aprendiz->id]['evidencia'] ?? '' }}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No hay aprendices registrados</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </td>
        </tr>

        {{-- CONCLUSIONES --}}
        <tr>
            <td colspan="3">
                <span class="fw-bold">CONCLUSIONES:</span><br>
                <span>{!! nl2br(e($acta->conclusiones)) !!}</span>
            </td>
        </tr>

        {{-- COMPROMISOS --}}
        <tr>
            <td colspan="3" class="p-0">
                <span class="fw-bold" style="padding: 5px; display: block; border-bottom: 1px solid #000;">COMPROMISOS / DECISIONES:</span>
                @if(is_array($acta->compromisos) && count($acta->compromisos) > 0)
                    <table class="ficha-table no-border" style="width: 100%;">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th style="width: 40%; border-left: none; border-top: none;">ACTIVIDAD / COMPROMISO</th>
                                <th style="width: 30%; border-top: none;">RESPONSABLE</th>
                                <th style="width: 15%; border-top: none;">FECHA</th>
                                <th style="width: 15%; border-top: none; border-right: none;">FIRMA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($acta->compromisos as $item)
                                @if(!empty($item['actividad']) || !empty($item['responsable']))
                                <tr>
                                    <td style="border-left: none;">{!! nl2br(e($item['actividad'])) !!}</td>
                                    <td>{!! nl2br(e($item['responsable'])) !!}</td>
                                    <td class="text-center">{{ $item['fecha'] }}</td>
                                    <td style="border-right: none;">{{ $item['firma'] ?? '' }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <span style="padding: 5px; display: block;">{!! nl2br(e($acta->compromisos)) !!}</span>
                @endif
            </td>
        </tr>

        {{-- ASISTENTES --}}
        <tr>
            <td colspan="3">
                <span class="fw-bold">ASISTENTES:</span><br>
                <span>{!! nl2br(e($acta->asistentes)) !!}</span>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
