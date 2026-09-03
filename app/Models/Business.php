<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'story',
        'address',
        'contact',
        'cover_image',
        'category_id',
    ];

    public function category()
    {

        return $this->belongsTo(Category::class);
    }

    public function strengths()
    {

        return $this->belongsToMany(Strength::class);
    }
}
