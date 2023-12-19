// обработка клика на время
let schedule = document.querySelector('.schedule');
//console.log(schedule);

let movie = document.querySelectorAll('.movie');
// console.log(movie);


movie.forEach((item) => {
  
  item.addEventListener('click', (e) => {
    // e.preventDefault();
    let arrPick = [];
    let startTime = e.target.textContent;
    // console.log(startTime);

    let hall = e.target.closest('.movie-seances__hall').querySelector('h3').textContent;
    // console.log(hall);

    let movie = e.target.closest('.movie').querySelector('h2').textContent;
    //console.log(movie);

    let obj = { 
      movie: `${movie}`,
      hall: `${hall}`,
      startTime: `${startTime}`,
    }
    //console.log(obj);
    arrPick.push(obj);

    let input = document.createElement('input');
    input.setAttribute("type", "hidden");
    input.setAttribute("name", 'dataMovie');
    input.setAttribute("value", JSON.stringify(arrPick));
    item.appendChild(input);
  })
})


// let pageNavDay = document.querySelectorAll('.page-nav__day');
// console.log(pageNavDay);

// pageNavDay.forEach((item) => {
//   item.addEventListener('click', function(e) {
//     e.preventDefault();
//     navDay = document.querySelectorAll('.page-nav__day');
//     navDay.forEach((i) => {
//       i.classList.remove('page-nav__day_chosen');
//     })
//     item.classList.add('page-nav__day_chosen');
//   })
// })

// window.onload = function() { 
//   var all_links = document.getElementById("nav").getElementsByTagName("a"),
//       i=0, len=all_links.length,
//       full_path = location.href.split('#')[0]; //Ignore hashes?

//   // Loop through each link.
//   for(; i<len; i++) {
//       if(all_links[i].href.split("#")[0] == full_path) {
//           all_links[i].className += " page-nav__day_chosen";
//       }
//   }
// }