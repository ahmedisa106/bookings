<?php

namespace Modules\Users\Transformers\Provider;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'day'   => $this->day,
            'from'  => $this->from->setTimezone(request()->user()->timezone)->isoFormat(" hh::mm A"),
            'to'    => $this->to->setTimezone(request()->user()->timezone)->isoFormat(" hh::mm A")
        ];
    }
}
