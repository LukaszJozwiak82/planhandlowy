<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LoanSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'loan_id',
        'is_sale',
        'value',
        'current_funding',
        'rrso',
        'points',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'id', 'sale_id');
    }

    public function loan(): HasOne
    {
        return $this->hasOne(Loan::class, 'id', 'loan_id');
    }
}
