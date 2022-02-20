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
