<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function get()
    {
        return json_encode([
            'totalInterventions' => Intervention::all()->count(),
            'todayInterventions' => Intervention::whereDate('dateIntervention','=',Carbon::today()->format('Y-d-m 00:00:00'))->count(),
            'totalInterveners' => count(UtilsController::getListInterveners()),
            'interventionsByMonth' => UtilsController::getInterventionsByMonth()
        ]);
    }
}
