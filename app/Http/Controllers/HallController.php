<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallFormRequest\StoreHallRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hall;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Foreach_;

class HallController extends Controller
{
    public function index() {
        $hall = Hall::all(); 
        return view('admin/admin', compact('hall'));
    }

    public function store(StoreHallRequest $request) {
        // $validated = $request->validated();
        // dd($validated);
        $data=$request->all();
        $name = $request->input('name');
        //dd($name);
        $newHall = new Hall;
        $newHall->nameHall = $name;
        $newHall->save();
        return redirect()->action([HallController::class, 'index']);
    }

    public function edit(Request $request) {
        $params = $request->except('_token');
        $arrPick=[];
        $keys = array_keys($params);
        foreach ($keys as $key => $value) {
            $b = strstr($value, '_', true);
            array_push($arrPick, $b);
        }
        $values = array_values($params);
        for ($i = 0; $i < sizeof($values); $i++) {
            if ($i % 2 !== 0) {
                $modelChair = Hall::find($arrPick[$i]);
                $modelChair->chair = $values[$i];
                $modelChair->save();
            }
             else {
                $modelRow = Hall::find($arrPick[$i]);
                $modelRow->row = $values[$i];
                $modelRow->save();
            }
        }
        return redirect()->action([HallController::class, 'index']);
    }
    public function destroy($id) {
        $el = Hall::find($id); 
        $el->delete();
        return redirect()->action([HallController::class, 'index']);
    }
}
