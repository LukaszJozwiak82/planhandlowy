<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Deposit extends Model
{
    use HasFactory;

    public function depositValue(): BelongsTo
    {
        return $this->belongsTo(DepositValue::class);
    }

    public function packageDeposit(): HasOne
    {
        return $this->hasOne(PackageDeposit::class, 'deposit_id');
    }
}
