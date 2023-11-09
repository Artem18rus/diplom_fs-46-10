//появление попапа "Создать зал" / "Добавить зал"
let createHallBtn = document.querySelector('.create-hall-btn');
let popupCreate = document.querySelector('.popap_create');
createHallBtn.addEventListener('click', (e) => {
    e.preventDefault();
    popupCreate.style.display = 'block';
});

//обработка клика по "Отменить" в попапе "Добавление зала"
let closeCreateHallBtn = document.querySelector('.close-create_hall-btn');
closeCreateHallBtn.addEventListener('click', (e) => {
    e.preventDefault();
    popupCreate.style.display = 'none';
})

//обработка клика по крестику в попапе "Добавление зала":
let crossCreateHall = document.querySelector('.cross_create_hall');
crossCreateHall.addEventListener('click', (e) => {
    e.preventDefault();
    popupCreate.style.display = 'none';
})

//обработка нажатия на иконку корзины:
let popapDelete = document.querySelectorAll('.popap_delete');
// console.log(popapDelete);
let deleteHallBtn = document.querySelectorAll('.delete_hall-btn');
deleteHallBtn.forEach((item, idx) => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        popapDelete.forEach((i) => {
            if(i.style.display == 'block') {
                i.style.display = 'none';
            }
            popapDelete[idx].style.display = 'block';
        })
    })
})

//обработка клика по "Отменить" в попапе "Удаление зала"
let closeDeleteHallBtn = document.querySelectorAll('.close-delete_hall-btn');
//console.log(closeDeleteHallBtn);
closeDeleteHallBtn.forEach((item, idx) => {
    item.addEventListener('click', (e) => {
    e.preventDefault();
    popapDelete[idx].style.display = 'none';
})
})


//обработка клика по крестику в попапе "Удаление зала":
let smallCrossDelete = document.querySelectorAll('.small_cross_delete');
smallCrossDelete.forEach((item, idx) => {
    item.addEventListener('click', (e) => {
    e.preventDefault();
    popapDelete[idx].style.display = 'none';
    })
})



//обработка появления, скрытия ЭКРАНА:
let chairsHall = document.getElementsByName('chairs-hall');
chairsHall.forEach((item, idx)=> {
    item.addEventListener('click', (e) => {
        let itemBoxHidden = document.querySelectorAll('.item-box-hidden');
        itemBoxHidden.forEach((el) => el.style.display = 'none');
        itemBoxHidden[idx].style.display = 'block';
    })
})

//обработка мест ЭКРАНА:
let itemBoxHidden = document.querySelectorAll('.item-box-hidden');
itemBoxHidden.forEach((elem) => {
    elem.querySelector('.conf-box-hidden').addEventListener('click', function(event) {
        let confStepHallWrapper = elem.querySelector('.conf-step__hall-wrapper');
        if(confStepHallWrapper.children.length > 0) {
            let confStepRow = elem.querySelectorAll(".conf-step__row");
            confStepRow.forEach((item) => item.remove());
        }
        let confStepLegend = elem.querySelector(".conf-step__legend");
        let confStepInput = confStepLegend.querySelectorAll('.conf-step__input');
        if(confStepInput[0].value.length !== 0 && confStepInput[1].value.length !== 0) {
            let rows = confStepInput[0].value;
            let cols = confStepInput[1].value;
            let confStepHallWrapper = elem.querySelector(".conf-step__hall-wrapper");
            for(let i = 0; i < rows; i++) {
                confStepHallWrapper.insertAdjacentHTML('beforeend', `
                <div class="conf-step__row"></div>`)
            }
            let confStepRow = elem.querySelectorAll(".conf-step__row");
            for(let j = 0; j < confStepRow.length; j++) {
                confStepRow[j].insertAdjacentHTML('beforeend', `
                    <span class="conf-step__chair"></span>
                `.repeat(cols))
            }
        }
        let confStepChair = confStepHallWrapper.querySelectorAll('.conf-step__chair');
        confStepChair.forEach((el) => {
            el.addEventListener('click', function(e) {
                if(el.classList.contains('conf-step__chair_standart')) {
                    el.classList.remove('conf-step__chair_standart');
                    el.classList.add('conf-step__chair_vip');
                } else if(el.classList.contains('conf-step__chair_vip')) {
                    el.classList.remove('conf-step__chair_vip');
                    el.classList.add('conf-step__chair_disabled');
                } else if (el.classList.contains('conf-step__chair_disabled')) {
                    el.classList.remove('conf-step__chair_disabled');
                } else {
                    el.classList.add('conf-step__chair_standart');
                }
            })
        })
    })
})

//обработка нажатия на кнопку "Отмена" ЭКРАНА:
let сonfStepTitleConfHall = document.querySelectorAll('.conf-step__title');
сonfStepTitleConfHall.forEach((item) => {
    if(item.outerText === 'КОНФИГУРАЦИЯ ЗАЛОВ') {
        let confStepWrapperConfHall = item.parentElement.nextElementSibling.querySelector('.conf-step__button');

        confStepWrapperConfHall.addEventListener('click', (e) => {
            let parentWrapper = confStepWrapperConfHall.closest('.conf-step__wrapper');
            let listBoxHidden = parentWrapper.querySelectorAll('.item-box-hidden');
            listBoxHidden.forEach((el, idx) => {
                el.style.display = 'none';
                let confStepInput = document.querySelectorAll('.conf-step__input');
                    confStepInput.forEach((i, idx) => {
                        confStepInput[idx].value = '';
                    })

                let confStepRow = document.querySelectorAll('.conf-step__row');
                confStepRow.forEach(element => {
                    element.remove();
                });
            })
            document.getElementsByName('chairs-hall').forEach(elem => {
                if(elem.checked) {
                    elem.checked = false;
                }
            });
            
        })

    };
});


//обработка нажатия на кнопку "Сохранить" ЭКРАНА:
let confStepButtonAccent = document.querySelectorAll('.conf-step__button-accent');

сonfStepTitleConfHall = document.querySelectorAll('.conf-step__title');
сonfStepTitleConfHall.forEach((item, idx) => {
    if(item.outerText === 'КОНФИГУРАЦИЯ ЗАЛОВ') {
        let confStepButtonAccent = item.parentElement.nextElementSibling.querySelector('.conf-step__button-accent');
        confStepButtonAccent.addEventListener('click', (e) => {
            // e.preventDefault();
            let hallsConfig = document.querySelector('.halls-config');
            let confStepHallWrapper = hallsConfig.querySelectorAll('.conf-step__hall-wrapper');
            // console.log(confStepHallWrapper);
            confStepHallWrapper.forEach((el, index) => {
                let arrPick = [];
                let numberHall;
                let chairsHallActiv = document.getElementsByName('chairs-hall');
                let confStepRow = el.querySelectorAll('.conf-step__row');
                confStepRow.forEach((element, ind) => {
                    // let arrRowStandart = [];
                    let confStepChair = element.querySelectorAll('.conf-step__chair');
                    confStepChair.forEach((elem, i) => {
                        let nameHall = chairsHallActiv[index].nextElementSibling.outerText;
                        numberHall = nameHall.slice(4, nameHall.length);
                        if(elem.classList.contains('conf-step__chair_standart')) {
                            // arrRowStandart.push(`type-standart, ${nameHall.slice(4, nameHall.length)}, ${ind+1}, ${i+1};`); //тип, зал, строка, место
                            let obj = { 
                              type: 'standart',
                              hall: `${numberHall}`,
                              row: `${ind+1}`,
                              chair: `${i+1}`,
                            }
                            arrPick.push(obj);
                        } else if(elem.classList.contains('conf-step__chair_vip')) {
                            let obj = { 
                              type: 'vip',
                              hall: `${numberHall}`,
                              row: `${ind+1}`,
                              chair: `${i+1}`,
                            }
                            arrPick.push(obj);
                        } else if(elem.classList.contains('conf-step__chair_disabled')) {
                            let obj = { 
                              type: 'disabled',
                              hall: `${numberHall}`,
                              row: `${ind+1}`,
                              chair: `${i+1}`,
                            }
                            arrPick.push(obj);
                        }
                    })
                })
                    let input = document.createElement('input');
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", `Зал ${numberHall}`);
                    input.setAttribute("value", JSON.stringify(arrPick));
                    el.appendChild(input);
            })
        })
    }
})


//обработка появления, скрытия УСТАНОВКИ ЦЕН:
let pricesHall = document.getElementsByName('prices-hall');
pricesHall.forEach((item, idx)=> {
    item.addEventListener('click', (e) => {
        let itemBoxHiddenPrice = document.querySelectorAll('.item-box-hidden-price');
        itemBoxHiddenPrice.forEach((el) => el.style.display = 'none');
        itemBoxHiddenPrice[idx].style.display = 'block';
    })
})



//появление попапа "Добавить фильм"
let createFilmBtn = document.querySelector('.create-film-btn');
let popupActive = document.querySelector('.active');
createFilmBtn.addEventListener('click', (e) => {
    e.preventDefault();
    popupActive.style.display = 'block';
});

//обработка клика по "Отменить" в попапе "Добавление фильма"
let closeCreateFilmBtn = document.querySelector('.close-create_film-btn');
closeCreateFilmBtn.addEventListener('click', (e) => {
    e.preventDefault();
    popupActive.style.display = 'none';
})


//обработка клика по крестику в попапе "Добавление фильма":
let crossCreateMovie = document.querySelector('.cross_create_movie');
crossCreateMovie.addEventListener('click', (e) => {
    e.preventDefault();
    popupActive.style.display = 'none';
})


// обработка нажатия на кнопку "Добавить фильм":
// let addMovieBtn = document.querySelector('.add-movie_btn');
// addMovieBtn.addEventListener('click', (e) => {
//     // e.preventDefault();
//     let addMovieInput = document.querySelector('.add-movie_input');
//     // console.log(addMovieInput.value);
//     let addDurationInput = document.querySelector('.add-duration_input');
//     let confStepMovies = document.querySelector('.conf-step__movies');
//     console.log(confStepMovies);
//     confStepMovies.insertAdjacentHTML('beforeend', `
//     <div class="conf-step__movie">
//         <img class="conf-step__movie-poster" alt="poster" src="i/poster.png">
//         <h3 class="conf-step__movie-title">${addMovieInput.value}</h3>
//         <p class="conf-step__movie-duration">${addDurationInput.value} минут</p>
//     </div>
//     `);
//     popupActive.style.display = 'none';
// })

// $('#form-add-movie').on('submit',function(event){
//     event.preventDefault();
//     let name = $('#name').val();
//     let duration = $('#duration').val();
   
//     $.ajax({
//       url: "/admin/movieStore",
//       type:"POST",
//       data:{
//         "_token": "{{ csrf_token() }}",
//         name:name,
//         duration:duration,
//       },
//       success:function(response){
//         console.log(response);
//       },
//     });
// let addMovieInput = document.querySelector('.add-movie_input');
// // console.log(addMovieInput.value);
// let addDurationInput = document.querySelector('.add-duration_input');
// let confStepMovies = document.querySelector('.conf-step__movies');
// console.log(confStepMovies);
// confStepMovies.insertAdjacentHTML('beforeend', `
// <div class="conf-step__movie">
//     <img class="conf-step__movie-poster" alt="poster" src="i/poster.png">
//     <h3 class="conf-step__movie-title">${addMovieInput.value}</h3>
//     <p class="conf-step__movie-duration">${addDurationInput.value} минут</p>
// </div>
// `);
// 
//     let popupActive = document.querySelector('.active');
//     popupActive.style.display = 'none';
//   })
