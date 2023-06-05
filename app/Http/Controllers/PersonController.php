<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    public function detail()
    {
        $person_id = $_GET['id'] ?? null;

        if (!$person_id) {
            abort(404);
        }

        $person = DB::selectOne('
            SELECT *
            FROM `people`
            WHERE `id` = ?
        ', [
            $person_id
        ]);

        if (!$person) {
            abort(404);
        }

        $all_movies = DB::select("
            SELECT `positions`.`name` AS position_name, `movies`.*
            FROM `movie_person`
            LEFT JOIN `positions`
                ON `movie_person`.`position_id` = `positions`.`id`
            LEFT JOIN `movies`
                ON `movie_person`.`movie_id` = `movies`.`id`
            WHERE `movie_person`.`person_id` = ?
        ", [
            $person->id
        ]);

        $movies_sorted_by_position = [];
        foreach ($all_movies as $movie) {
            $movies_sorted_by_position[$movie->position_name][] = $movie;
        }

        return view('people.detail', [
            'person' => $person,
            'movies' => $movies_sorted_by_position
        ]);
    }
}
