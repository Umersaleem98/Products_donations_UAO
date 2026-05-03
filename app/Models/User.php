<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\BeneficiaryProfile;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
   protected $fillable = [
        'name', 'email', 'password', 'image','role', 'qalam_id'
    ];



    public function isAdmin()
{
    return $this->role === 'admin';
}

public function isDonor()
{
    return $this->role === 'donor';
}

public function isBeneficiary()
{
    return $this->role === 'beneficiary';
}

   public function beneficiaryProfile()
    {
        return $this->hasOne(BeneficiaryProfile::class);
    }

    public function donorProfile()
    {
        return $this->hasOne(DonorProfile::class);
    }

    public function products()
{
    return $this->hasMany(Product::class);
}


  

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
