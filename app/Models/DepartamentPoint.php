<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartamentPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'departament_id',
        'points',
        'day',
        'month',
        'year',
        'quarter',
    ];

    public function departament(): BelongsTo
    {
        return $this->belongsTo(Departament::class);
    }
}
