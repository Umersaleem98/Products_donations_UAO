<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Connection extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id','donor_id','beneficiary_id'
    ];

    public function request()
    {
        return $this->belongsTo(RequestModel::class, 'request_id');
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(User::class, 'beneficiary_id');
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }
}