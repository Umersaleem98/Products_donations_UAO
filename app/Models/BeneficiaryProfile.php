<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BeneficiaryProfile extends Model
{
     protected $fillable = [

        'user_id',

        'institution',
        'enrollment_year',
        'graduation_year',

        'father_status',

        'guardian_profession',

        'monthly_income',

        'province',

        'domicile',

        'home_address',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
