<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Users\Enums\UserRoleEnum;
use Modules\Users\Transformers\Provider\TimeResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
            'times' => $this->when($this->role == UserRoleEnum::PROVIDER, function () {
                return $this->whenLoaded('times', function () {
                    return TimeResource::collection($this->times);
                });
            })
        ];
    }
}
