<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function allocationValues(): HasMany
    {
        return $this->hasMany(AllocationValue::class);
    }

    public function departamentAllocationValues(): HasMany
    {
        return $this->hasMany(DepartamentAllocationValue::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
}
