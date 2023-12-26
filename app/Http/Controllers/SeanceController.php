<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeanceController extends Controller
{
    public function store(Request $request)
    {
        $BdHallId = Seance::pluck('hall_id');
        foreach ($BdHallId as $key => $value) {
            DB::table('seances')->where('hall_id', $request->hallTagId)->delete();
        }
        foreach ($request->hallTagId as $key => $value) {
            Seance::create([
                'startTime' => $request->timeTag[$key],
                'hall_id' => $value,
                'movie_id' => $request->movieTagId[$key],
                ]);
        }
        return response()->json(Seance::all());
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
