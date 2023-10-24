<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallFormRequest\EditHallRequest;
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
        
        $name = $request->input('name');
        $newHall = new Hall;
        $newHall->nameHall = $name;
        $newHall->save();
        return redirect()->action([HallController::class, 'index']);
    }

    
    public function edit(EditHallRequest $request) {
        // $data = $request->all();
        $params = $request->except('_token');

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
        //dd($arrPickChair);

        $arrPickChairResult = [];
        foreach ($arrPickChair as $key => $value) {
          $pieces = explode(";", $value);
          array_push($arrPickChairResult, $pieces);
        }
        $newArrPickChair = array_merge(...$arrPickChairResult);
        // dd($newArrPickChair);

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
          array_push($listNameHallFr, mb_strtolower($foundHall[0]));

          $result = str_replace("$foundHall[0], ", '', $value);
          array_push($strChair, $result);
        }
        // dump($strChair);
        // dump($listNameHallFr);//arrFr

        $valueNameHallBd = Hall::pluck('nameHall');
        $listNameHallBd = [];
        foreach ($valueNameHallBd as $key => $value) {
          array_push($listNameHallBd, mb_strtolower($value));
        }
        // dump($listNameHallBd);//arrBd

        function mb_strtoupper_first($str, $encoding = 'UTF8')
        {
          return
            mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) .
            mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $resStrChair = $strChair;
        // dump($resStrChair);
        
        $acc = array();
        foreach($resStrChair as $someString){
          $acc[] = array($someString);
        }
        // dd($acc);

        // dd($resStrChair);
        for ($i = 0; $i < sizeof($listNameHallFr); $i++) {
          foreach ($listNameHallBd as $k => $v) {
              if ($listNameHallFr[$i] == $v) {
                  $firstBig = mb_strtoupper_first($v, $encoding = 'UTF8');
                DB::table('halls')
                  ->where('nameHall', $firstBig)
                  ->update(['type-standart' => json_encode($acc[$i])]);
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
