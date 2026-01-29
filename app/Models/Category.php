<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image'];

    // Relasi ke produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
