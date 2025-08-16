<?php

namespace Modules\Bookings\Transformers\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Services\Transformers\Customer\ServiceResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'scheduled_at'  => $this->scheduled_at->setTimezone(request()->user()->timezone)->isoFormat('llll'),
            'service' => $this->whenLoaded('service', fn() => ServiceResource::make($this->service)),
            'status'    => [
                'label' => $this->status->name,
                'value' => $this->status->value
            ]
        ];
    }
}
