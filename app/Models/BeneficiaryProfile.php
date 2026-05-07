<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DonorProfile extends Model
{
      
    protected $fillable = [
        'user_id',
        'institution',
        'course',
        'father_status',
        'father_profession',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
