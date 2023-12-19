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