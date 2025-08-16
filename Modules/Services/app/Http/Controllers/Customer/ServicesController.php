<?php

namespace Modules\Services\Http\Controllers\Customer;

use App\Helpers\ResponseTrait;
use App\Helpers\PaginationTrait;
use App\Http\Controllers\Controller;
use App\Services\TimeSlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Services\Enums\ServiceStatusEnum;
use Modules\Services\Http\Requests\Customer\ServiceTimeRequest;
use Modules\Services\Models\Service;
use Modules\Services\Transformers\Customer\ServiceResource;
use Modules\Services\Transformers\DaySlotResource;
use Modules\Users\Enums\UserRoleEnum;

class ServicesController extends Controller
{
    use ResponseTrait, PaginationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->json(
            $this->paginate(
                Service::whereStatus(ServiceStatusEnum::ACTIVE)
                    ->paginate(request('per_page', 12))
                    ->withQueryString(),
                ServiceResource::class
            )
        );
    }
    /**
     * Show the specified resource.
     */
    public function show(Request $request, Service $Service)
    {
        Gate::allowIf($request->user()->role == UserRoleEnum::CUSTOMER);

        return $this->json(
            ServiceResource::make($Service)
        );
    }

    public function availableTimes(ServiceTimeRequest $request, TimeSlotService $timeSlotService, Service $service)
    {
        $times = $timeSlotService->getAvailableTimes($service, $request->input('date'));

        return $this->json(
            DaySlotResource::collection($times)
        );
    }
}
