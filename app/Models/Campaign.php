<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'is_visible',
        'departament_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s',
    ];

    public function departament(): BelongsTo
    {
        return $this->belongsTo(Departament::class);
    }

    public function scopeByRole($query, $user)
    {
        if ($user->hasAnyRole(['admin', 'super-manager'])) {
            return $query;
        } elseif ($user->hasAnyRole('employee', 'manager')) {
            return $query->where('departament_id', $user->departament_id);
        }
    }
}
