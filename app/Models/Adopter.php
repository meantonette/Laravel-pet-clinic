<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{

    public const VALIDATION_RULES = [
        'first_name' => [
            'required',
            'alpha',
            'min:3',
        ],
        'last_name' => [
            'required',
            'alpha',
            'min:3',
        ],
        'phone_number' => [
            'required',
            'numeric',
        ],
        'images' => [
            'required',
            'image',
            'mimes:jpg,png,jpeg,gif',
            'max:5048',
        ],
    ];

    use HasFactory;

    protected $table = 'adopters';

    protected $primaryKey = 'adopter_id';

    protected $guarded = ['adopter_id'];

