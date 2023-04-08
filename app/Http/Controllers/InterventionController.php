<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InterventionController extends Controller
{

    public function search(Request $request) {
        $fieldName = [];
        $q = $request->input('q');
        $field = $request->input('by');

        if($field) {
            switch ($field) {
                case 'intervener':
                    $fieldName = ['Technicien','intervener'];
                    break;
                case 'name':
                    $fieldName = ['Nom du client','name'];
                    break;
                case 'surname':
                    $fieldName = ['Prénom du client','surname'];
                    break;
                case 'address':
                    $fieldName = ['Adresse','address'];
                    break;
                case 'brand':
                    $fieldName = ['Marque','brand'];
                    break;
                case 'boiler':
                    $fieldName = ['Modèle','boiler'];
                    break;
                case 'dateEntryService':
                    $fieldName = ['Date de mise en service','dateEntryService'];
                    break;
                case 'dateIntervention':
                    $fieldName = ['Date intervention','dateIntervention'];
                    break;
                case 'serialNumber':
                    $fieldName = ['Numéro de série','serialNumber'];
                    break;
                case 'description':
                    $fieldName = ['description','description'];
                    break;
                case 'duration':
                    $fieldName = ['Durée','duration'];
                    break;
            }
        } else {
            $fieldName = ['Numéro de serie','serialNumber'];
        }
    
        $search = Intervention::where($fieldName[1], 'like', "%{$q}%")->latest()->get();
        if(count($search) == 0){
            $search = null;
        }
        return json_encode([
            'search' => $q,
            'by' => $fieldName[0],
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

    public function deleteById(Intervention $intervention)
    {
        $success = $intervention->delete();

        return [
            'success' => $success
        ];
    }
}
