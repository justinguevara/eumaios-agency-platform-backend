<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use \App\Models\Countries;

class CreatePublisherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [ 
            'publisher.name' => ['present', 'min:1', 'max:255',],
            'publisher.description' => ['nullable', 'string', 'min:1',], // TODO why empty string = " "
            'publisher.contact_name' => ['nullable', 'string', 'min:1', 'max:255',],
            'publisher.contact_email' => ['nullable', 'string','email:rfc'],
            'publisher.contact_phone_number' => ['nullable', 'string','min:1', 'max:255',], // TODO
            'publisher.address_street_1' => ['nullable', 'string','min:1', 'max:255',],
            'publisher.address_street_2' => ['nullable', 'string','min:1', 'max:255',],
            'publisher.address_city' => ['nullable', 'string','min:1', 'max:255',],
            'publisher.address_region' => ['nullable', 'string','min:1', 'max:255',],
            'publisher.address_country_id' => ['nullable', Rule::in(Countries::pluck('id')->toArray())], // TODO optimize
            'publisher.address_postal_zip' => ['nullable', 'string','min:1', 'max:255',], // TODO
        ];
    }
}
