<?php

namespace Modules\Bookings\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Users\Enums\UserRoleEnum;

class BookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'provider_id'   => [
                'required',
                Rule::exists('users', 'id')->where('role', UserRoleEnum::PROVIDER)
            ],
            'service_id'    => 'required|exists:services,id',
            'scheduled_at'  => 'required|date|afterOrEqual:today'
        ];
    }
}
