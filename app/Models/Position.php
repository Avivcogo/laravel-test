<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_person');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'movie_person');
    }
}
