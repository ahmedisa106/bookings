<?php

namespace Modules\Services\Transformers\Provider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Services\Transformers\DaySlotResource;
use Modules\Services\Transformers\SlotResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'description'   => $this->description,
            'category'  => $this->category,
            'duration'   => $this->duration,
            'price' => $this->price,
            'ststus'    => $this->status,
        ];
    }
}
