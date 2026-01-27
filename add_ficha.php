<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Ficha;
use App\Models\Aprendiz;

// Crear nueva ficha
$ficha = Ficha::create([
    'numero' => '3335750',
    'programa' => 'Gestión Agroempresarial - Inducción'
]);

echo "✓ Ficha creada: {$ficha->numero} - {$ficha->programa}\n";

// Agregar aprendices
$aprendices = [
    [
        'nombre' => 'Sofía López Martínez',
        'identificacion' => '1098765432',
        'email' => 'sofia.lopez@example.com',
        'novedad' => 'Incumplimiento fase inductiva',
        'instructor' => 'Daniela García',
        'evidencia' => 'Registro de asistencia'
    ],
    [
        'nombre' => 'Carlos Rodríguez Silva',
        'identificacion' => '1087654321',
        'email' => 'carlos.rodriguez@example.com',
        'novedad' => 'Falta de documentos',
        'instructor' => 'Miguel Hernández',
        'evidencia' => 'Solicitud de documentos'
    ],
    [
        'nombre' => 'Ana Patricia Sánchez González',
        'identificacion' => '1076543210',
        'email' => 'ana.patricia@example.com',
        'novedad' => 'Bajo cumplimiento de actividades',
        'instructor' => 'Laura Díaz',
        'evidencia' => 'Evaluación de desempeño'
    ],
    [
        'nombre' => 'Diego Fernández López',
        'identificacion' => '1065432109',
        'email' => 'diego.fernandez@example.com',
        'novedad' => 'No realiza actividades propuestas',
        'instructor' => 'Javier Moreno',
        'evidencia' => 'Reporte de actividades'
    ]
];

foreach ($aprendices as $datos) {
    $aprendiz = $ficha->aprendices()->create($datos);
    echo "✓ Aprendiz agregado: {$aprendiz->nombre}\n";
}

echo "\n✓ Ficha {$ficha->numero} con " . $ficha->aprendices->count() . " aprendices creada exitosamente\n";
