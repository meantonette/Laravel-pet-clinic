<?php

namespace App\Http\Requests;

use App\Models\Personnel;
use Illuminate\Foundation\Http\FormRequest;

class personnelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
