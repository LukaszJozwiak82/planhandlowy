<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PackageSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'sale_id',
        'points',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'id', 'sale_id');
    }

    public function package(): HasOne
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }
}
