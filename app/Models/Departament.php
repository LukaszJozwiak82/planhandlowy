<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function campaign(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    public function departamentPoints(): HasMany
    {
        return $this->hasMany(DepartamentPoint::class, 'departament_id', 'id');
    }

    public function scopeByRole($query, $user)
    {
        if ($user->hasAnyRole(['admin', 'super-manager'])) {
            return $query;
        } elseif ($user->hasAnyRole('employee', 'manager')) {
            return $query->where('id', $user->departament_id);
        }
    }
}
