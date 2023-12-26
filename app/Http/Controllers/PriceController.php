<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallFormRequest\StorePriceRequest;
use App\Models\Hall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriceRequest $request)
    {
        $params = $request->except('_token');

        $arrPickPrice = $params;
        $valueNameHallBd = Hall::pluck('nameHall');
        $listNameHallBd = [];
        foreach ($valueNameHallBd as $key => $value) {
            array_push($listNameHallBd, $value);
        }
        // dump($listNameHallBd);//arrBd

        foreach ($arrPickPrice as $key => $value) {
            $keyHall = strstr($key,':', true);
            $keyHallRes = str_replace("_", " ", $keyHall);

            $keyType = substr(strstr($key,':'), 1);

            foreach ($listNameHallBd as $keyBd => $valueBd) {
                if($valueBd == $keyHallRes) {
                    DB::table('halls')
                    ->where('nameHall', $keyHallRes)
                    ->update([$keyType => $value]);
                }
            }
        }
        return redirect()->action([CountHallController::class, 'index']);
    }
}
