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
        dump($params);


        foreach ($params as $key => $value) {
            if($value == null){
                unset($params[$key]);
            }
        }

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
        // dump($arrPickRowChairResult);
        $values = array_values($arrPickRowChair);
        for ($i = 0; $i < sizeof($values); $i++) {
            // dump($values[$i]);
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

        //добавление выбранных мест в БД:
        // dd($params);
        $arrPickChair = $params;
        foreach ($arrPickChair as $key => $value) {
          $pickKey = strstr($key, '_', true);
          if($pickKey !== "arrRowStandart") {
            unset($arrPickChair[$key]);
          }
        }
        // dump($arrPickChair);

        $arrPickChairResult = [];
        foreach ($arrPickChair as $key => $value) {
          $pieces = explode(";", $value);
          array_push($arrPickChairResult, $pieces);
        }
        $newArrPickChair = array_merge(...$arrPickChairResult);
        // dump($arrPickChairResult);
        // dump($newArrPickChair);

        foreach ($newArrPickChair as $key => $value) {
          if($value == '') {
            unset($newArrPickChair[$key]);
          }
        }
        // dump($newArrPickChair);

        foreach ($newArrPickChair as $key => $value) {
          $newArrPickChair[$key] = ltrim($value, ','); 
        }
        // dd($newArrPickChair);

        $valuesPickChair = array_values($newArrPickChair);
        // dump($valuesPickChair);

        $listNameHallFr = [];
        $strChair = [];
        foreach ($valuesPickChair as $key => $value) {
          $regexpHall = '/^ЗАЛ\s[1-9][0-9]?/';
          $resultHall = preg_match($regexpHall, $value, $foundHall);
          array_push($listNameHallFr, $foundHall[0]);

          $result = str_replace("$foundHall[0], ", '', $value);
          array_push($strChair, $result);
        }
        dump($listNameHallFr); //arrFr
        dump($strChair);

        $arrRowChair = [];
        foreach ($strChair as $key => $value) {
          $pieces = explode(", ", $value);
          array_push($arrRowChair, $pieces);
        }
        dump($arrRowChair);

        $arrNumberHall = [];
        foreach ($listNameHallFr as $key => $value) {
          // dump($value);
          array_push($arrNumberHall, ltrim(strstr($value, ' ')));
        }
        dump($arrNumberHall);


        dump(Standart_type::all()->pluck('hall_id')->toArray());
        // foreach (Standart_type::all() as $key => $value) {
        //   dump($value->id);
        // }



        // for ($i = 0; $i < sizeof($arrNumberHall); $i++) {

        //   // dump($arrNumberHall[$i]);
        // }
        // $c = array_combine($arrNumberHall, $arrRowChair);
        // dump($c);

      // return redirect()->action([HallController::class, 'index']);
    }
    public function destroy($id) {
        $el = Hall::find($id); 
        $el->delete();
        return redirect()->action([HallController::class, 'index']);
    }
}
