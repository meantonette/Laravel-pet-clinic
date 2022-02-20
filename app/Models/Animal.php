<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{

    public const VALIDATION_RULES = [
        'animal_name' => [
            'required',
            'alpha',
            'min:3',
        ],
        'age' => [
            'required',
            'numeric',
            'min:1',
            'max:20',
        ],
        'gender' => [
            'required',
            'alpha',
        ],
        'type' => [
            'required',
            'alpha',
        ],
        'images' => [
            'required',
            'image',
            'mimes:jpg,png,jpeg,gif',
            'max:5048',
        ],
    ];

    use HasFactory;

    protected $table = 'animals';

    protected $primaryKey = 'animals_id';

    protected $guarded = ['animals_id'];

    public function rescuer(){
        return $this->belongsTo('\App\Models\Rescuer','rescuer_id');
    }

    public function diseaseInjury(){
        return $this->hasMany(DiseasInjury::class);
    }
}
