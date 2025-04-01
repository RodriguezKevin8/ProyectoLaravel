<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class ReporteController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->isAdmin) {
            return view('dashboard', ['mostrarGraficos' => false]);
        }

        $totalEventos = Evento::count();
        
        if ($totalEventos === 0) {
            return view('dashboard', [
                'mostrarGraficos' => false,
                'mensaje' => 'No hay datos suficientes para generar los gráficos.'
            ]);
        }

        // Gráfico 1: Estados de Eventos (Doughnut)
        $estadosEventos = [
            'ACTIVO' => Evento::where('estado', 'ACTIVO')->count(),
            'INACTIVO' => Evento::where('estado', 'INACTIVO')->count(),
            'FINALIZADO' => Evento::where('estado', 'FINALIZADO')->count()
        ];

        $chartEstados = Chartjs::build()
            ->name('estadosEventos')
            ->type('doughnut')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($estadosEventos))
            ->datasets([
                [
                    'label' => 'Estados de Eventos',
                    'data' => array_values($estadosEventos),
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ]
                ]
            ])
            ->options([
                'responsive' => true,
                'plugins' => [
                    'legend' => [
                        'position' => 'right'
                    ]
                ]
            ]);

        // Gráfico 2: Eventos más participados (Bar)
        $eventosMasParticipados = Evento::withCount(['participantes' => function($query) {
                $query->where('estado_participante', 'confirmada');
            }])
            ->orderBy('participantes_count', 'DESC')
            ->limit(5)
            ->get();

        $chartParticipados = Chartjs::build()
            ->name('eventosParticipados')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($eventosMasParticipados->pluck('titulo')->toArray())
            ->datasets([
                [
                    'label' => 'Participantes confirmados',
                    'data' => $eventosMasParticipados->pluck('participantes_count')->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)'
                ]
            ])
            ->options([
                'responsive' => true,
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'precision' => 0
                        ]
                    ]
                ]
            ]);

        // Gráfico 3: Eventos por mes (Line)
        $eventosPorMes = Evento::selectRaw('count(*) as total, EXTRACT(MONTH FROM fecha_inicio) as mes')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->keyBy('mes');

        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 
                 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        
        $datosMensuales = [];
        for ($i = 1; $i <= 12; $i++) {
            $datosMensuales[] = $eventosPorMes->has($i) ? $eventosPorMes[$i]->total : 0;
        }

        $chartMensual = Chartjs::build()
            ->name('eventosPorMes')
            ->type('line')
            ->size(['width' => 800, 'height' => 200])
            ->labels($meses)
            ->datasets([
                [
                    'label' => 'Eventos creados',
                    'data' => $datosMensuales,
                    'borderColor' => 'rgba(153, 102, 255, 0.7)',
                    'backgroundColor' => 'rgba(153, 102, 255, 0.1)',
                    'fill' => true,
                    'tension' => 0.1
                ]
            ])
            ->options([
                'responsive' => true,
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'precision' => 0
                        ]
                    ]
                ]
            ]);

        return view('dashboard', [
            'mostrarGraficos' => true,
            'chartEstados' => $chartEstados,
            'chartParticipados' => $chartParticipados,
            'chartMensual' => $chartMensual,
            'totalEventos' => $totalEventos
        ]);
    }
}