<?php

namespace Modules\Users\Transformers\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Services\Transformers\Customer\ServiceResource;
use Modules\Users\Transformers\Provider\TimeResource;

class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    =>  $this->id,
            'name'  =>  $this->name,
            'email' => $this->email,
            'services'  => $this->whenLoaded('services', function () {
                return ServiceResource::collection($this->services);
            }),
            'times' => $this->whenLoaded('times', function () {
                return TimeResource::collection($this->times);
            })
        ];
    }
}
