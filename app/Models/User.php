<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Mass assignable fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'role',
        'qalam_id',
        'account_status',
        'status_reason',
        'status_changed_at',
        'status_changed_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden fields
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status_changed_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Role helper methods
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDonor(): bool
    {
        return $this->role === 'donor';
    }

    public function isBeneficiary(): bool
    {
        return $this->role === 'beneficiary';
    }

    /*
    |--------------------------------------------------------------------------
    | Account-status helper methods
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->account_status === 'active';
    }

    public function isSuspended(): bool
    {
        return $this->account_status === 'suspended';
    }

    public function isBlocked(): bool
    {
        return $this->account_status === 'blocked';
    }

    public function canAccessSystem(): bool
    {
        return $this->account_status === 'active';
    }

    /*
    |--------------------------------------------------------------------------
    | User relationships
    |--------------------------------------------------------------------------
    */

    public function beneficiaryProfile(): HasOne
    {
        return $this->hasOne(BeneficiaryProfile::class);
    }

    public function donorProfile(): HasOne
    {
        return $this->hasOne(DonorProfile::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function termAcceptance(): HasOne
    {
        return $this->hasOne(
            DonorTermAcceptance::class,
            'donor_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Account-status relationships
    |--------------------------------------------------------------------------
    */

    public function statusChangedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'status_changed_by'
        );
    }

    public function changedUserStatuses(): HasMany
    {
        return $this->hasMany(
            User::class,
            'status_changed_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Profile-completion calculation
    |--------------------------------------------------------------------------
    */

    public function profileCompletion(): int
    {
        $fields = [
            $this->name,
            $this->email,
            $this->phone,
            $this->cnic,
            $this->institution,
            $this->father_status,
            $this->guardian_profession,
            $this->total_monthly_income,
            $this->province,
            $this->domicile,
            $this->home_address,
        ];

        $filledFields = 0;

        foreach ($fields as $field) {
            if (! empty($field)) {
                $filledFields++;
            }
        }

        if (count($fields) === 0) {
            return 0;
        }

        return (int) round(
            ($filledFields / count($fields)) * 100
        );
    }
}
