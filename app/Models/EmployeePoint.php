<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'day',
        'month',
        'year',
        'quarter',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
