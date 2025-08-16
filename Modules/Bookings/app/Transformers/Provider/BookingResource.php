<?php

namespace Modules\Bookings\Transformers\Provider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Services\Transformers\Provider\ServiceResource;
use Modules\Users\Transformers\UserResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'scheduled_at'  => $this->scheduled_at->setTimezone($request->user()->timezone)->isoFormat('llll'),
            'status'    => [
                'label' => $this->status->name,
                'value' => $this->status->value
            ],
            'service'  => $this->whenLoaded(
                'service',
                fn() => ServiceResource::make($this->service)
            ),
            'customer'  => $this->whenLoaded('customer', fn() => UserResource::make($this->customer))
        ];
    }
}
