<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Coderflex\LaravelTicket\Concerns\HasTickets;
use Coderflex\LaravelTicket\Contracts\CanUseTickets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements CanUseTickets
{
    use HasApiTokens, HasFactory, HasRoles, HasTickets, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'departament_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ROLES = [
        'employee' => 'Doradca',
        'manager' => 'Dyrektor',
        'super-manager' => 'WPH',
        'admin' => 'ADMIN',
    ];

    public function departament(): BelongsTo
    {
        return $this->belongsTo(Departament::class);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function allocations(): HasMany
    {
        return $this->hasMany(Allocation::class);
    }

    public function referenceBonuses(): HasMany
    {
        return $this->hasMany(ReferenceBonus::class);
    }

    public function employeePoints(): HasMany
    {
        return $this->hasMany(EmployeePoint::class);
    }

    public function contact(): HasOne
    {
        return $this->HasOne(Contact::class);
    }

    public function getPoints($year, $quarter)
    {
        return intval(implode(',', $this->employeePoints()->where('year', $year)->where('quarter', $quarter)->pluck('points')->toArray()));
    }

    public function getScore($year, $quarter)
    {
        return $this->sales()->where('year', $year)->where('quarter', $quarter)->sum('points');
    }

    public function getBonusParams($year, $quarter)
    {
        return $this->referenceBonuses()->where('year', $year)->where('quarter', $quarter)->get();
    }

    public function getRealization($year, $quarter)
    {
        if ($this->getScore($year, $quarter) > 0 && $this->getPoints($year, $quarter) > 0) {
            return number_format(intval($this->getScore($year, $quarter)) / intval($this->getPoints($year, $quarter)) * 100, 2);
        }

        return '0';
    }

    public function scopeByUser($query, $user)
    {
        if ($user->hasRole('admin')) {
            return $query->role(['employee', 'manager', 'super-manager', 'admin']);
        } elseif ($user->hasRole('super-manager')) {
            return $query->role(['employee', 'manager']);
        } else {
            return $query->role('employee')->where('departament_id', auth()->user()->departament_id);
        }
    }
}
