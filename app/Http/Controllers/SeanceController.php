<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('/admin/seanceIndex');
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
        //dd($request->all());
        $seanse = new Seance;
        // $seanse->startTime = json_encode($request->timeTag);
        // $seanse->hall_id = $request->hallTagId;
        // $seanse->movie_id = json_encode($request->movieTagId);
        // $seanse->save();


        // $data = $request;
        // return response()->json(['success'=>'Form is successfully submitted!']);
        // return redirect()->action([CountHallController::class, 'index']);
        return response()->json($seanse->startTime);
    }

    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seance $seance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        //
    }
}
