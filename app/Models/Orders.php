<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
    ];

    // Order belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Order belongs to many Products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_id', 'id');
    }
}