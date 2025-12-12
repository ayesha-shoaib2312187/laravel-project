<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'short',
        'desc',
        'price',
        'stock',
        'discount',
        'image',
    ];

    protected $casts = [
        'stock' => 'boolean',
        'discount' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
