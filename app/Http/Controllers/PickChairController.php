<?php

namespace App\Http\Controllers;

use App\Models\PickChair;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PickChairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client/hall');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dayPick = $request->input('dayPick');
        $moviePick = $request->input('moviePick');
        $hallPick = $request->input('hallPick');
        $startTimePick = $request->input('startTimePick');
        $selectedChair = $request->input('selectedChair');

        $newPickChair = new PickChair;
        $newPickChair->day_pick = $dayPick;
        $newPickChair->movie_pick = $moviePick;
        $newPickChair->hall_pick = $hallPick;
        $newPickChair->startTime_pick = $startTimePick;
        $newPickChair->selected_chair = $selectedChair;
        $newPickChair->save();

        return view('client/payment', ['dayPick' => $dayPick, 'moviePick' => $moviePick, 'hallPick' => $hallPick, 'startTimePick' => $startTimePick, 'selectedChair' => $selectedChair]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $dayPick = $request->input('dayPick');
        $moviePick = $request->input('moviePick');
        $hallPick = $request->input('hallPick');
        $startTimePick = $request->input('startTimePick');
        $stringResultSelectedChair = $request->input('stringResultSelectedChair');
        $stringResultPrice = $request->input('stringResultPrice');
        return view('client/ticket', ['dayPick' => $dayPick, 'moviePick' => $moviePick, 'hallPick' => $hallPick, 'startTimePick' => $startTimePick, 'stringResultSelectedChair' => $stringResultSelectedChair, 'stringResultPrice' => $stringResultPrice]);
    }
}
