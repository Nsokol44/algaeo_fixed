<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Crop extends Model
{
    use HasFactory; 
    protected $fillable = ['name'];
    // a crop can belong to multiple categories 
    public function categories() {
        return $this->belongsToMany(CropCategory::class, 'crop_crop_category', 'crop_id', 'category_id'); 
    }
    // a crop can appear in multiple recommendations 
    public function recommendations() {
        return $this->belongsToMany(Recommendation::class, 'recommendation_crop', 'crop_id', 'recommendation_id');
    }
}

/*
fields: name
relationships: belongstomany categoris via crop_crop_cateogry pivot, belongs to many recommendations via recommendation_crop pivot

categories()
spinach → belongs to Leafy Greens
k ale → belongs to Leafy Greens AND Brassicas
uses pivot table crop_crop_category

recommendations()
example:
“Algaeo Nitrogen+” applies to “Leafy Greens + Yellow Leaves”
later:
“Tomato + Clay Soil” may also map to the same rec
uses pivot table recommendation_crop
*/
