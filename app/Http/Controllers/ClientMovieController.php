<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientMovieController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->input('dataMovie');

        $array = json_decode($params);
        $hallPick = $array[0]->hall;
        $moviePick = $array[0]->movie;
        $startTimePick = $array[0]->startTime;

        $rowBd = DB::table('halls')->where('nameHall', $hallPick)->value('row');
        $chairBd = DB::table('halls')->where('nameHall', $hallPick)->value('chair');
        $hallScheme = DB::table('halls')->where('nameHall', $hallPick)->value('hall_scheme');
        $priceStandart = DB::table('halls')->where('nameHall', $hallPick)->value('standart-price');
        $priceVip = DB::table('halls')->where('nameHall', $hallPick)->value('vip-price');
        
        $day = substr(url()->previous(), -2);
        if($day == 'pn') {
          $dayPick = 'Пн';
        } else if($day == 'vt') {
          $dayPick = 'Вт';
        } else if($day == 'sr') {
          $dayPick = 'Ср';
        } else if($day == 'ct') {
          $dayPick = 'Чт';
        } else if($day == 'pt') {
          $dayPick = 'Пт';
        } else if($day == 'sb') {
          $dayPick = 'Сб';
        }

        return view('client/hall', ['hallPick' => $hallPick, 'moviePick' => $moviePick, 'startTimePick' => $startTimePick, 'rowBd' => $rowBd, 'chairBd' => $chairBd, 'hallScheme' => $hallScheme, 'priceStandart' => $priceStandart, 'priceVip' => $priceVip, 'dayPick' => $dayPick]);
    }
}
