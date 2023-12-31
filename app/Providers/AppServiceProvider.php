<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Seance;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $itemMovieDiscription = ['Две сотни лет назад малороссийские хутора разоряла шайка нехристей-ляхов во главе с могущественным колдуном.', '20 тысяч лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу.', 'Самые опасные хищники Вселенной, прибыв из глубин космоса, высаживаются на улицах маленького городка, чтобы начать свою кровавую охоту. Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее.', 'Подросток из Нью-Джерси переезжает в Калифорнию и встречает мастера боевых искусств, который учит, как защититься от местных хулиганов.', 'На Аляске терпит крушение самолет, и оставшиеся в живых пассажиры оказываются в плену безлюдной снежной пустыни, где только стая волков скрашивает пейзаж. Люди хотят выжить любой ценой, и теперь им предстоит смертельная схватка.', 'Две сотни лет назад малороссийские хутора разоряла шайка нехристей-ляхов во главе с могущественным колдуном.', '20 тысяч лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу.', 'Самые опасные хищники Вселенной, прибыв из глубин космоса, высаживаются на улицах маленького городка, чтобы начать свою кровавую охоту. Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее.', 'Подросток из Нью-Джерси переезжает в Калифорнию и встречает мастера боевых искусств, который учит, как защититься от местных хулиганов.', 'На Аляске терпит крушение самолет, и оставшиеся в живых пассажиры оказываются в плену безлюдной снежной пустыни, где только стая волков скрашивает пейзаж. Люди хотят выжить любой ценой, и теперь им предстоит смертельная схватка.'];
        $imgMovie = ['poster1.jpg', 'poster2.jpg', 'poster3.jpg', 'poster4.jpg'];
        $country = ['Россия', 'США', 'Швеция', 'Франция', 'Россия', 'США', 'Швеция', 'Франция'];
        $bdMovieId = DB::table('movies')->pluck('id')->all();
        view()->share(['movie' => Movie::all(), 'itemMovieDiscription' => $itemMovieDiscription, 'bdMovieId' => $bdMovieId, 'imgMovie' => $imgMovie, 'country' => $country]);
    }
}
