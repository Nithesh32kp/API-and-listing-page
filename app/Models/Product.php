<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['pro_name', 'price', 'pro_wt', 'size', 'stock'];

    public function orders(){
        return $this->belongsToMany(Orders::class,'id','id');
    }
}
