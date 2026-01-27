<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Aprendiz;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fichas = Ficha::with('aprendices')->orderBy('created_at', 'desc')->get();
        return view('fichas.index', compact('fichas'));
    }

    public function create()
    {
        return view('fichas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:fichas,numero',
            'programa' => 'required|string|max:255',
        ]);

        Ficha::create($request->only('numero', 'programa'));

        return redirect()->route('fichas.index')
            ->with('success', 'Ficha creada correctamente');
    }

    public function show(Ficha $ficha)
    {
        $ficha->load('aprendices');
        return view('fichas.show', compact('ficha'));
    }

    public function edit(Ficha $ficha)
    {
        return view('fichas.edit', compact('ficha'));
    }

    public function update(Request $request, Ficha $ficha)
    {
        $request->validate([
            'numero' => 'required|unique:fichas,numero,' . $ficha->id,
            'programa' => 'required|string|max:255',
        ]);

        $ficha->update($request->only('numero', 'programa'));

        return redirect()->route('fichas.index')
            ->with('success', 'Ficha actualizada correctamente');
    }

    public function destroy(Ficha $ficha)
    {
        $ficha->delete();
        return redirect()->route('fichas.index')
            ->with('success', 'Ficha eliminada correctamente');
    }

    public function createAprendiz(Ficha $ficha)
    {
        return view('fichas.aprendices.create', compact('ficha'));
    }

    public function storeAprendiz(Request $request, Ficha $ficha)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'identificacion' => 'required|string|max:20',
            'celular' => 'nullable|string|max:20',
            'email' => 'required|email',
            'estado' => 'nullable|string|max:50',
        ]);

        $ficha->aprendices()->create($request->only(
            'nombre',
            'apellidos',
            'identificacion',
            'celular',
            'email',
            'estado'
        ));

        return redirect()->route('fichas.show', $ficha)
            ->with('success', 'Aprendiz agregado correctamente');
    }

    public function destroyAprendiz(Aprendiz $aprendiz)
    {
        $fichaId = $aprendiz->ficha_id;
        $aprendiz->delete();
        
        return redirect()->route('fichas.show', $fichaId)
            ->with('success', 'Aprendiz eliminado correctamente');
    }
}
