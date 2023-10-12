<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallFormRequest\StoreHallRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hall;
use Illuminate\Support\Facades\Schema;

class HallController extends Controller
{
    public function index() {
        $hall = Hall::all(); 
        return view('admin/admin', compact('hall'));
    }
    public function store(StoreHallRequest $request) {
        // $validated = $request->validated();
        // dd($validated);
        // $data=$request->all();
        $name = $request->input('name');
        //dd($name);
        $newHall = new Hall;
        $newHall->nameHall = $name;
        $newHall->save();
        return redirect()->action([HallController::class, 'index']);
    }

    public function edit(Request $request) {
        //$uri = $request->path();
        $data=$request->all();
        dd($data);
        // return view('test');
    }
    public function destroy($id) {
        $el = Hall::find($id); 
        $el->delete();
        return redirect()->action([HallController::class, 'index']);
    }
}
