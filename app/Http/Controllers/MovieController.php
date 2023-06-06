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

    public function detail()
    {
        $movie_id = $_GET['id'] ?? null;

        if (!$movie_id) {
            abort(404);
        }

        $movie = DB::selectOne('
            SELECT *
            FROM `movies`
            WHERE `id` = ?
        ', [
            $movie_id
        ]);

        if (!$movie) {
            abort(404);
        }

        $all_people = DB::select("
            SELECT `positions`.`name` AS position_name, `people`.*
            FROM `movie_person`
            LEFT JOIN `positions`
                ON `movie_person`.`position_id` = `positions`.`id`
            LEFT JOIN `people`
                ON `movie_person`.`person_id` = `people`.`id`
            WHERE `movie_person`.`movie_id` = ?
        ", [
            $movie->id
        ]);

        $people_sorted_by_position = [];
        foreach ($all_people as $person) {
            $people_sorted_by_position[$person->position_name][] = $person;
        }

        return view('movies.detail', [
            'movie' => $movie,
            'people' => $people_sorted_by_position
        ]);
    }

    public function shawshank()
    {
        $movie = DB::selectOne('
            SELECT *
            FROM `movies`
            WHERE `id` = ?
        ', [
            111161
        ]);

        if (!$movie) {
            abort(404);
        }

        $all_people = DB::select("
            SELECT `positions`.`name` AS position_name, `people`.*
            FROM `movie_person`
            LEFT JOIN `positions`
                ON `movie_person`.`position_id` = `positions`.`id`
            LEFT JOIN `people`
                ON `movie_person`.`person_id` = `people`.`id`
            WHERE `movie_person`.`movie_id` = ?
        ", [
            $movie->id
        ]);

        $people_sorted_by_position = [];
        foreach ($all_people as $person) {
            $people_sorted_by_position[$person->position_name][] = $person;
        }

        return view('movies.detail', [
            'movie' => $movie,
            'people' => $people_sorted_by_position
        ]);
    }

    public function search()
    {
        $search_term = $_GET['search'] ?? null;

        if ($search_term) {
            $results = DB::select("
                SELECT *
                FROM `movies`
                WHERE `name` LIKE ?
                ORDER BY `name` ASC
            ", [
                '%' . $search_term . '%'
            ]);
        }

        return view('movies.search', [
            'search_term' => $search_term,
            'results' => $results ?? []
        ]);
    }
}
