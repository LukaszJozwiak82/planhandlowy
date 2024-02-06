<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DepartamentAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'departament_id',
        'value',
        'day',
        'month',
        'year',
        'quarter',
    ];

    public function departament(): belongsTo
    {
        return $this->belongsTo(Departament::class);
    }

    public function product()
    {
        return $this->belongsTo(Loan::class);
    }

    public function departamentAllocationValues(): HasMany
    {
        return $this->hasMany(DepartamentAllocationValue::class);
    }
}
