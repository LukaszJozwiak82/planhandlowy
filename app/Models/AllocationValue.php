<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AllocationValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'allocation_id',
        'product_id',
        'value',
    ];

    public function allocation(): BelongsTo
    {
        return $this->belongsTo(Allocation::class);
    }
}
