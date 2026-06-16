<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = [
        'beneficiary_id',
        'product_id',
        'donor_id',
        'status',
        'status',
        'message',
        'donor_status'
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
