<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        return Intervention::all();
    }

    public function get(Intervention $intervention)
    {
        return $intervention;
    }

    public function store()
    {
        
        foreach (request('interventions') as $intervention){
            Intervention::create([
                'name' => $intervention['name'],
                'intervener' =>$intervention['intervener'],
                'surname' => $intervention['surname'],
                'address' => $intervention['address'],
                'brand' => $intervention['brand'],
                'boiler' => $intervention['boiler'],
                'dateEntryService' => $intervention['dateEntryService'],
                'dateIntervention' => $intervention['dateIntervention'],
                'serialNumber' => $intervention['serialNumber'],
                'description' => $intervention['description'],
                'duration' => $intervention['duration'],
            ]);
        }
        return json_encode([
            'success' => 'success'
        ]);
    }

    public function update(Intervention $intervention)
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

    public function destroy(Intervention $intervention)
    {
        $success = $intervention->delete();

        return [
            'success' => $success
        ];
    }
}
