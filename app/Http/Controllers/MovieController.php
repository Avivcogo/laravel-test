<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function actionMovies()
    {
        $movies = DB::select("
            SELECT *
            FROM `genre_movie`
            LEFT JOIN `movies`
                ON `genre_movie`.`movie_id` = `movies`.`id`
            WHERE `genre_movie`.`genre_id` = ?
            LIMIT 10
        ", [
            31
        ]);

        return view('movies.genre', compact(
            'movies'
        ));
    }
}
