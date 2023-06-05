<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
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
