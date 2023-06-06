<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideogameController extends Controller
{
    public function index()
    {
        // select all games
        $movie_type = MovieType::where('name', 'game')->first();

        var_dump($movie_type->movies->pluck('name')); die();
        dd($movie_type);
    }

    public function topRated()
    {
        $videogames = Movie::query()        // FROM `movies`
            ->where('votes_nr', '>=', 5000) // WHERE `votes_nr` >= 5000
            ->where('movie_type_id', 7)     // AND `movie_type_id` = 7
            ->orderBy('rating', 'desc')     // ORDER BY `rating` DESC
            ->limit(50)                     // LIMIT 50
            ->get();                        // SELECT

        // $names_indexed_by_ids = $videogames->filter(function($game) { return $game->year > 2013; })->pluck('name', 'id');
        // dd($names_indexed_by_ids);

        // $query = "
        //     SELECT *
        //     FROM `movies`
        //     WHERE `votes_nr` >= ?
        //         AND `movie_type_id` = ?
        //     ORDER BY `rating` DESC
        //     LIMIT 50
        // ";

        // $videogames = DB::select($query, [5000, 7]);

        return view('videogames.top-rated', [
            'videogames' => $videogames
        ]);
    }
}
