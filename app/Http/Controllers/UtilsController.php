<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UtilsController extends Controller
{
    static function getInterventionsByMonth() {

        $interventionByMonth = [];
        $interventionByMonth[0] = ['Mois','Intervention(s)'];

        $month = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

        for ($i=1; $i < count($month) ; $i++) { 
            $numberOfMonthChecks = 0;
            foreach (Intervention::all() as $dateIntervention){
                if(Carbon::parse($dateIntervention['dateIntervention'])->format('m') == $i){
                    $numberOfMonthChecks = $numberOfMonthChecks + 1;
                };
            };
            $interventionByMonth[$i] = [$month[$i - 1],$numberOfMonthChecks];
        };
        
        return $interventionByMonth;
    }

    static function getListInterveners() {
        $index = 0;
        $interveners = array();
        //Lecture de toutes les interventions
        foreach (Intervention::all() as $intervention){
            $find = false;
            //Lecture de tous les intervenants enregistrés
            foreach ($interveners as $intervener){
                if($intervener['name'] == $intervention['intervener']) {
                    $find = true;
                    break;
                }
            }
            if($find == false) {
                $interveners[$index]['name'] = $intervention['intervener'];
                $interveners[$index]['totalInterventions'] = Intervention::where('intervener','=', $intervention['intervener'])->count();
                $interveners[$index]['lastIntervention'] = Intervention::where('intervener','=', $intervention['intervener'])->orderBy('dateIntervention', 'DESC')->first()['dateIntervention'];
            }
            $index++;
        }
        return $interveners;
    }
}
