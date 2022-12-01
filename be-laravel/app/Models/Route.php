<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Route extends Model
{
    public const CREATED = 1;
    public const PLANNED = 2;
    public const CLOSED = 3;

    use HasFactory;

    protected $fillable = [
        'date',
        'car_number',
        'status',
        'driver_name'
    ];

    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }
}
