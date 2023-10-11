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
    popupCreate.style.display = 'none';
})

//обработка клика по крестику в попапе "Добавление зала":
let smallCrossCreate = document.querySelector('.small_cross_create');
smallCrossCreate.addEventListener('click', (e) => {
    popupCreate.style.display = 'none';
})

//обработка нажатия на иконку корзины:
let popapDelete = document.querySelectorAll('.popap_delete');
// console.log(popapDelete);
let deleteHallBtn = document.querySelectorAll('.delete_hall-btn');
deleteHallBtn.forEach((item, idx) => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('нет');
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


//обработка клика по "Добавить" попапа "Удаление зала":



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
                    el.classList.add('conf-step__chair_standart');
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
// let confStepButtonAccent = document.querySelectorAll('.conf-step__button-accent');
// console.log(confStepButtonAccent[2].parentElement.parentElement.parentElement);

сonfStepTitleConfHall = document.querySelectorAll('.conf-step__title');
сonfStepTitleConfHall.forEach((item) => {
    if(item.outerText === 'КОНФИГУРАЦИЯ ЗАЛОВ') {
        let confStepButtonAccent = item.parentElement.nextElementSibling.querySelector('.conf-step__button-accent');
        // console.log(e.target);
        confStepButtonAccent.addEventListener('click', (e) => {
            // e.preventDefault();
            let fieldInput = item.parentElement.parentElement.querySelectorAll('.conf-step__input');
            // console.log(e.target);
            //console.log(fieldInput[0].value);
            
            const user = "Tom"; 
            const xhr = new XMLHttpRequest();
// POST-запрос к ресурсу /user
            xhr.open("post", "/admin/edit");
// обработчик получения ответа сервера
            // xhr.onload = () => {
            //     if (xhr.status == 200) { 
            //         console.log(xhr.responseText);
            //     } else {
            //         console.log("Server response: ", xhr.statusText);
            //     }
            // };
            xhr.send(user);
            location.href='/admin/edit';
        })
    }

})