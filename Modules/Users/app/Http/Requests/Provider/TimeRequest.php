<?php

namespace Modules\Users\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Users\Enums\UserRoleEnum;

class TimeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'times' => 'required|array|min:1',
            'times.*.day' => [
                'required',
                'int',
                'distinct',
                'in:' . implode(',', range(0, 6)),
                Rule::unique('provider_times')->where('provider_id', $this->user()->id)
            ],
            'times.*.from'  => 'required|date_format:H:i|before:to',
            'times.*.to'  => 'required|date_format:H:i|after:from',
        ];
    }

    /**
     * Authorize
     * 
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->role == UserRoleEnum::PROVIDER;
    }
}
