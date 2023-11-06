<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallFormRequest\StorePriceRequest;
use App\Models\Hall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriceRequest $request)
    {
        $params = $request->except('_token');
        // dump($params);
        
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
            // dump($keyHallRes);

            $keyType = substr(strstr($key,':'), 1);
            // dump($keyType);

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

    /**
     * Display the specified resource.
     */
    public function show(Hall $hall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hall $hall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hall $hall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        //
    }
}
