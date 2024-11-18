<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [ 
            'campaign.name' => ['present', 'min:1', 'max:255',],
            'campaign.description' => ['nullable', 'string', 'min:1',],
            'campaign.conversion_type' => ['present', Rule::in(['A', 'AAA', 'B', 'C'])], // TODO review
            'campaign.advertiser_id' => ['present', 'numeric', 'min:1', 'max:18446744073709551615',], // TODO
            'campaign.network_id' => ['present', 'numeric', 'min:1', 'max:18446744073709551615',], // TODO
            'campaign.publisher_ids' => ['present', 'array'], // TODO
        ];
    }
}
