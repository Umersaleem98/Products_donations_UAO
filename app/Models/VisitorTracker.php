<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorTracker extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'browser',
        'platform',
        'cookie_accepted',
        'visited_at'
    ];
}
