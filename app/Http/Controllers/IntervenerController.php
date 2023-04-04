<?php

namespace App\Http\Controllers;

class IntervenerController extends Controller
{

    public function get()
    {
        return json_encode([
            'interveners' => UtilsController::getListInterveners()
        ]);
    }
}
