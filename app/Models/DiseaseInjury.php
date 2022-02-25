<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DiseaseInjury extends Model
{

    public const VALIDATION_RULES = [
        'classify' => [
            'required',
            'alpha',
        ],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function animal(){
        return $this->belongsTo('\App\Models\Animal','animals_id');
    }
}
