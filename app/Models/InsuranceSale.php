<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InsuranceSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'insurance_id',
        'is_sale',
        'contribution',
        'points',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'id', 'sale_id');
    }

    public function insurance(): HasOne
    {
        return $this->hasOne(Insurance::class, 'id', 'insurance_id');
    }
}
