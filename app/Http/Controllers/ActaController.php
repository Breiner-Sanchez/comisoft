<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ActaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:coordinacion')->only(['destroy']);
    }

    public function index()
    {
        $query = Acta::with('solicitud')
            ->whereIn('estado', ['borrador', 'final']);

        if (Auth::user()->isInstructor()) {
            $query->where('user_id', Auth::id());
        }

        $actas = $query->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('actas.index', compact('actas'));
    }

    public function create()
    {
        $fichas = \App\Models\Ficha::all();
        return view('actas.create', compact('fichas'));
    }

    public function createFromSolicitud(Solicitud $solicitud)
    {
        $fichas = \App\Models\Ficha::all();
        return view('actas.create', compact('fichas', 'solicitud'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'acta_numero'   => 'required',
            'acta_año'      => 'required',
            'fecha'         => 'required|date',
            'evidencia_asistentes' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,doc|max:5120',
        ]);

        $numero_acta = $request->acta_numero . '-' . $request->acta_año;

        if (Acta::where('numero_acta', $numero_acta)->exists()) {
            return back()->withErrors(['acta_numero' => 'El número de acta ' . $numero_acta . ' ya existe.'])->withInput();
        }

        $evidenciaPath = null;
        if ($request->hasFile('evidencia_asistentes')) {
            $evidenciaPath = $request->file('evidencia_asistentes')->store('evidencias', 'public');
        }

        $acta = Acta::create([
            'solicitud_id'  => $request->solicitud_id,
            'numero_acta'   => $numero_acta,
            'acta_numero'   => $request->acta_numero,
            'acta_año'      => $request->acta_año,
            'titulo'        => $request->nombre_comite ?? 'Acta de Comité',
            'nombre_comite' => $request->nombre_comite,
            'ciudad'        => $request->ciudad,
            'fecha'         => $request->fecha,
            'hora_inicio'   => $request->hora_inicio,
            'hora_fin'      => $request->hora_fin,
            'lugar'         => $request->lugar,
            'direccion'     => $request->direccion,
            'regional'      => $request->regional,
            'centro'        => $request->centro_formacion ?? $request->centro,
            'agenda'        => $request->agenda,
            'objetivos'     => $request->objetivos,
            'descripcion_desarrollo' => $request->descripcion_desarrollo,
            'desarrollo'    => $request->desarrollo,
            'conclusiones'  => $request->conclusiones,
            'compromisos'   => is_array($request->compromisos) ? $request->compromisos : [],
            'asistentes'    => $request->asistentes ?? '',
            'evidencia_asistentes' => $evidenciaPath,
            'participantes' => $request->participantes ?? '',
            'estado'        => $request->estado ?? 'borrador',
            'user_id'       => Auth::id(),
        ]);

        if ($request->solicitud_id) {
            Solicitud::where('id', $request->solicitud_id)->update(['estado' => 'procesada']);
        }

        if ($request->has('fichas_data') && !empty($request->fichas_data)) {
            $jsonData = json_decode($request->fichas_data, true);
            if (is_array($jsonData)) {
                $fichasData = [];
                foreach ($jsonData as $fichaId => $data) {
                    $fichasData[$fichaId] = [
                        'tema' => $data['titulo_tabla'] ?? 'Aprendices que aún no aprueban trimestre de la etapa lectiva',
                        'novedad' => $data['novedad'] ?? '',
                        'instructor' => $data['instructor'] ?? '',
                        'evidencia' => $data['evidencia'] ?? '',
                        'aprendices_data' => isset($data['aprendices_data']) ? json_encode($data['aprendices_data']) : null,
                    ];
                }
                $acta->fichas()->attach($fichasData);
            }
        }

        return redirect()
            ->route('actas.index')
            ->with('success', 'Acta creada correctamente')
            ->with('acta_id', $acta->id);
    }

    public function show(Acta $acta)
    {
        if (Auth::user()->isInstructor() && $acta->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta acta.');
        }
        $acta->load('solicitud');
        return view('actas.show', compact('acta'));
    }

    public function edit(Acta $acta)
    {
        if (Auth::user()->isInstructor() && $acta->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta acta.');
        }
        $fichas = \App\Models\Ficha::all();
        $acta->load('solicitud');
        return view('actas.edit', compact('acta', 'fichas'));
    }

    public function update(Request $request, Acta $acta)
    {
        if (Auth::user()->isInstructor() && $acta->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta acta.');
        }
        $request->validate([
            'acta_numero'   => 'required',
            'acta_año'      => 'required',
            'fecha'         => 'required|date',
            'evidencia_asistentes' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx,doc|max:5120',
        ]);

        $numero_acta = $request->acta_numero . '-' . $request->acta_año;

        if (Acta::where('numero_acta', $numero_acta)->where('id', '!=', $acta->id)->exists()) {
            return back()->withErrors(['acta_numero' => 'El número de acta ' . $numero_acta . ' ya existe.'])->withInput();
        }

        $evidenciaPath = $acta->evidencia_asistentes;
        if ($request->hasFile('evidencia_asistentes')) {
            if ($acta->evidencia_asistentes && \Storage::disk('public')->exists($acta->evidencia_asistentes)) {
                \Storage::disk('public')->delete($acta->evidencia_asistentes);
            }
            $evidenciaPath = $request->file('evidencia_asistentes')->store('evidencias', 'public');
        }

        $acta->update([
            'numero_acta'   => $numero_acta,
            'acta_numero'   => $request->acta_numero,
            'acta_año'      => $request->acta_año,
            'titulo'        => $request->nombre_comite ?? $acta->titulo,
            'nombre_comite' => $request->nombre_comite,
            'ciudad'        => $request->ciudad,
            'fecha'         => $request->fecha,
            'hora_inicio'   => $request->hora_inicio,
            'hora_fin'      => $request->hora_fin,
            'lugar'         => $request->lugar,
            'direccion'     => $request->direccion,
            'regional'      => $request->regional,
            'centro'        => $request->centro_formacion ?? $request->centro,
            'agenda'        => $request->agenda,
            'objetivos'     => $request->objetivos,
            'descripcion_desarrollo' => $request->descripcion_desarrollo,
            'desarrollo'    => $request->desarrollo,
            'conclusiones'  => $request->conclusiones,
            'compromisos'   => is_array($request->compromisos) ? $request->compromisos : [],
            'asistentes'    => $request->asistentes ?? '',
            'evidencia_asistentes' => $evidenciaPath,
            'participantes' => $request->participantes ?? '',
            'estado'        => $request->estado ?? 'borrador',
        ]);

        if ($request->has('fichas_data') && !empty($request->fichas_data)) {
            $jsonData = json_decode($request->fichas_data, true);
            if (is_array($jsonData)) {
                $fichasData = [];
                foreach ($jsonData as $fichaId => $data) {
                    $fichasData[$fichaId] = [
                        'tema' => $data['titulo_tabla'] ?? 'Aprendices que aún no aprueban trimestre de la etapa lectiva',
                        'novedad' => $data['novedad'] ?? '',
                        'instructor' => $data['instructor'] ?? '',
                        'evidencia' => $data['evidencia'] ?? '',
                        'aprendices_data' => isset($data['aprendices_data']) ? json_encode($data['aprendices_data']) : null,
                    ];
                }
                $acta->fichas()->sync($fichasData);
            }
        }

        return redirect()
            ->route('actas.index')
            ->with('success', 'Acta actualizada correctamente')
            ->with('acta_id', $acta->id);
    }

    public function pdf(Acta $acta)
    {
        if (Auth::user()->isInstructor() && $acta->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver el PDF de esta acta.');
        }
        $acta->load('solicitud');
        $pdf = \PDF::loadView('actas.pdf', compact('acta'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream(
            'acta_' . $acta->numero_acta . '.pdf'
        );
    }

    public function aprendices($id)
    {
        $aprendices = \App\Models\Aprendiz::where('ficha_id', $id)->get();
        return response()->json($aprendices);
    }

    public function destroy(Acta $acta)
    {
        if ($acta->evidencia_asistentes && \Storage::disk('public')->exists($acta->evidencia_asistentes)) {
            \Storage::disk('public')->delete($acta->evidencia_asistentes);
        }
        $acta->delete();
        return redirect()->route('actas.index')->with('success', 'Acta eliminada correctamente');
    }
}
