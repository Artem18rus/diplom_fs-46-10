<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Seance;

class ClientMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemMovieDiscription = ['Две сотни лет назад малороссийские хутора разоряла шайка нехристей-ляхов во главе с могущественным колдуном.', '20 тысяч лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу.', 'Самые опасные хищники Вселенной, прибыв из глубин космоса, высаживаются на улицах маленького городка, чтобы начать свою кровавую охоту. Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее.', 'Подросток из Нью-Джерси переезжает в Калифорнию и встречает мастера боевых искусств, который учит, как защититься от местных хулиганов.', 'На Аляске терпит крушение самолет, и оставшиеся в живых пассажиры оказываются в плену безлюдной снежной пустыни, где только стая волков скрашивает пейзаж. Люди хотят выжить любой ценой, и теперь им предстоит смертельная схватка.'];
        $imgMovie = ['poster1.jpg', 'poster2.jpg', 'poster3.jpg', 'poster4.jpg'];
        $bdMovieId = DB::table('movies')->pluck('id')->all();
        
        return view('client/client', ['movie' => Movie::all(), 'itemMovieDiscription' => $itemMovieDiscription, 'bdMovieId' => $bdMovieId, 'imgMovie' => $imgMovie]);
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
        $params = $request->except('_token');
        return view('client/hall', ['data' => $params]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
