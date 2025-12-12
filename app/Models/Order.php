<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'email',
        'address',
        'total',
        'status',
        'date',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'date' => 'datetime',
    ];
}
