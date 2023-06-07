<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * list of movies
     */
    public function index()
    {
        $movies = Movie::orderBy('name') // FROM `movies` ORDER BY `name`
            ->where('name', '!=', '')    // WHERE `name` != ''
            ->limit(20)                  // LIMIT 20
            ->get();                     // SELECT *

        dd($movies);

    }

    public function actionMovies()
    {
        $genre = Genre::find(31);

        $movies = $genre->movies() // SELECT *
                                   // FROM `genre_movie`
                                   // LEFT JOIN `movies`
                                   //   ON `genre_movie`.`movie_id` = `movies`.`id`
                    ->orderBy('rating', 'desc')
                    ->limit(10)
                    ->get();

        // $movies = Movie::query()
        //     // ->select('id AS movie_id', 'name', 'year AS movie_year')
        //     ->where('genre_id', 31)
        //     ->from('genre_movie') // FROM `genre_movie`
        //     ->leftJoin('movies', 'genre_movie.movie_id', 'movies.id')
        //     ->limit(10)
        //     ->orderBy('rating', 'desc')
        //     ->get();

        // $movies = DB::select("
        //     SELECT *
        //     FROM `genre_movie`
        //     LEFT JOIN `movies`
        //         ON `genre_movie`.`movie_id` = `movies`.`id`
        //     WHERE `genre_movie`.`genre_id` = ?
        //     LIMIT 10
        // ", [
        //     31
        // ]);

        return view('movies.genre', compact(
            'movies'
        ));
    }

    public function detail($movie_id)
    {
        if (!$movie_id) {
            abort(404);
        }

        // $movie = DB::selectOne('
        //     SELECT *
        //     FROM `movies`
        //     WHERE `id` = ?
        // ', [
        //     $movie_id
        // ]);

        // finds a record using the primary key
        // if not found, aborts with 404 error
        $movie = Movie::findOrFail($movie_id);
        // you can't get here without having the movie object

        // if (!$movie) {
        //     abort(404);
        // }

        $all_people = $movie->people()
            ->select('people.*', 'movie_person.description', 'positions.name AS position_name')
            ->leftJoin('positions', 'movie_person.position_id', 'positions.id')
            ->get();

        // $all_people = DB::select("
        //     SELECT `positions`.`name` AS position_name, `people`.*
        //     FROM `movie_person`
        //     LEFT JOIN `positions`
        //         ON `movie_person`.`position_id` = `positions`.`id`
        //     LEFT JOIN `people`
        //         ON `movie_person`.`person_id` = `people`.`id`
        //     WHERE `movie_person`.`movie_id` = ?
        // ", [
        //     $movie->id
        // ]);

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
        // $movie = DB::selectOne('
        //     SELECT *
        //     FROM `movies`
        //     WHERE `id` = ?
        // ', [
        //     111161
        // ]);

        $movie = Movie::where('id', 111161) // FROM `movies` WHERE `id` = 111161
            ->first(); // SELECT

        // same as above
        // finds using the primary key (by default `id`)
        $movie = Movie::findOrFail(111161);

        // if (!$movie) {
        //     abort(404);
        // }

        $all_people = $movie->people()
            ->select('people.*', 'movie_person.description', 'positions.name AS position_name')
            ->leftJoin('positions', 'movie_person.position_id', 'positions.id')
            ->get();

        // $all_people = DB::select("
        //     SELECT `positions`.`name` AS position_name, `people`.*
        //     FROM `movie_person`
        //     LEFT JOIN `positions`
        //         ON `movie_person`.`position_id` = `positions`.`id`
        //     LEFT JOIN `people`
        //         ON `movie_person`.`person_id` = `people`.`id`
        //     WHERE `movie_person`.`movie_id` = ?
        // ", [
        //     $movie->id
        // ]);

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
            $results = Movie::query()
                ->where('name', 'like', '%' . $search_term . '%')
                ->orderBy('name')
                ->get();
            // $results = DB::select("
            //     SELECT *
            //     FROM `movies`
            //     WHERE `name` LIKE ?
            //     ORDER BY `name` ASC
            // ", [
            //     '%' . $search_term . '%'
            // ]);
        }

        return view('movies.search', [
            'search_term' => $search_term,
            'results' => $results ?? []
        ]);
    }

    public function topRated($year = null, $orderby = null)
    {
        $builder = Movie::where('votes_nr', '>=', 5000);  // FROM `movies` WHERE `votes_nr` >= 5000

        $builder->limit(50); // LIMIT 50

        if ($orderby) {
            $builder->orderBy($orderby, 'desc'); // ORDER BY `rating` DESC
        }

        if ($year) {
            $builder->where('year', $year);
        }

        $builder->where('movie_type_id', 1); // AND `movie_type_id` = 1

        $movies = $builder->get(); // SELECT *


        // $query = "
        //     SELECT *
        //     FROM `movies`
        //     WHERE `votes_nr` >= ?
        //         AND `movie_type_id` = ?
        //     ORDER BY `rating` DESC
        //     LIMIT 50
        // ";

        // $movies = DB::select($query, [5000, 1]);

        return view('movies.top-rated', compact('movies'));
    }
}
