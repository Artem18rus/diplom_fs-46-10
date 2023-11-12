<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $movie = Movie::all();
        // dump($movie);
        // return view('admin/admin', compact('movie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => ['bail', 'required', 'max:255'],
            'duration' => ['bail', 'required', 'max:4'],
        ]);

        $movie = new Movie;
        $movie->nameMovie = $request->name;
        $movie->durationMovie = $request->duration;
        $movie->save();
        $data = Movie::all();
        // return response()->json(['success'=>'Form is successfully submitted!']);
        // return redirect()->action([CountHallController::class, 'index']);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
