<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallFormRequest\EditHallRequest;
use App\Http\Requests\HallFormRequest\StoreHallRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hall;
use App\Models\Standart_type;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Foreach_;

class HallController extends Controller
{
    public function index() {
        $hall = Hall::all(); 
        return view('admin/admin', compact('hall'));
    }

    public function store(StoreHallRequest $request) {
        $name = $request->input('name');
        $newHall = new Hall;
        $newHall->nameHall = $name;
        $newHall->save();
        return redirect()->action([HallController::class, 'index']);
    }

    
    public function edit(EditHallRequest $request) {
        // $data = $request->all();
        $params = $request->except('_token');
        // dump($params);

//добавление рядов и мест в БД:
        $arrPickRowChair = $params;
        foreach ($arrPickRowChair as $key => $value) {
            $pickKey = strstr($key, '_', true);
            if(!is_numeric($pickKey)) {
                unset($arrPickRowChair[$key]);
            }
        }
        $keys = array_keys($arrPickRowChair);
        $arrPickRowChairResult = [];
        foreach ($keys as $key => $value) {
            $numberId = strstr($value, '_', true);
            array_push($arrPickRowChairResult, $numberId);
        }
        $values = array_values($arrPickRowChair);
        for ($i = 0; $i < sizeof($values); $i++) {
            if ($i % 2 !== 0) {
                $modelChair = Hall::find($arrPickRowChairResult[$i]);
                $modelChair->chair = $values[$i];
                $modelChair->save();
            } else {
                $modelRow = Hall::find($arrPickRowChairResult[$i]);
                $modelRow->row = $values[$i];
                $modelRow->save();
            }
        }
        // dump($arrPickRowChair); // количество рядов и мест

//добавление выбранных мест в БД:
        $arrPickTypeChair = $params;
        foreach ($arrPickTypeChair as $key => $value) {
            $pickKey = strstr($key, '_', true);
                if(is_numeric($pickKey)) {
                    unset($arrPickTypeChair[$key]);
                }
        }
        // dump($arrPickTypeChair); // типы выбранных мест //arrFr

        $valueNameHallBd = Hall::pluck('nameHall');
        $listNameHallBd = [];
        foreach ($valueNameHallBd as $key => $value) {
          array_push($listNameHallBd, $value);
        }
        // dump($listNameHallBd);//arrBd

        // $idHallTable = Hall::all()->pluck('id')->toArray();
        // dump($idHallTable);

        foreach ($arrPickTypeChair as $key => $value) {
            $strRes = str_replace("_", " ", $key);
            foreach ($listNameHallBd as $keyBd => $valueBd) {
                // dump($valueBd);
                if($valueBd == $strRes) {
                    DB::table('halls')
                    ->where('nameHall', $strRes)
                    ->update(['hall_scheme' => $value]);
                }
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
