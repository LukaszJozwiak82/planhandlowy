<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DepositValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'deposit_id',
        'is_sale',
        'value',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'id', 'sale_id');
    }

    public function deposit(): HasOne
    {
        return $this->hasOne(Deposit::class, 'id', 'deposit_id');
    }
}
