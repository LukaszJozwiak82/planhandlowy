<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceBonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reference',
        'individually',
        'team',
        'month',
        'year',
        'quarter',
        'individual_components_percent',
        'team_components_percent',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
