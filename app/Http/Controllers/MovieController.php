<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function topRated()
    {
        $query = "
            SELECT *
            FROM `movies`
            WHERE `votes_nr` >= ?
                AND `movie_type_id` = ?
            ORDER BY `rating` DESC
            LIMIT 50
        ";

        $movies = DB::select($query, [5000, 1]);

        return view('movies.top-rated', compact('movies'));
    }
}
