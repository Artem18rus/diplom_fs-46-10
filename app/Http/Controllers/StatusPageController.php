<?php

namespace App\Http\Controllers;

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
        } else {
            $switch = 'close';
        }
        return response()->json($switch);
    }
}
