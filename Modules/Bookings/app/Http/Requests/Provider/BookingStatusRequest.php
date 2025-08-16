<?php

namespace Modules\Bookings\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Bookings\Enums\BookingStatusEnum;
use Modules\Users\Enums\UserRoleEnum;

class BookingStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'status'    => ['required', Rule::enum(BookingStatusEnum::class)]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  $this->user()->role == UserRoleEnum::PROVIDER;
    }
}
