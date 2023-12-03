<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $seanse = new Seance;

        $BdHallId = Seance::pluck('hall_id');
        foreach ($BdHallId as $key => $value) {
            DB::table('seances')->where('hall_id', $request->hallTagId)->delete();
        }

            // $reqTimeTag = json_encode($request->timeTag);
            // $reqMovieTagId = json_encode($request->movieTagId);

            // Seance::create([
            //     'hall_id' => $request->hallTagId,
            //     'startTime' => $reqTimeTag,
            //     'movie_id' => $reqMovieTagId,
            //     ]);


        foreach ($request->hallTagId as $key => $value) {
            Seance::create([
                'startTime' => $request->timeTag[$key],
                'hall_id' => $value,
                'movie_id' => $request->movieTagId[$key],
                ]);
        }

        // return response()->json(['success'=>'Form is successfully submitted!']);
        // return redirect()->action([CountHallController::class, 'index']);
        return response()->json(Seance::all());
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
    public function destroy()
    {
        Seance::truncate();
        return response()->json(Seance::all());
    }
}
