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
  @php
    $arrayHallScheme = json_decode($hallScheme, true);
    $tablePickChairs = DB::table('pick_chairs')->get();
  @endphp
  <main>

    <form action="/payment" method="post" accept-charset="utf-8">
    @csrf
      <section class="buying">
        <div class="buying__info">
          <div class="buying__info-description">
            <h2 class="buying__info-title">{{$moviePick}}</h2>
            <p class="buying__info-start">Начало сеанса: {{$startTimePick}}, {{$dayPick}}</p>
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
                  <span class="buying-scheme__chair"></span>
                @endfor
              </div>
            @endfor
          </div>
          <div class="buying-scheme__legend">
            <div class="col">
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value price-standart">{{$priceStandart}}</span>руб)</p>
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value price-vip">{{$priceVip}}</span>руб)</p>
            </div>
            <div class="col">
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>
            </div>
          </div>
        </div>
        <input type="hidden" name="moviePick" value="{{$moviePick}}">
        <input type="hidden" name="startTimePick" value="{{$startTimePick}}">
        <input type="hidden" name="dayPick" value="{{$dayPick}}">
        <input type="hidden" name="hallPick" value="{{$hallPick}}">
        <button type="submit" class="acceptin-button to-book">Забронировать</button>
      </section>
    </form>

  </main>
  <script type="text/javascript">
    let jsArrayHallScheme = <?php echo json_encode($arrayHallScheme); ?>;
    // console.log(jsArrayHallScheme);
    let buyingSchemRow = document.querySelectorAll('.buying-scheme__row');
    let buyingSchemeChair = document.querySelectorAll('.buying-scheme__chair');
    buyingSchemRow.forEach((el, idx) => {
      Array.from(el.children).forEach((item, i) => {
        jsArrayHallScheme.forEach((it, ind) => {
          if(idx+1 == Number(it.row) && i+1 == Number(it.chair)) {
            item.classList.add(`buying-scheme__chair_${it.type}`);
          }
        })
      })
    });

    let jsArrayPickChair = <?php echo json_encode($tablePickChairs); ?>; //все записи таблицы pick_chairs
    let jsMoviePick = <?php echo json_encode($moviePick); ?>; //отображаемое на этой странице movie;
    let jsStartTimePick = <?php echo json_encode($startTimePick); ?>; //отображаемое на этой странице startTimePick;
    let jsDayPick = <?php echo json_encode($dayPick); ?>; //отображаемое на этой странице day;
    let jsHallPick = <?php echo json_encode($hallPick); ?>; //отображаемое на этой странице hall;

    if(jsArrayPickChair.length > 0){
      jsArrayPickChair.forEach((item, ind) => {
        if(item.movie_pick == jsMoviePick && item.day_pick == jsDayPick && item.hall_pick == jsHallPick && item.startTime_pick == jsStartTimePick) {
          buyingSchemRow.forEach((el, idx) => {
            Array.from(el.children).forEach((element, index) => {
              JSON.parse(item.selected_chair).forEach((it, ind) => {
                if(it.row == idx+1 && it.chair == index+1) {
                  element.classList.add('buying-scheme__chair_disabled');
                }
              })
            })
          });
        }
      })
    }
  </script>
  <script src="js/indexClient.js"></script>
</body>
</html>