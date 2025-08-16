<?php

namespace Modules\Bookings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Bookings\Enums\BookingStatusEnum;
use Modules\Services\Models\Service;
use Modules\Users\Models\User;

/**
 * @property int $id
 * @property User $provider_id
 * @property User $customer_id
 * @property Service $service_id
 * @property \Carbon\Carbon $scheduled_at
 * @property BookingStatusEnum $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Booking extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<string>
     */
    protected $fillable = [
        'provider_id',
        'customer_id',
        'service_id',
        'scheduled_at',
        'status',
    ];

    /**
     * Casts
     * 
     * @return array
     */
    protected function casts()
    {
        return [
            'scheduled_at'  => 'datetime:Y-m-d H:i',
            'status'        =>  BookingStatusEnum::class,
        ];
    }

    /**
     * Provider
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    /**
     * Customer
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Service
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
