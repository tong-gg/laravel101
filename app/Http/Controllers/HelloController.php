<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        return "Hello Laravel";
    }

    public function array()
    {
        // associative array, laravel will transform into => JSON
        return [
            'message'=> 'hello laravel',
            'success'=> true,
            'error'=> false,
            'number' => 10
        ];
    }

    public function posts($id = null){
        if ($id === null) {
            return "All posts";
        }
        return "Post: ". $id;
    }

    public function about()
    {
        // view(), means return view files in resources
        // using template engine .blade.php

        // passing params to blade view page
        // second param MUST be associate array, key is the name attach to view file

        // to prevent cross-site scripting, laravel will not process those script
        // but if you want to process anyway, check this out at about.blade.php
        return view('about', [
            'name' => 'Patipan Boonsimma',
            'info'=> [
                'address' => '<b>Kasetsart</b> University',
                'email'=> 'patipan.bo@ku.th<scipt>alert("Attack Code)</scipt>'
            ]
        ]);
    }
}
