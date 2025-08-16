<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Modules\Bookings\Enums\BookingStatusEnum;
use Modules\Bookings\Models\Booking;
use Modules\Users\Models\User;

class TimeSlotService
{
    public function getAvailableTimes($service, $date)
    {
        $provider = $service->provider;
        $date = Carbon::parse($date);
        $day =  $date->dayOfWeek;

        $bookedTimes = $provider
            ->bookings()
            ->whereIn('status', [BookingStatusEnum::CONFIRMED, BookingStatusEnum::COMPLETED])
            ->where('service_id', $service->id)
            ->pluck('scheduled_at')
            ->map(fn($q) => $q->toTimeString())
            ->toArray();

        return $provider->times()
            ->where('day', $day)
            ->get()
            ->map(
                fn($time) =>
                array_map(
                    fn($time) => $time->toTimeString(),
                    CarbonPeriod::create($time->from, "$service->duration minutes", $time->to)->toArray()
                )
            )
            ->flatten(1)
            ->filter(fn($time) => !in_array($time, $bookedTimes))
            ->map(function ($time) use ($date) {
                $time = Carbon::parse($time);

                return [
                    'label' => $time->copy()->setTimezone(request()->user()->timezone)->isoFormat('hh:mm A'),
                    'value' => $date->toDateString() . ' ' . $time->isoFormat('HH:mm A')
                ];
            });
    }
}
