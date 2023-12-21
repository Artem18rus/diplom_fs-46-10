// обработка клика на время:
//let schedule = document.querySelector('.schedule');
let movie = document.querySelectorAll('.movie');

movie.forEach((item) => {
  item.addEventListener('click', (e) => {
    // e.preventDefault();
    let arrPick = [];
    let startTime = e.target.textContent;

    let hall = e.target.closest('.movie-seances__hall').querySelector('h3').textContent;

    let movie = e.target.closest('.movie').querySelector('h2').textContent;
    let obj = { 
      movie: `${movie}`,
      hall: `${hall}`,
      startTime: `${startTime}`,
    }
    arrPick.push(obj);

    let input = document.createElement('input');
    input.setAttribute("type", "hidden");
    input.setAttribute("name", 'dataMovie');
    input.setAttribute("value", JSON.stringify(arrPick));
    item.appendChild(input);
  })
})

//обработка выбора мест в зале:
let buyingSchemeWrapper = document.querySelector('.buying-scheme__wrapper');
// console.log(buyingSchemeWrapper);
let buyingSchemeRow = buyingSchemeWrapper.querySelectorAll('.buying-scheme__row');
// console.log(buyingSchemeRow);
buyingSchemeRow.forEach((i) => {
  let buyingSchemeChairItem = i.querySelectorAll('.buying-scheme__chair');
  buyingSchemeChairItem.forEach((item) => {
    item.addEventListener('click', (e) => {
      if(item.classList.contains('buying-scheme__chair_standart') || item.classList.contains('buying-scheme__chair_vip')) {
        item.classList.toggle('buying-scheme__chair_selected');
      }
    })
  })
})

//доп. обработка кнопки Забронировать:
let toBook = document.querySelector('.to-book');
let buying = document.querySelector('.buying');

toBook.addEventListener('click', (e) => {
  // e.preventDefault();
  let buyingSchemeWrapperItem = document.querySelector('.buying-scheme__wrapper');
  let priceStandart = document.querySelector('.price-standart');
  let priceVip = document.querySelector('.price-vip');

  let buyingSchemeRow = buyingSchemeWrapperItem.querySelectorAll('.buying-scheme__row');
  let arrSelectedChair = [];
    buyingSchemeRow.forEach((el, i) => {
      let buyingSchemeChair = el.querySelectorAll('.buying-scheme__chair');
        buyingSchemeChair.forEach((item, idx) => {
          if(item.classList.contains('buying-scheme__chair_selected') && item.classList.contains('buying-scheme__chair_standart')) {
            let obj = {
              row: `${i+1}`,
              chair: `${idx+1}`,
              price: `${priceStandart.textContent} рублей`
            }
            arrSelectedChair.push(obj);
          } else if(item.classList.contains('buying-scheme__chair_selected') && item.classList.contains('buying-scheme__chair_vip')) {
            let obj = {
              row: `${i+1}`,
              chair: `${idx+1}`,
              price: `${priceVip.textContent} рублей`
            }
            arrSelectedChair.push(obj);
          }
        })
    })
  let input = document.createElement('input');
  input.setAttribute("type", "hidden");
  input.setAttribute("name", 'selectedChair');
  input.setAttribute("value", JSON.stringify(arrSelectedChair));
  buying.insertBefore(input, toBook)
})