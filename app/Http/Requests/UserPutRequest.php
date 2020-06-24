<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserPutRequest extends FormRequest
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
            'voornaam' => ['required', 'string', 'max:255'],
            'achternaam' => ['required', 'string', 'max:255'],
            'adres' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'telefoonnummer' => ['required', 'string', 'max:255'],
            'email' => 'unique:users,email,'.Auth::user()->getAuthIdentifier()
        ];
    }
}
