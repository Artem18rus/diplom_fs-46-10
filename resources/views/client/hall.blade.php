<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="css/client/normalize.css">
  <link rel="stylesheet" href="css/client/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  {{-- {{$hallPick}} --}}
{{--   @foreach ($data as $item)
  {{$item}};
@endforeach --}}
{{-- {{json_encode($hallScheme)}} --}}
  @php
    $arrayHallScheme = json_decode($hallScheme);
    print_r(count($arrayHallScheme));
  @endphp
  <main>
    <section class="buying">
      <div class="buying__info">
        <div class="buying__info-description">
          <h2 class="buying__info-title">{{$moviePick}}</h2>
          <p class="buying__info-start">Начало сеанса: {{$startTimePick}}</p>
          <p class="buying__info-hall">{{$hallPick}}</p>
        </div>
        <div class="buying__info-hint">
          <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
      </div>
      <div class="buying-scheme">
        <div class="buying-scheme__wrapper">

          @for ($i = 0; $i < $rowBd; $i++)
            <div class="buying-scheme__row">
              @for ($j = 0; $j < $chairBd; $j++)
                <span class="buying-scheme__chair buying-scheme__chair_standart"></span>
              @endfor
            </div>
          @endfor
            

          {{-- <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>   --}}

          {{--           <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
            <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
            <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_vip"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_vip"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_selected"></span>
            <span class="buying-scheme__chair buying-scheme__chair_selected"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            <span class="buying-scheme__chair buying-scheme__chair_disabled"></span><span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
          </div>  

          <div class="buying-scheme__row">
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_taken"></span><span class="buying-scheme__chair buying-scheme__chair_taken"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
            <span class="buying-scheme__chair buying-scheme__chair_standart"></span><span class="buying-scheme__chair buying-scheme__chair_standart"></span>
          </div> --}}
        </div>
        <div class="buying-scheme__legend">
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value">250</span>руб)</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value">350</span>руб)</p>            
          </div>
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>                    
          </div>
        </div>
      </div>
      <button class="acceptin-button" onclick="location.href='payment.html'" >Забронировать</button>
    </section>     
  </main>
  
</body>
</html>