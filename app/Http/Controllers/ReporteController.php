<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;

class ReporteController extends Controller
{

    public function dashboard()
    {
        // Verificar si el usuario es admin
        if (!auth()->user()->isAdmin) {
            return view('dashboard', ['mostrarGraficos' => false]);
        }
    
        // Obtener conteo total de eventos
        $totalEventos = Evento::count();
        
        // Preparar datos solo si hay eventos
        if ($totalEventos > 0) {
            $estadosEventos = [
                'ACTIVO' => Evento::where('estado', 'ACTIVO')->count(),
                'INACTIVO' => Evento::where('estado', 'INACTIVO')->count(),
                'FINALIZADO' => Evento::where('estado', 'FINALIZADO')->count(),
            ];
    
            $eventosMasParticipados = Evento::withCount(['participantes' => function($query) {
                $query->where('estado_participante', 'confirmada');
            }])
            ->orderBy('participantes_count', 'DESC')
            ->limit(5)
            ->get();
    
            $eventosPorMes = Evento::selectRaw('count(*) as total, EXTRACT(MONTH FROM fecha_inicio) as mes')
                ->groupBy('mes')
                ->orderBy('mes')
                ->get();
    
            $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            $datosMensuales = array_fill(0, 12, 0);
            
            foreach ($eventosPorMes as $eventoMes) {
                $mesIndex = intval($eventoMes->mes) - 1;
                if ($mesIndex >= 0 && $mesIndex < 12) {
                    $datosMensuales[$mesIndex] = $eventoMes->total;
                }
            }
    
            return view('dashboard', [
                'mostrarGraficos' => true,
                'estadosEventos' => $estadosEventos,
                'eventosMasParticipados' => [
                    'titulos' => $eventosMasParticipados->pluck('titulo'),
                    'participantes' => $eventosMasParticipados->pluck('participantes_count')
                ],
                'eventosPorMes' => [
                    'meses' => $meses,
                    'datos' => $datosMensuales
                ]
            ]);
        }
    
        // No hay eventos
        return view('dashboard', [
            'mostrarGraficos' => false,
            'mensaje' => 'No hay datos suficientes para generar los gráficos. Crea al menos un evento para comenzar.'
        ]);
    }
    
}