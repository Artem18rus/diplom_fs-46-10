<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="CSS/client/normalize.css">
  <link rel="stylesheet" href="CSS/client/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <button onclick="location.href='/login'" style="cursor: pointer; padding: 10px; font-size: 16px">Войти в админпанель</button>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  
  <nav class="page-nav">
    <a class="page-nav__day page-nav__day_today" href="#">
      <span class="page-nav__day-week">Пн</span><span class="page-nav__day-number">31</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Вт</span><span class="page-nav__day-number">1</span>
    </a>
    <a class="page-nav__day page-nav__day_chosen" href="#">
      <span class="page-nav__day-week">Ср</span><span class="page-nav__day-number">2</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Чт</span><span class="page-nav__day-number">3</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Пт</span><span class="page-nav__day-number">4</span>
    </a>
    <a class="page-nav__day page-nav__day_weekend" href="#">
      <span class="page-nav__day-week">Сб</span><span class="page-nav__day-number">5</span>
    </a>
    <a class="page-nav__day page-nav__day_next" href="#">
    </a>
  </nav>
  {{-- {{$movie}} --}}
  
  <main class="schedule">
    <form class='data-movie' action="/hall" method="post" accept-charset="utf-8">
    @csrf
      @for ($i = 0; $i < sizeof($movie); $i++)
        <section class="movie">
          <div class="movie__info">
            <div class="movie__poster">
              <img class="movie__poster-image" alt="{{$movie[$i]->nameMovie}}" src="i/client/{{$imgMovie[$i]}}">
            </div>
            <div class="movie__description">
              <h2 class="movie__title">{{ $movie[$i]->nameMovie }}</h2>
              <p class="movie__synopsis">{{ $itemMovieDiscription[$i] }}</p>
              <p class="movie__data">
                <span class="movie__data-duration">{{ $movie[$i]->durationMovie }} минут</span>
                <span class="movie__data-origin">США</span>
              </p>
            </div>
          </div>

          @for ($j = 0; $j < sizeof($bdMovieId); $j++)
            @if($movie[$i]->id == $bdMovieId[$j])
              @php
                $movieList = App\Models\Movie::find($bdMovieId[$j]);
              @endphp
              @foreach ($movieList->halls->unique() as $movieItem)
                <div class="movie-seances__hall">
                  <h3 class="movie-seances__hall-title">{{ $movieItem->nameHall }}</h3>
                  <ul class="movie-seances__list">
                    @for ($k = 0; $k < sizeof($movieList->halls); $k++)
                      @if($movieList->halls[$k]->nameHall == $movieItem->nameHall)
                        {{-- <input type="hidden" name="country" value={{$movieList->halls[$k]->pivot->startTime}}> --}}
                        <li class="movie-seances__time-block"><button type='submit' class="movie-seances__time">{{$movieList->halls[$k]->pivot->startTime}}</button></li>
                        
                      @endif
                    @endfor
                  </ul>
                </div>
              @endforeach
            @endif
          @endfor
        </section>
      @endfor
    </form>
<!--     <section class="movie">
      <div class="movie__info">      
        <div class="movie__poster">
          <img class="movie__poster-image" alt="Альфа постер" src="i/client/poster2.jpg">
        </div>
        <div class="movie__description">        
          <h2 class="movie__title">Альфа</h2>
          <p class="movie__synopsis">20 тысяч лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу.</p>
          <p class="movie__data">
            <span class="movie__data-duration">96 минут</span>
            <span class="movie__data-origin">Франция</span>
          </p>
        </div>    
      </div>  
      <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">Зал 1</h3>
        <ul class="movie-seances__list">
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">10:20</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">14:10</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">18:40</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">22:00</a></li>
        </ul>
      </div>
      <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">Зал 2</h3>
        <ul class="movie-seances__list">
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">11:15</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">14:40</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">16:00</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">18:30</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">21:00</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">23:30</a></li>     
        </ul>
      </div>      
    </section>   
    
    <section class="movie">
      <div class="movie__info">      
        <div class="movie__poster">
          <img class="movie__poster-image" alt="Хищник постер" src="i/client/poster2.jpg">
        </div>
        <div class="movie__description">        
          <h2 class="movie__title">Хищник</h2>
          <p class="movie__synopsis">Самые опасные хищники Вселенной, прибыв из глубин космоса, высаживаются на улицах маленького городка, чтобы начать свою кровавую охоту. Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее.</p>
          <p class="movie__data">
            <span class="movie__data-duration">101 минута</span>
            <span class="movie__data-origin">Канада, США</span>
          </p>
        </div>    
      </div>  
      <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">Зал 1</h3>
        <ul class="movie-seances__list">
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">09:00</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">10:10</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">12:55</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">14:15</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">14:50</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">16:30</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">18:00</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">18:50</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">19:50</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">20:55</a></li>
          <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">22:00</a></li>
        </ul>
      </div>     
    </section>  -->    
  </main>
  <script src="js/indexClient.js"></script>
</body>
</html>