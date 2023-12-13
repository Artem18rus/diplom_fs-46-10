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

