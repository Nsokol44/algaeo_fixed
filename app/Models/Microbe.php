<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Microbe extends Model
{
    use HasFactory; 
    // to mass assign fields 
    protected $fillable = ['name', 'genus', 'species', 'function_summary', 'benefit_tags'];
    // a microbe belongs to many products via pivot 
    public function products() {
        return $this->belongsToMany(Product::class, 'product_microbe', 'microbe_id', 'product_id'); 
    }
}
