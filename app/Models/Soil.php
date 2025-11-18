<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Soil extends Model
{
    use HasFactory;
    protected $fillable = ['name']; // can be mass assigned  
    // soil can belong to many recommendations
    public function recommendations() {
        return $this->belongsToMany(Recommendation::class, 'recommendation_soil');
    }
}

/*
fields: name
relationships: belongstomany recommendations via recommendation_soil pivot table
 */