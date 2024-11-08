<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNetworkRequest extends FormRequest
{
    public function authorize(): bool
    {
        //~~~ TODO admin only
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
