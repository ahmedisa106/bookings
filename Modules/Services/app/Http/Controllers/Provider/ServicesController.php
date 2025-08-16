<?php

namespace Modules\Services\Http\Controllers\Provider;

use App\Helpers\ResponseTrait;
use App\Helpers\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Services\TimeSlotService;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Gate;
use Modules\Services\Http\Requests\ServiceRequest;
use Modules\Services\Models\Service;
use Modules\Services\Transformers\Provider\ServiceResource;
use Modules\Users\Enums\UserRoleEnum;

class ServicesController extends Controller
{
    use ResponseTrait, PaginationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::allowIf(request()->user()->role == UserRoleEnum::PROVIDER);

        return $this->json(
            $this->paginate(
                Service::paginate(request('per_page', 12))
                    ->withQueryString(),
                ServiceResource::class
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        if (Gate::denies('store-services')) {
            abort(403, 'unauthorize');
        }

        return $this->json(
            $request->user()
                ->services()
                ->createMany($request->validated('services')),
            'services created successfully'
        );
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, Service $service, TimeSlotService $slotService)
    {
        Gate::allowIf($request->user()->id == $service->provider_id);

        return $this->json(
            ServiceResource::make($service)
        );
    }

    /**
     * Update status
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Services\Models\Service $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Service $service)
    {
        Gate::allowIf($request->user()->id == $service->provider_id);

        $service->update(['status' => $request->status]);

        return $this->json(
            ServiceResource::make($service),
            'service updated successfully'
        );
    }
}
