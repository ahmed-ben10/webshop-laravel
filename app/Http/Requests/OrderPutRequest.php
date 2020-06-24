<?php

namespace App\Http\Requests;

use Axlon\PostalCodeValidation\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;

class OrderPutRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'voornaam'=>'required',
            'achternaam'=>'required',
            'adres'=>'required',
            'postcode' => [
                PostalCode::forCountry('NL'),
            ],
            'telefoonnummer'=>'required|digits_between:10,15',
            'bezorgtijd' =>'required|date_format:H:i'
        ];
    }
}
