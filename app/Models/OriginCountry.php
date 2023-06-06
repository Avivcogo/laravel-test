<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OriginCountry extends Model
{
    use HasFactory;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_origin_country', 'movie_origin_country_id', 'movie_id');
    }
}
