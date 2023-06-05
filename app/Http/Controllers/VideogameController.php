<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideogameController extends Controller
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

        $videogames = DB::select($query, [5000, 7]);

        return view('videogames.top-rated', [
            'videogames' => $videogames
        ]);
    }
}
