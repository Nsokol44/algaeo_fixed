<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'description']; 
    // a product has many microbes 
    public function microbes() {
        return $this->belongsToMany(Microbe::class, 'product_microbe', 'product_id', 'microbe_id'); 
    }
    // a product can appear in many recommendations
    public function recommendations() {
        return $this->hasMany(Recommendation::class, 'product_id'); 
    }
}
