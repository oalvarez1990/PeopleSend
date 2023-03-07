<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeoplesendRequest extends FormRequest
{
    public function rules()
    {
        return [
            'names' => ['required', 'string', 'min:5', 'max:100', 'regex:/^[a-zA-Z ]+$/'],
            'last_names' => ['required', 'string', 'min:5', 'max:100', 'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'email', 'max:150'],
            'country' => ['required', Rule::in(['Argentina', 'Bolivia', 'Brazil', 'Chile', 'Colombia', 'Ecuador', 'Guyana', 'Paraguay', 'Peru', 'Uruguay', 'Venezuela'])],
            'address' => ['max:180'],
            'phone' => ['required', 'string', 'size:10', 'regex:/^\d+$/'],
            'id_categorie' => ['required', 'exists:categories,id'],
        ];
    }
}
