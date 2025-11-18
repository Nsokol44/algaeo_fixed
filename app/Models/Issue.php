<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Issue extends Model
{
    use HasFactory; 
    protected $fillable = ['name'];
    // an issue can belong to many recommendations
    public function recommendations() {
        return $this->belongsToMany(Recommendation::class, 'recommendation_issue', 'issue_id', 'recommendation_id');
    }
}


/*
fields: name
relationships: belongstomany recommendations via recommendation_issue pivot 
*/