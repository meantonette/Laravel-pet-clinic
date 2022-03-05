<?php

namespace App\Http\Requests;

use App\Models\Rescuer; //dont forget this
use Illuminate\Foundation\Http\FormRequest;

class rescuerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //gawen true ito nakafalse yan default
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Rescuer::VALIDATION_RULES; //taz tatawagin mo syemfre
    }
}
