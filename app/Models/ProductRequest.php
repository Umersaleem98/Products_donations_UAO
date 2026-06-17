<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = [
        'beneficiary_id',
        'product_id',
        'donor_id',
        'admin_status',
        'donor_status',
        'message',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function beneficiary()
    {
        return $this->belongsTo(User::class, 'beneficiary_id');
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }
}
