<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseInjury extends Model
{

    public const VALIDATION_RULES = [
        'classify' => [
            'required',
            'alpha',
        ],
    ];

    use HasFactory;

    protected $table = 'disease_injuries';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function animal(){
        return $this->belongsTo('\App\Models\Animal','animals_id');
    }
}
