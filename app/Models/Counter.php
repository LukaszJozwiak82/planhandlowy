<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'value',
        'month',
        'year',
        'quarter',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
