<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{
    use HasFactory;

    public const LIQUID_PRODUCT = 1;
    public const SOLID_PRODUCT = 2;
    public const STATUS_NOT_FINISHED = 1;
    public const STATUS_FINISHED = 2;
    public const STATUS_CANCELED = 3;

    protected $fillable = [
        'route_id',
        'address_id',
        'type',
        'status'
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function deliveryLines(): HasMany
    {
        return $this->hasMany(DeliveryLine::class);
    }
}
