<?php

namespace Modules\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Services\Enums\ServiceStatusEnum;
use Modules\Users\Models\User;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $category
 * @property User $provider_id
 * @property int $duration
 * @property double $price
 * @property ServiceStatusEnum $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var  array<string>
     */
    protected $fillable = [
        'provider_id',
        'name',
        'description',
        'category',
        'duration',
        'price',
        'status'
    ];

    /**
     * Casts
     * 
     * @return array
     */
    protected function casts()
    {
        return [
            'duration'  => 'int',
            'price'     => 'double',
            'status'    => ServiceStatusEnum::class
        ];
    }

    /**
     * Provider relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}
