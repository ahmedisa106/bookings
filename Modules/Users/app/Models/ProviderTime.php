<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property User $provider_id
 * @property int $day
 * @property \Carbon\Carbon $from
 * @property \Carbon\Carbon $to
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ProviderTime extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array<string>
     */
    protected $fillable = [
        'provider_id',
        'day',
        'from',
        'to'
    ];

    /**
     * Casts
     * 
     * @return array
     */
    protected function casts()
    {
        return [
            'day'   =>  'int',
            'from'  =>  'datetime:H:i',
            'to'    =>  'datetime:H:i'
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
