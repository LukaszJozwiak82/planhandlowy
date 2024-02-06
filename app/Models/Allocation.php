<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Allocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'month',
        'year',
        'quarter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Loan::class);
    }

    public function allocationValues(): HasMany
    {
        return $this->hasMany(AllocationValue::class);
    }
}
