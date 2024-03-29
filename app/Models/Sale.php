<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'actual_date',
        'client_id',
        'value',
        'day',
        'month',
        'year',
        'quarter',
        'recommended',
        'sale_id',
        'points',
        'departament_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s',
        'actual_date' => 'datetime:Y-m-d',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function departament(): BelongsTo
    {
        return $this->belongsTo(Departament::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function depositValues(): HasMany
    {
        return $this->hasMany(DepositValue::class);
    }

    public function connectionSales(): HasMany
    {
        return $this->hasMany(ConnectionSale::class);
    }

    public function loanSales(): HasMany
    {
        return $this->hasMany(LoanSale::class);
    }

    public function insuranceSales(): HasMany
    {
        return $this->hasMany(InsuranceSale::class);
    }

    public function packageSales(): HasMany
    {
        return $this->hasMany(PackageSale::class);
    }
}
