<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class StatusPageController extends Controller
{
    public function index(Request $request) 
    {
        $data = $request->input('status');
        $switch = null;
        if($data == 'close') {
            $switch = 'open';
            Route::get('/', function(){
                return view('/sr');
              });
        } else {
            $switch = 'close';
            Route::get('/', function(){
                return view('/status');
              });
        }

        return response()->json($switch);
    }
}
