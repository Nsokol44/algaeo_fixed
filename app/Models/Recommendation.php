<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Recommendation extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'rank_score', 'notes'];
    // each recommendation belongs to one product 
    public function product() {
        return $this->belongsTo(Product::class, 'product_id'); 
    }
    // a recommendation can apply to many soil types 
    public function soils() {
        return $this->belongsToMany(Soil::class, 'recommendation_soil', 'recommendation_id', 'soil_id'); 
    }
    //a recommendation can apply to many crops 
    public function crops() {
        return $this->belongsToMany(Crop::class, 'recommendation_crop', 'recommendation_id', 'crop_id'); 
    }
    // a recommendation can apply to many issues 
    public function issues() {
        return $this->belongsToMany(Issue::class, 'recommendation_issue', 'recommendation_id', 'issue_id'); 
    }
}
