<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InterventionController extends Controller
{

    public function search(Request $request) {
        $q = $request->input('q');
        $search = Intervention::where('serialNumber', 'like', "%{$q}%")->latest()->get();
        return json_encode([
            'search' => $q,
            'interventions' => $search
        ]);
    }

    public function get(Request $request)
    {
      
        if($request->input('id')) {
            //By Id
            return json_encode([
                'intervention' => Intervention::where('id','=',$request->input('id'))->get()
            ]);
        } else if($request->input('intervener')){
            //By Intervener name
            return json_encode([
                'intervener' => $request->input('intervener'),
                'interventions' => Intervention::where('intervener','=',$request->input('intervener'))->get(),
            ]);
        } else {
            //All
            return json_encode([
                'interventions' => Intervention::all()
            ]);
        }
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
