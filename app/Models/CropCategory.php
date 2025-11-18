<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CropCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    // crop cat can have many crops 
    public function crops() {
        return $this->belongsToMany(Crop::class, 'crop_crop_category', 'category_id', 'crop_id'); // look at pivot table crop_crop_category, use category_id to identify, link crop_id for each crop in category 
    }
}


/*
fields: name
relationships: belongstomany crops via crop_crop_category pivot 
*/