<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DonorTermAcceptance extends Model
{
    protected $fillable = [
        'donor_id',
        'accepted',
        'accepted_at'
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }
}
