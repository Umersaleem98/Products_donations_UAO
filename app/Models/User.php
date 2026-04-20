<?php
// app/Models/User.php

namespace App\Models;

use App\Models\Connection;
use App\Models\RequestModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Role check methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBeneficiary(): bool
    {
        return $this->role === 'beneficiary';
    }

    public function isDonor(): bool
    {
        return $this->role === 'donor';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }



    public function products()
{
    return $this->hasMany(Product::class);
}

public function sentRequests()
{
    return $this->hasMany(RequestModel::class, 'beneficiary_id');
}

public function receivedRequests()
{
    return $this->hasMany(RequestModel::class, 'donor_id');
}

public function donorConnections()
{
    return $this->hasMany(Connection::class, 'donor_id');
}

public function beneficiaryConnections()
{
    return $this->hasMany(Connection::class, 'beneficiary_id');
}
}