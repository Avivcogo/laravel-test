<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        // select top movies from the database
        $top_movies = DB::select("
            SELECT *
            FROM `movies`
            WHERE `votes_nr` >= ?
                AND `movie_type_id` = ?
            ORDER BY `rating` DESC
            LIMIT 10
        ", [
            5000,
            1
        ]);

        // /resources/views/index/index.blade.php
        //                  index/index
        //                  index.index
        return view('index.index', compact(
            'top_movies'
        ));
    }
}
