<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="CSS/admin/normalize.css">
  <link rel="stylesheet" href="CSS/admin/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <div class="greeting-logout">
      <div class="greeting-text" href="#">
          Привет, {{ Auth::user()->name }}!
      </div>
      <div class="dropdown-menu dropdown-menu-end">
          <a class="logout-text" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Выйти') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
      </div>
  </div>

  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
  </header>
  
  <main class="conf-steps">
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Управление залами</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Доступные залы:</p>
        <ul class="conf-step__list">
          @foreach ($hall as $item)
              <li>{{$item->nameHall}}
                  <button type="button" class="conf-step__button conf-step__button-trash delete_hall-btn"></button>
                  <div class="popup popap_delete">
                    <div class="popup__container">
                      <div class="popup__content">
                        <div class="popup__header">
                          <h2 class="popup__title">
                            Удаление зала
                            <a class="popup__dismiss small_cross_delete" href="#"><img src="i/admin/close.png" alt="Закрыть"></a>
                          </h2>
                        </div>
                        <div class="popup__wrapper">
                          
                          <form action="{{ route('admin-countHall.delete', $item->id) }}" method="POST" accept-charset="utf-8">
                            @csrf
                            @method('delete')
                            <p class="conf-step__paragraph">Вы действительно хотите удалить <span>{{$item->nameHall}}</span>?</p>
                            <!-- В span будет подставляться название зала -->
                            <div class="conf-step__buttons text-center">
                              <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
                              <button class="conf-step__button conf-step__button-regular close-delete_hall-btn">Отменить</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </li>
          @endforeach
        </ul>
        <button class="conf-step__button conf-step__button-accent create-hall-btn">Создать зал</button>
      </div>

      <div class="popup popap_create">
        <div class="popup__container">
          <div class="popup__content">
              <div class="popup__header">
              <h2 class="popup__title">
                  Добавление зала
                  <a class="popup__dismiss small_cross_create cross_create_hall" href="#"><img src="i/admin/close.png" alt="Закрыть"></a>
              </h2>
      
              </div>
              <div class="popup__wrapper">
                <form action="admin/countHallStore" method="post" accept-charset="utf-8">
                  @csrf
                    <label class="conf-step__label conf-step__label-fullsize" for="name">
                    Название зала
                    <input class="conf-step__input" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="name" required>
                    </label>
                    <div class="conf-step__buttons text-center">
                    <input type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent">
                    <button class="conf-step__button conf-step__button-regular close-create_hall-btn">Отменить</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация залов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
          @foreach ($hall as $item)
              <li><input type="radio" class="conf-step__radio" name="chairs-hall" value={{$item->nameHall}}><span class="conf-step__selector">{{$item->nameHall}}</span></li>
          @endforeach
        </ul>
        
        <form class='halls-config' action="admin/schemeHallStore" method="post" accept-charset="utf-8">
        @csrf
          <ul class="list-box-hidden">
            @foreach ($hall as $item)
              <li class="item-box-hidden">
                <div class="conf-box-hidden">
                  <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
                  <div class="conf-step__legend">
                    <label class="conf-step__label">Рядов, шт<input type="number" class="conf-step__input" placeholder="10" name="{{ $item->id }} r"></label>
                    <span class="multiplier">x</span>
                    <label class="conf-step__label">Мест, шт<input type="number" class="conf-step__input" placeholder="8" name="{{ $item->id }} c"></label>
                  </div>
                  <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
                  <div class="conf-step__legend">
                    <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
                    <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
                    <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
                    <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
                  </div> 
                </div>
                <div class="conf-step__hall">
                  <div class="conf-step__hall-wrapper"></div>
                </div>
              </li>
            @endforeach
          </ul>
          <fieldset class="conf-step__buttons text-center">
            <button class="conf-step__button conf-step__button-regular">Отмена</button>
            <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
          </fieldset>
        </form>
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация цен</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
          @foreach ($hall as $item)
            <li><input type="radio" class="conf-step__radio" name="prices-hall" value={{$item->nameHall}}><span class="conf-step__selector">{{$item->nameHall}}</span></li>
          @endforeach
        </ul>
          

        <form class='halls-price' action="admin/priceStore" method="post" accept-charset="utf-8">
          @csrf
          <ul class="list-box-hidden-price">
            @foreach ($hall as $item)
              <li class="item-box-hidden-price">
                <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
                <div class="conf-step__legend">
                  <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" name="{{ $item->nameHall }}:standart-price"></label>
                    за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
                </div>
                <div class="conf-step__legend">
                  <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" value="350" name="{{ $item->nameHall }}:vip-price"></label>
                    за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
                </div>
              </li>
            @endforeach
          </ul>

        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>
      </form>


      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Сетка сеансов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">
          <button class="conf-step__button conf-step__button-accent create-film-btn">Добавить фильм</button>
        </p>
        <div class="conf-step__movies">
          @foreach ($movie as $key=>$item)
            @php
              $pickImage = substr(DB::table('movies')->where('nameMovie', $item->nameMovie)->value('image'), 6);
            @endphp
            <div class="conf-step__movie class-movie" style="cursor: default;">
              <form id="delete-movie">
                  <img class="conf-step__movie-poster" alt={{$item->nameMovie}} src="{{url("/storage/$pickImage")}}">
                  <h3 class="conf-step__movie-title">{{$item->nameMovie}}</h3>
                  <p class="conf-step__movie-duration">{{$item->durationMovie}} минут(ы)</p>
                  <input id="input-delete-movie" type="hidden" name="id" value={{$item->id}}>
                  <button type="submit" class="cross-delete_movie">✖</button>
              </form>
            </div>
          @endforeach
        </div>

        <div class="popup active">
          <div class="popup__container">
            <div class="popup__content">
              <div class="popup__header">
                <h2 class="popup__title">
                  Добавление фильма
                  <a class="popup__dismiss cross_create_movie" href="#"><img src="i/admin/close.png" alt="Закрыть"></a>
                </h2>
        
              </div>
              <div class="popup__wrapper">
                <form id="form-add-movie" action="admin/movieStore" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  @csrf
                  <label class="conf-step__label conf-step__label-fullsize" for="name">
                    Название фильма
                    <input class="conf-step__input add-movie_input" type="text" placeholder="Например, &laquo;Гражданин Кейн&raquo;" name="name" id="name-movie" required>
                  </label>
                  <label class="conf-step__label conf-step__label-fullsize" for="duration">
                    Продолжительность фильма в мин (от 30 до 180)
                    <input class="conf-step__input add-duration_input" type="text" placeholder="Например, &laquo;130&raquo;" name="duration" id="duration-movie" required>
                  </label>
                  <label class="conf-step__label conf-step__label-fullsize" for="duration">
                    Постер
                    <input class="conf-step__input add-duration_input" type="file" placeholder="Выбери картинку" name="image" id="image" required>Тип файла: jpeg,png,jpg,gif,svg.(картинки 'poster' находятся в public\i\client)
                  </label>
                  <div class="conf-step__buttons text-center">
                    <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent add-movie_btn">
                    <button class="conf-step__button conf-step__button-regular close-create_film-btn">Отменить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <p class="conf-step__paragraph">
          <button class="conf-step__button conf-step__button-accent create-seances-btn">Добавить сеанс</button>
        </p>
        <div class="conf-step__seances">

          @php
            $bdSeancesHallId = DB::table('seances')->pluck('hall_id')->all();
            $countsSeancesHallId = array_count_values($bdSeancesHallId);
            $valuesCountsSeancesHallId = array_values($countsSeancesHallId);
            $bdMoviesId = DB::table('movies')->pluck('id')->all();
            $bdMoviesMovieId = DB::table('seances')->pluck('movie_id')->all();
            $bdSeancesId = DB::table('seances')->pluck('id')->all();
            $colorBackground = ['#caff85', '#85ff89', '#85ffd3', '#85e2ff', '#8599ff', '#ba85ff', '#ff85fb', '#ff85b1', '#ffa285', '#b2d6ae', '#ada1e2', '#a29015', '#746cd0', '#b28a8a', '#b4e0fe'];
          @endphp

          @foreach ($countsSeancesHallId as $val => $count)
            <div class="conf-step__seances-hall">
              <h3 class="conf-step__seances-title">{{ DB::table('halls')->where('id', $val)->value('nameHall') }}</h3>
              <div class="conf-step__seances-timeline">
                @for ($i = 0; $i < sizeof($bdSeancesId); $i++)
                  @if ($val == $bdSeancesHallId[$i])
                    @php
                      $incomingTime = DB::table('seances')->where('id', $bdSeancesId[$i])->value('startTime');
                      $time = explode(':', $incomingTime);
                      $countMinutes = $time[0]*60 + ($time[1]);
                      $percentageMinutes = $countMinutes * 100 / 1440;
                      $resultPx = 720 * $percentageMinutes / 100;

                      $incomingDurationFilm = DB::table('movies')->where('id', DB::table('seances')->where('id', $bdSeancesId[$i])->value('movie_id'))->value('durationMovie');
                      $percentageDurationFilm = $incomingDurationFilm * 100 / 180;
                      $count = 720 / 8;
                      $resultPxMovie = $count * $percentageDurationFilm / 100;
                    @endphp
                    <div class="conf-step__seances-movie" style="width: {{$resultPxMovie}}px; background-color: {{$colorBackground[$i]}}; left: {{$resultPx}}px;">
                      <p class="conf-step__seances-movie-title">{{DB::table('movies')->where('id', DB::table('seances')->where('id', $bdSeancesId[$i])->value('movie_id'))->value('nameMovie')}}</p>
                      <p class="conf-step__seances-movie-start">{{DB::table('seances')->where('id', $bdSeancesId[$i])->value('startTime')}}</p>
                    </div>
                  @endif
                @endfor
              </div>
            </div>
          @endforeach
        </div>

        <div class="popup popup-seances">
          <div class="popup__container">
            <div class="popup__content">
              <div class="popup__header">
                <h2 class="popup__title">
                  Добавление сеанса
                  <a class="popup__dismiss cross_create_seances" href="#"><img src="i/admin/close.png" alt="Закрыть"></a>
                </h2>
        
              </div>
              <div class="popup__wrapper">
                <form id="add_seance">
                  @csrf
                  <label class="conf-step__label conf-step__label-fullsize" for="hall">
                    Название зала
                    <select class="conf-step__input selected_name_hall" name="hall_id" id="hall-tag-id" required>
                      @foreach ($hall as $item)
                        <option value={{ $item->id }}>{{$item->nameHall}}</option>
                      @endforeach
                    </select>
                  </label>
                    <label class="conf-step__label conf-step__label-fullsize ind helper-class" for="name">
                      Время начала
                      <input class="conf-step__input selected_start_time" type="time" value="00:00" name="start_time" id="time-tag-id" required>
                    </label>
                    <label class="conf-step__label conf-step__label-fullsize" for="movie">
                      Название фильма
                      <select class="conf-step__input selected_name_movie" name="movie_id" id="movie-tag-id" required>
                        @foreach ($movie as $item)
                          <option value={{ $item->id }}>{{$item->nameMovie}}</option>
                        @endforeach
                      </select>
                    </label>

                    <img class="add_cross" src="i/admin/cross-sign.png" alt="Добавить" onclick="event.preventDefault();
                    let ind = document.querySelectorAll('.ind').length;
                    document.querySelector('.add_cross').insertAdjacentHTML('beforebegin', `
                      <label class='conf-step__label conf-step__label-fullsize ind helper-class' for='name'>
                        Время начала
                        <input class='conf-step__input selected_start_time' type='time' value='00:00' name='start_time-${ind}' id='time-tag-id' required>
                      </label>
          
                      <label class='conf-step__label conf-step__label-fullsize' for='movie'>
                        Название фильма
                        <select class='conf-step__input selected_name_movie' name='movie_id-${ind}' id='movie-tag-id' required>
                          @foreach ($movie as $item)
                            <option value={{ $item->id }}>{{ $item->nameMovie }}</option>
                          @endforeach
                        </select>
                      </label>
                    `)">

                  <div class="conf-step__buttons text-center">
                    <input type="submit" value="Добавить" class="conf-step__button conf-step__button-accent">
                    <button class="conf-step__button conf-step__button-regular close-create_seances-btn">Отменить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
          <button id="delete-all_seance" class="conf-step__button conf-step__button-regular">Удалить все сеансы</button>
      </div>
    </section>

    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Открыть продажи</h2>
      </header>

      @php
        if (DB::table('status_pages_clients')->pluck('status')[0] == 'open') {
          $textBtn = 'Приостановить продажу билетов';
        }  else {
          $textBtn = 'Открыть продажу билетов';
        }
      @endphp

      <form id="status-page">
        <input id="id-status-page" type="hidden" name="name" value={{DB::table('status_pages_clients')->pluck('status')[0]}}>
        <div class="conf-step__wrapper text-center">
          <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
          <button type="submit" class="conf-step__button conf-step__button-accent open-ticket-sales">{{$textBtn}}</button>
        </div>
      </form>
    </section>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="js/accordeon.js"></script>
  <script src="js/indexAdmin.js"></script>


  <script>
    // $('#form-add-movie').ready('submit', function(event){
    //   event.preventDefault();
    //   let name = $('#name-movie').val();
    //   let duration = $('#duration-movie').val();
    //   let img = $('#image')[0].files;
    //   // var fd = new FormData();
    //   // fd.append('file',files[0]);
    //   // fd.append('_token',CSRF_TOKEN);
    //   // $('#responseMsg').hide();

    //   $.ajax({
    //     url: "/admin/movieStore",
    //     type:"POST",
    //     enctype: "multipart/form-data",
    //     data:{
    //       "_token": "{{ csrf_token() }}",
    //       name:name,
    //       duration:duration,
    //       img:img,
    //     },
    //     contentType: false,
    //     processData: false,
    //     dataType: 'json',
    //     success:function(response){
    //       location.reload();
    //       console.log(response);
    //     },
    //   });
    // })

    $('#add_seance').on('submit', function(event){
      event.preventDefault();      
      let hallTagIdItem = $('#hall-tag-id').val();
      let hallTagId = [];
      let timeTag = [];
      let timeTagList = document.querySelectorAll('#time-tag-id');
      $.each(timeTagList, function(i, v) {
        timeTag.push(v.value);
        hallTagId.push(hallTagIdItem);
      })

      let movieTagId = [];
      let movieTagList = document.querySelectorAll('#movie-tag-id');
      $.each(movieTagList, function(i, v) {
        movieTagId.push(v.value);
      })
      
      $.ajax({
        url: "/admin/add_seance",
        type:"POST",
        data:{
          "_token": "{{ csrf_token() }}",
          hallTagId: hallTagId,
          timeTag: timeTag,
          movieTagId: movieTagId,
        },
        success:function(response){
          location.reload();
        },
      });
    })

    $("#delete-all_seance").click(function() {
          $.ajax({
              url: "{{route('admin-deleteAllSeance.delete')}}",
              method: 'DELETE',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function (response) {
                console.log(response);
                location.reload();
              },
              error: function(event) {
                console.log(event); 
              }
          });
      });

      $("#status-page").submit(function() {
        event.preventDefault();
        let idStatusPage = document.getElementById('id-status-page');
          $.ajax({
            url: "/status",
            type:"POST",
            data:{
              "_token": "{{ csrf_token() }}",
              status:idStatusPage.getAttribute('value'),
            },
            success:function(response){
              let openTicketSales = document.querySelector('.open-ticket-sales');
              if(response == 'open') {
                idStatusPage.setAttribute('value', 'open');
                openTicketSales.textContent = 'Приостановить продажу билетов';
                
              } else {
                idStatusPage.setAttribute('value', 'close');
                openTicketSales.textContent = 'Открыть продажу билетов';
              }
              console.log(idStatusPage.getAttribute('value'));
            },
          });
      });

      let deleteMovieList = document.querySelectorAll('#delete-movie');
      $.each(deleteMovieList, function() {
        $(this).on('submit', function(event){
          event.preventDefault();
          let inputDeleteMovie = $('#input-delete-movie').val();
          let target = $(event.target);
          $.ajax({
            url: "/admin/delete-movie",
            type:"POST",
            data:{
              "_token": "{{ csrf_token() }}",
              "idMovie":target.children()[3].getAttribute('value'),
            },
            success:function(response){
              // console.log(response);
              location.reload();
            },
          });
        })
      })
  </script>
</body>
</html>