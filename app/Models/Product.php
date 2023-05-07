<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;
    protected $fillable = ['user_id','category_id', 'title', 'price', 'desc', 'quantity', 'img'];
    protected $casts = ['img' => 'json',];
    public function carts() {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
