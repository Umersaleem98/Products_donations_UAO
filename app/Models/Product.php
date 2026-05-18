<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

   protected $table = 'products';
    
     protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'description',
        'images',
        'status'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donor()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
