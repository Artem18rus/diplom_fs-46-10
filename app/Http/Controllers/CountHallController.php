<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallFormRequest\StoreHallCountRequest;
use App\Models\Movie;
use App\Models\Hall;
use App\Models\Seance;

class CountHallController extends Controller
{
    public function index() {
        $hall = Hall::all();
        return view('admin/admin', ['hall' => Hall::all(), 'movie' => Movie::all(), 'seance' => Seance::all()]);
    }

    public function store(StoreHallCountRequest $request) {
        $name = $request->input('name');
        $newHall = new Hall;
        $newHall->nameHall = $name;
        $newHall->save();
        return redirect()->action([CountHallController::class, 'index']);
    }
    public function destroy($id) {
        $el = Hall::find($id); 
        $el->delete();
        return redirect()->action([CountHallController::class, 'index']);
    }
}
