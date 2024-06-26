<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'store_id',
        'name',
        'brand',
        'category',
        'price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
