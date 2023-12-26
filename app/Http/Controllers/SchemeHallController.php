<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallFormRequest\StoreShemeHallRequest;
use App\Models\Hall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SchemeHallController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShemeHallRequest $request)
    {
        $params = $request->except('_token');

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

        foreach ($arrPickTypeChair as $key => $value) {
            $strRes = str_replace("_", " ", $key);
            foreach ($listNameHallBd as $keyBd => $valueBd) {
                if($valueBd == $strRes) {
                    DB::table('halls')
                    ->where('nameHall', $strRes)
                    ->update(['hall_scheme' => $value]);
                }
            }
        }
        return redirect()->action([CountHallController::class, 'index']);
    }
}
