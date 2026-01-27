<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Acta;
use App\Models\Ficha;
use App\Models\Aprendiz;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [
            'total_actas' => Acta::count(),
            'actas_mes' => Acta::whereMonth('created_at', Carbon::now()->month)->count(),
            'total_fichas' => Ficha::count(),
            'total_aprendices' => Aprendiz::count(),
            'recent_actas' => Acta::latest()->take(5)->get(),
        ];

        return view('home', compact('stats'));
    }
}
