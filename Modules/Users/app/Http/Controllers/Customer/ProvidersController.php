<?php

namespace Modules\Users\Http\Controllers\Customer;

use App\Helpers\PaginationTrait;
use App\Helpers\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Services\Enums\ServiceStatusEnum;
use Modules\Users\Enums\UserRoleEnum;
use Modules\Users\Models\User;
use Modules\Users\Transformers\Customer\ProviderResource;

class ProvidersController extends Controller
{
    use ResponseTrait, PaginationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->json(
            $this->paginate(
                User::whereRole(UserRoleEnum::PROVIDER)
                    ->whereHas('services', fn($q) => $q->whereStatus(ServiceStatusEnum::ACTIVE))
                    ->paginate($request->query('per_page', 12))
                    ->withQueryString(),
                ProviderResource::class
            )
        );
    }

    /**
     * Show the specified resource.
     */
    public function show(User $provider)
    {
        return $this->json(
            ProviderResource::make(
                $provider
                    ->load(['times', 'services' => function ($q) {
                        $q->whereStatus(ServiceStatusEnum::ACTIVE);
                    }])
            )
        );
    }
}
