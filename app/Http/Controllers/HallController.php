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
        dump($valuesPickChair);

        $listNameHallFr = [];
        $strChair = [];
        foreach ($valuesPickChair as $key => $value) {
          $regexpHall = '/^ЗАЛ\s[1-9][0-9]?/';
          $resultHall = preg_match($regexpHall, $value, $foundHall);
          array_push($listNameHallFr, mb_strtolower($foundHall[0]));

          $result = str_replace("$foundHall[0], ", '', $value);
          array_push($strChair, $result);
        }
        dump($strChair);
        dump($listNameHallFr);//arrFr

        $valueNameHallBd = Hall::pluck('nameHall');
        $listNameHallBd = [];
        foreach ($valueNameHallBd as $key => $value) {
          array_push($listNameHallBd, mb_strtolower($value));
        }
        dump($listNameHallBd);//arrBd



        function mb_strtoupper_first($str, $encoding = 'UTF8')
        {
          return
            mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding) .
            mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $resStrChair = $strChair;
        dump($resStrChair);
        
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

        // dd($valueNameHall);
        //dd(mb_strtolower($valueNameHall[0]));

        // foreach ($valueNameHall as $key => $value) {
        //   // dump($value);
        //   $regexpHall = '/^Зал\s[1-9][0-9]?/';
        //   $resultHall = preg_match($regexpHall, $value, $foundHall);
        //   //dump($foundHall[0]);
        //   // $lowercaseStr = mb_strtolower($foundHall[0]);
        //   // dump($lowercaseStr);
        //   $keyss = array_search($value, $valuesPickChair);
        //   dump($keyss);
        // }

        // for ($i = 0; $i < sizeof($valuesPickChair); $i++) {
        //   // dump($valuesPickChair[$i]);
        //   $regexpHall = '/^ЗАЛ\s[1-9][0-9]?/';
        //   $resultHall = preg_match($regexpHall, $valuesPickChair[$i], $foundHall);
        //   $lowercaseStrItem = mb_strtolower($foundHall[0]);
        //   // dump($lowercaseStrItem);

        //   $peopleContainsCriminal = empty(array_intersect($foundHall, $listNameHall));
        //   dump($peopleContainsCriminal);
          // for ($j = 0; $j < sizeof($valueNameHall); $j++) {
          //   if($valueNameHall[$j] == $lowercaseStr[$i]) {
          //     dump($valueNameHall[$j]);
          //   }
          // }
        // DB::table('halls')
        //     ->updateOrInsert(
        //       ['nameHall' => $foundHall[0]],
        //       ['type-standart' => '8']
        // );

          // DB::table('halls')
          //     ->where('nameHall', 'Зал 5')
          //     ->update(['type-standart' => '7']);

        // if (Hall::where('nameHall', $foundHall[0])) {
        //   dump($foundHall[0]);
        // }
          // $user = Hall::find(8)->nameHall;
          // dump($user);
          // if ($foundHall[0] == Hall::find($valuesPickChair[$i])) {

          // }
          //   // dump($valuesPickChair[$i]);
          //   $regexpStr = '/строка\s[1-9][0-9]?/';
          //   $resultStr = preg_match($regexpStr, $valuesPickChair[$i], $foundStr);
          //   dump($foundStr);
          //   // dump(substr($foundStr[0], 13));
          // }
        // }
        // $valueNameHall = Hall::pluck('nameHall');
        // dump($valueNameHall[0]);
        // foreach ($valueNameHall as $item) {
        //   dump($item);
        // }



        // foreach ($arrPickRowStandart as $key => $value) {
        //     // dump($value);
        //     $pick = strstr($key, '_', true);
        //     if($pick !== "arrRowStandart") {
        //         // array_push($arrPickRowStandart, $key);
        //         // dump($value);
        //         unset($arrPickRowStandart[$key]);
        //         //dump($arrPickRowStandart);
        //     }
        // }
        // dump($arrPickRowStandart);

        // $arr = [];
        // foreach ($arrPickRowStandart as $key => $value) {
        //     $arr[] = $value;
        // }
        // dump($arr);
        // $values = array_values($arrPickRowStandart);
        // dd($values);
        // dd($arrPickRowStandart);
        // dd($params);


        // $arrPickRowChair=[];
        // $keys = array_keys($params);
        // foreach ($keys as $key => $value) {
        //     $pickKey = strstr($value, '_', true);
        //     if(is_numeric($pickKey)) {
        //         array_push($arrPickRowChair, $pickKey);
        //     }
        // }
        // // dd($arrPickRowChair);

        // $values = array_values($params);
        // for ($i = 0; $i < sizeof($values); $i++) {
        //     if ($i % 2 !== 0) {
        //         $modelChair = Hall::find($arrPickRowChair[$i]);
        //         $modelChair->chair = $values[$i];
        //         $modelChair->save();
        //     }
        //      else {
        //         $modelRow = Hall::find($arrPickRowChair[$i]);
        //         $modelRow->row = $values[$i];
        //         $modelRow->save();
        //     }
        // }
        // return redirect()->action([HallController::class, 'index']);
    }
    public function destroy($id) {
        $el = Hall::find($id); 
        $el->delete();
        return redirect()->action([HallController::class, 'index']);
    }
}
