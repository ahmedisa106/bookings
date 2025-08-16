<?php

namespace Modules\Bookings\Enums;

enum BookingStatusEnum: int
{
    case PENDING = 1;
    case CONFIRMED = 2;
    case CANCELLED = 3;
    case COMPLETED = 4;
}
