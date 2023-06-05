<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        // typically this would come from DB
        // (some DB queries would be run)
        $awards = [
            'Oscars',
            'Golden Globes',
            'Bafta',
            'Emmy'
        ];

        // dump($awards);
        // dd($awards);

        // /resources/views/awards/index.blade.php
        //                  awards/index
        //                  awards.index
        return        view('awards.index',
            [
                // this creates a variable $some_variable
                // within the view, it will have the value
                // 'some value'
                'some_variable' => 'some value',
                // this creates a variable $title ...
                'title' => 'List of awards',
                // this creates a variable $display_navigation ...
                'display_navigation' => true,

                'awards' => $awards
            ]
        );
    }


    public function indexTwo()
    {
        $awards = [
            'Oscars',
            'Golden Globes',
            'Bafta',
            'Emmy'
        ];

        $title = 'List of awards';

        $display_navigation = true;



        // compact is an inbuilt PHP function
        // compact('awards', 'title', 'display_navigation');
        // generates this:
        // [
        //     'awards'             => $awards,
        //     'title'              => $title,
        //     'display_navigation' => $display_navigation
        // ]


        return view('awards.index', compact(
            'awards',
            'title',
            'display_navigation'
        ));
    }
}
