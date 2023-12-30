<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            'img' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $path = Storage::putFile('public', $request->image);

        $movie = new Movie;
        $movie->nameMovie = $request->name;
        $movie->durationMovie = $request->duration;
        $movie->image = $path;
        $movie->save();
        $data = Movie::all();

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $el = Movie::find($request->idMovie);
        $el->delete();
        $imageItem = $el->image;
        $nameFile = substr($imageItem, 7);
        Storage::delete("public/$nameFile");

        return response()->json($nameFile);
    }
}
