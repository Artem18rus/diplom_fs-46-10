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
  
  <main>
    <section class="ticket">
      
      <header class="tichet__check">
        <h2 class="ticket__check-title">Электронный билет</h2>
      </header>

      <div class="ticket__info-wrapper">
        <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{$moviePick}}</span></p>
        <p class="ticket__info">Места: <span class="ticket__details ticket__chairs">{{$stringResultSelectedChair}}</span></p>
        <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{strstr($hallPick, " ")}}</span></p>
        <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{$startTimePick}}</span></p>

        @php
        $numberHallPick = strstr($hallPick, " ");
        $data = ["Фильм: {$moviePick}", "Места: {$stringResultSelectedChair}", "Зал:{$numberHallPick}", "Начало сеанса: {$startTimePick}"];
        $stringData = implode("; ", $data);
        @endphp

        <p style="text-align: center;"><img>{!! QrCode::encoding('UTF-8')->size(150)->margin(2)->color(2, 125, 250)->generate($stringData); !!}</p>
        <p class="ticket__hint">Покажите QR-код нашему контроллеру для подтверждения бронирования.</p>
        <p class="ticket__hint">Приятного просмотра!</p>
      </div>
    </section>
  </main>
  
</body>
</html>