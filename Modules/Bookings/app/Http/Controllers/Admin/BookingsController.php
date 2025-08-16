<?php

namespace Modules\Bookings\Http\Controllers\Admin;

use App\Helpers\PaginationTrait;
use App\Helpers\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bookings\Enums\BookingStatusEnum;
use Modules\Bookings\Models\Booking;
use Modules\Bookings\Transformers\Admin\BookingResource;

class BookingsController extends Controller
{
    use ResponseTrait, PaginationTrait;

    public function bookings(Request $request)
    {
        $bookings = Booking::query()
            ->with(['customer', 'provider', 'service'])
            ->when(
                $request->query('provider'),
                fn($q, $provider) => $q->whereProviderId($provider)
            )
            ->when(
                $request->query('service'),
                fn($q, $service) => $q->whereServiceId($service)
            )
            ->when(
                $request->query('from'),
                fn($q, $from) => $q->whereRaw('date(scheduled_at) >= ?', [$from])
            )
            ->when(
                $request->query('to'),
                fn($q, $from) => $q->whereRaw('date(scheduled_at) <= ?', [$from])
            )
            ->whereStatus(BookingStatusEnum::COMPLETED)
            ->paginate($request->query('per_page', 12))
            ->withQueryString();

        return $this->json(
            $this->paginate(
                $bookings,
                BookingResource::class
            )
        );
    }
}
