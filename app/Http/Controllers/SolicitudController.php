<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $solicitudes = Solicitud::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        return view('solicitudes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reportado_por' => 'required',
            'correo_reporte' => 'required|email',
            'aprendiz_nombre' => 'required',
            'aprendiz_documento' => 'required',
            'motivo_solicitud' => 'required',
            'evidencia_archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,doc|max:5120',
        ]);

        $evidenciaArchivoPath = null;
        if ($request->hasFile('evidencia_archivo')) {
            $evidenciaArchivoPath = $request->file('evidencia_archivo')->store('solicitudes', 'public');
        }

        Solicitud::create([
            'user_id' => Auth::id(),
            'reportado_por' => $request->reportado_por,
            'correo_reporte' => $request->correo_reporte,
            'telefono_reporte' => $request->telefono_reporte,
            'programa' => $request->programa,
            'ficha_numero' => $request->ficha_numero,
            'tipo_programa' => $request->tipo_programa,
            'aprendiz_nombre' => $request->aprendiz_nombre,
            'aprendiz_documento' => $request->aprendiz_documento,
            'aprendiz_tipo_doc' => $request->aprendiz_tipo_doc,
            'aprendiz_correo' => $request->aprendiz_correo,
            'aprendiz_telefono' => $request->aprendiz_telefono,
            'aprendiz_estado' => $request->aprendiz_estado,
            'motivo_solicitud' => $request->motivo_solicitud,
            'evidencia_archivo' => $evidenciaArchivoPath,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud enviada correctamente');
    }

    public function show(Solicitud $solicitud)
    {
        return view('solicitudes.show', compact('solicitud'));
    }

    public function reject(Solicitud $solicitud)
    {
        $solicitud->update(['estado' => 'rechazada']);
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud rechazada correctamente');
    }
}
