<?php

namespace Modules\Services\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'services' => 'required|array|min:1',
            'services.*.name'   =>  [
                'required',
                'distinct',
                Rule::unique('services', 'name')->where('provider_id', $this->user()->id)
            ],
            'services.*.description'    => 'required|string|max:255',
            'services.*.category'  => Rule::unique('services', 'description')->where('provider_id', $this->user()->id),
            'services.*.duration'  =>  'required|int',
            'services.*.price' =>  'required|int'
        ];
    }
}
