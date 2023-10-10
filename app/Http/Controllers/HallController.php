<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    public function store() {
        $hall = Hall::all();
        $lastindex = count($hall)-1;
        $newHall = new Hall;
        if($lastindex >= 0) {
            $lastValueStr = ($hall[$lastindex]->nameHall);
            $last = strlen($lastValueStr) - 1;
            $numb = $lastValueStr[$last]+1;
            $totalValue = "Зал {$numb}";
            $newHall->nameHall = $totalValue;
            $newHall->save();
        } else {
            $numb = 1;
            $totalValue = "Зал {$numb}";
            $newHall = new Hall;
            $newHall->nameHall = $totalValue;
            $newHall->save();
        }
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
