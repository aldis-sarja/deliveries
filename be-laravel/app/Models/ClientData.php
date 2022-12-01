<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    protected $fillable = [
        'name',
        'address',
        'deliveryDate',
        'deliveryType',
        'sum'
    ];
}
