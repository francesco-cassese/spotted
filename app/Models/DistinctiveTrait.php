<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistinctiveTrait extends Model
{
    public function businesses()
    {

        return $this->belongsToMany(Business::class);
    }
}
