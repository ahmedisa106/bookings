<?php

namespace Modules\Bookings\Http\Controllers\Customer;

use App\Helpers\PaginationTrait;
use App\Helpers\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Bookings\Enums\BookingStatusEnum;
use Modules\Bookings\Http\Requests\Customer\BookingRequest;
use Modules\Bookings\Models\Booking;
use Modules\Bookings\Transformers\Customer\BookingResource;

class BookingsController extends Controller
{
    use ResponseTrait, PaginationTrait;

    public function index(Request $request)
    {
        return $this->json(
            $this->paginate(
                request()
                    ->user()
                    ->customerBookings()
                    ->paginate($request->query('per_page', 12))
                    ->withQueryString(),
                BookingResource::class
            )
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        abort_if(
            Booking::whereProviderId($request->provider_id)
                ->whereServiceId($request->service_id)
                ->whereScheduledAt($request->scheduled_at)
                ->whereNot('status', BookingStatusEnum::CANCELLED)
                ->exists(),
            400,
            'already booked'
        );

        $booking = DB::transaction(function () use ($request) {
            return Booking::sharedLock()
                ->create(
                    [
                        'customer_id'   => $request->user()->id,
                    ] + $request->validated()
                );
        });

        return $this->json(
            BookingResource::make($booking),
            'booked successfully'
        );
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request, Booking $booking)
    {
        abort_unless(
            $booking->belongsTo($request->user(), 'customer_id'),
            403,
            'unauthorized'
        );

        return $this->json(
            BookingResource::make(
                $booking->load('service')
            ),
        );
    }
}
