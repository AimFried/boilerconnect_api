<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'intervener','name', 'surname', 'address', 'brand', 'boiler','dateEntryService','dateIntervention','serialNumber','description','duration'
    ];
}
