<!DOCTYPE html>
<html lang="ru">
@if(DB::table('status_pages_clients')->pluck('status')[0] == 'open')
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
      <a class="page-nav__day page-nav__day_today {{ Request::routeIs('client-pn.index') ? 'page-nav__day_chosen' : '' }}" href="{{route('client-pn.index')}}">
        <span class="page-nav__day-week">Пн</span><span class="page-nav__day-number">31</span>
      </a>
      <a class="page-nav__day {{ Request::routeIs('client-vt.index') ? 'page-nav__day_chosen' : '' }}" href="{{route('client-vt.index')}}">
        <span class="page-nav__day-week">Вт</span><span class="page-nav__day-number">1</span>
      </a>
      <a class="page-nav__day {{ Request::routeIs('client-sr.index') ? 'page-nav__day_chosen' : '' }}" href="{{route('client-sr.index')}}">
        <span class="page-nav__day-week">Ср</span><span class="page-nav__day-number">2</span>
      </a>
      <a class="page-nav__day {{ Request::routeIs('client-ct.index') ? 'page-nav__day_chosen' : '' }}" href="{{route('client-ct.index')}}">
        <span class="page-nav__day-week">Чт</span><span class="page-nav__day-number">3</span>
      </a>
      <a class="page-nav__day {{ Request::routeIs('client-pt.index') ? 'page-nav__day_chosen' : '' }}" href="{{route('client-pt.index')}}">
        <span class="page-nav__day-week">Пт</span><span class="page-nav__day-number">4</span>
      </a>
      <a class="page-nav__day page-nav__day_weekend {{ Request::routeIs('client-sb.index') ? 'page-nav__day_chosen' : '' }}" href="{{route('client-sb.index')}}">
        <span class="page-nav__day-week">Сб</span><span class="page-nav__day-number">5</span>
      </a>
      <a class="page-nav__day page-nav__day_next" href="#">
      </a>
    </nav>

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
                  <span class="movie__data-origin">{{$country[$i]}}</span>
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
                          <li class="movie-seances__time-block"><button style="border: none; cursor: pointer;" type='submit' class="movie-seances__time">{{$movieList->halls[$k]->pivot->startTime}}</button></li>                        
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
    </main>
    <script src="js/indexClient.js"></script>

  </body>
  @else
    <button onclick="location.href='/login'" style="cursor: pointer; padding: 10px; font-size: 16px">Войти в админпанель</button>
    <div style="display: flex; align-items: center; justify-content: center;"><img src="i/client/page-close.jpg" width=60% alt="technical-works"></div>
  @endif
</html>