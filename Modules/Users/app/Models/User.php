<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Bookings\Models\Booking;
use Modules\Services\Models\Service;
use Modules\Users\Enums\UserRoleEnum;

/**
 * @property  int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property UserRoleEnum $role
 * @property string $timezone 
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'timezone'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role'  => UserRoleEnum::class,
            'password' => 'hashed',
        ];
    }

    /**
     * Password Motator
     * 
     * @return Attribute
     */
    protected function password()
    {
        return Attribute::make(
            set: fn($value) => bcrypt($value)
        );
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'provider_id');
    }

    public function customerBookings()
    {
        return $this->hasMany(Booking::class, foreignKey: 'customer_id');
    }

    /**
     * Times
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function times()
    {
        return $this->hasMany(ProviderTime::class, 'provider_id');
    }

    /**
     * Services relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'provider_id');
    }
}
