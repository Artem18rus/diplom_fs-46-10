<?php

namespace App\Http\Controllers;

use App\Models\StatusPagesClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusPagesClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $data = $request->input('status');

        $switch = null;
        $stringTable = StatusPagesClient::find(1);
        if($data == 'close') {
            $switch = 'open';
        } else {
            $switch = 'close';
        }
        $stringTable->status = $switch;
        $stringTable->save();
        return response()->json($switch);

    }

}
