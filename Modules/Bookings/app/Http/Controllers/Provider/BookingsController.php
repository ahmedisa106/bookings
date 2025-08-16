<?php

namespace Modules\Bookings\Http\Controllers\Provider;

use App\Helpers\PaginationTrait;
use App\Helpers\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bookings\Http\Requests\Provider\BookingStatusRequest;
use Modules\Bookings\Models\Booking;
use Modules\Bookings\Transformers\Provider\BookingResource;
use Modules\Users\Enums\UserRoleEnum;

class BookingsController extends Controller
{
    use ResponseTrait, PaginationTrait;

    public function index(Request $request)
    {
        abort_if($request->user()->role != UserRoleEnum::PROVIDER, 403);

        return $this->json(
            $this->paginate(
                $request->user()
                    ->bookings()
                    ->paginate($request->query('per_page', 12)),
                BookingResource::class
            )
        );
    }

    public function show(Request $request, Booking $booking)
    {
        abort_if($request->user()->role != UserRoleEnum::PROVIDER, 403);

        return $this->json(
            BookingResource::make(
                $booking->load(['service', 'customer'])
            )
        );
    }

    public function updateStatus(BookingStatusRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        return $this->json(
            BookingResource::make(
                $booking->load(['service', 'customer'])
            ),
            'booking updated successfully'
        );
    }
}
