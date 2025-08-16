<?php

namespace Modules\Users\Http\Controllers\Provider;

use App\Helpers\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Users\Http\Requests\Provider\TimeRequest;
use Modules\Users\Transformers\Provider\TimeResource;

class TimesController extends Controller
{
    use ResponseTrait;

    /**
     * Store a newly created resource in storage.
     * 
     * @param  TimeRequest $request
     * @return JsonResponse 
     */
    public function store(TimeRequest $request)
    {
        return $this->json(
            TimeResource::collection(
                $request->user()
                    ->times()
                    ->createMany(
                        $request->validated('times')
                    )
            )
        );
    }
}
