<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ConnectionSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'connection_id',
        'points',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'id', 'sale_id');
    }

    public function connection(): HasOne
    {
        return $this->hasOne(Connection::class, 'id', 'connection_id');
    }
}
