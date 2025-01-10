<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function options(): BelongsToMany
    {
         return $this->belongsToMany(Option::class, 'products_options');
         
    }
    public function categories()
    {
         return $this->belongsToMany(Category::class, 'products_categories');
    }
    public function orders()
    {
      return $this->belongsToMany(Order::class,'orders_details');
    }   
}
