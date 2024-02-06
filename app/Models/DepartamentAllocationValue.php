<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartamentAllocationValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'departament_allocation_id',
        'product_id',
        'value',
    ];

    public function departamentAllocation(): BelongsTo
    {
        return $this->belongsTo(DepartamentAllocation::class);
    }
}
