<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['bail', 'required', 'max:255'],
            'duration' => 'bail|required|max:3|gte:30|lte:180',
        ]);

        $movie = new Movie;
        $movie->nameMovie = $request->name;
        $movie->durationMovie = $request->duration;
        $movie->save();
        $data = Movie::all();

        return response()->json($data);
    }
}
