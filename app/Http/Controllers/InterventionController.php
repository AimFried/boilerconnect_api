<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InterventionController extends Controller
{
    private function getListInterveners() {
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

    public function resume()
    {
        return json_encode([
            'TotalInterventions' => Intervention::all()->count(),
            'TodayInterventions' => Intervention::whereDate('dateIntervention','=',Carbon::today()->format('Y/m/d 00:00:00'))->count(),
            'TotalInterveners' => count(InterventionController::getInterveners()),
        ]);
    }

    public function search(Request $request) {
        $q = $request->input('q');
        $search = Intervention::where('serialNumber', 'like', "%{$q}%")->latest()->get();
        return json_encode([
            'search' => $search
        ]);
    }

    public function getInterveners()
    {
        return json_encode([
            'Interveners' => InterventionController::getListInterveners()
        ]);
    }

    public function getAll()
    {
        return Intervention::all();
    }

    public function getById(Intervention $intervention)
    {
        return $intervention;
    }

    public function create()
    {
        
        foreach (request('interventions') as $intervention){
            Intervention::create([
                'name' => $intervention['name'],
                'intervener' =>$intervention['intervener'],
                'surname' => $intervention['surname'],
                'address' => $intervention['address'],
                'brand' => $intervention['brand'],
                'boiler' => $intervention['boiler'],
                'dateEntryService' => new Carbon($intervention['dateEntryService']),
                'dateIntervention' => new Carbon($intervention['dateIntervention']),
                'serialNumber' => $intervention['serialNumber'],
                'description' => $intervention['description'],
                'duration' => $intervention['duration'],
            ]);
        }
        return json_encode([
            'success' => 'success'
        ]);
    }

    public function updateById(Intervention $intervention)
    {
        request()->validate([
            'name' => 'required',
            'intervener' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'brand' => 'required',
            'boiler' => 'required',
            'dateEntryService' => 'required',
            'dateIntervention' => 'required',
            'serialNumber' => 'required',
            'duration' => 'required',
        ]);

        $success = $intervention->update([
            'name' => request('name'),
            'intervener' => request('intervener'),
            'surname' => request('surname'),
            'address' => request('address'),
            'brand' => request('brand'),
            'boiler' => request('boiler'),
            'dateEntryService' => request('dateEntryService'),
            'dateIntervention' => request('dateIntervention'),
            'serialNumber' => request('serialNumber'),
            'description' => request('description'),
            'duration' => request('duration'),
        ]);

        return [
            'success' => $success
        ];
    }

    public function deleteById(Intervention $intervention)
    {
        $success = $intervention->delete();

        return [
            'success' => $success
        ];
    }
}
