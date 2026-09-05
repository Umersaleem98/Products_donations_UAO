<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class BeneficiaryProfile extends Model
{
    protected $fillable = [

        'user_id',

        // Personal Information
        'gender',

        // Academic Information
        'institution',
        'degree_level',
        'degree_program',
        'department',
        'semester',
        'cgpa',
        'enrollment_year',
        'graduation_year',

        // Family / Guardian Information
        'father_status',
        'guardian_profession',
        'monthly_income',

        // Location Information
        'province',
        'domicile',
        'home_address',
    ];

    protected $casts = [
        'monthly_income' => 'decimal:2',
        'cgpa' => 'decimal:2',
    ];

    /**
     * Beneficiary belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}