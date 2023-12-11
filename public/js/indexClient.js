// // фильтрация отображенимя залов:
// let movie = document.querySelectorAll('.movie');
// // console.log(movie);
// // let movieSeancesHall = document.querySelectorAll('.movie-seances__hall');
// // console.log(movieSeancesHall);

// let arr1 = [];

// for(let i = 0; i < movie.length; i++) {
//   // let arr1 = [];
//   let movieSeancesHallTitle = movie[i].querySelectorAll('.movie-seances__hall-title');
//   let arr = [];

//   for(let j = 0; j < movieSeancesHallTitle.length; j++) {
//     let obj = movieSeancesHallTitle[j].outerText;
//     // let obj = {
//     //   hall: movieSeancesHallTitle[j].outerText,
//     // };
//     arr.push(obj);
//   }
//   arr1.push(arr);

  
// }
// // console.log(arr1);

// for(let k = 0; k < arr1.length; k++) {
//   //console.log(arr1[k]);
//   const filteredStrings = arr1[k].filter((item, index) => {
//     if(arr1[k].indexOf(item) !== index) {
//       // item.remove();
//       console.log(arr1[k]);
//     }
//   });
//   //console.log(filteredStrings);
// }





// фильтрация отображенимя залов:
// let movie = document.querySelectorAll('.movie');
// console.log(movie);
// let movieSeancesHall = document.querySelectorAll('.movie-seances__hall');
// console.log(movieSeancesHall);

// let arr1 = [];
// for(let i = 0; i < movie.length; i++) {
//   // let arr1 = [];
//   let movieSeancesHallTitle = movie[i].querySelectorAll('.movie-seances__hall-title');
//   let arr = [];

//   for(let j = 0; j < movieSeancesHallTitle.length; j++) {
//     let obj = movieSeancesHallTitle[j].outerText;
//     // let obj = {
//     //   hall: movieSeancesHallTitle[j].outerText,
//     // };
//     arr.push(obj);
//     // console.log(obj);
//   }
//   arr1.push(arr);
// }
// // console.log(arr1);

// for(let k = 0; k < arr1.length; k++) {
//   // console.log(arr1[k]);
//   const filteredStrings = arr1[k].filter((item, index) => {
//     if(arr1[k].indexOf(item) !== index) {
//       // item.remove();
//       console.log(item);
//     }
//   });
//   //console.log(filteredStrings);
// }

let movie = document.querySelectorAll('.movie');
for(let i = 0; i < movie.length; i++) {
  let movieSeancesHall = Array.from(movie[i].querySelectorAll('.movie-seances__hall'));
  // console.log(movieSeancesHall);
  // let arrPick = movieSeancesHall.map(item => item.querySelector('.movie-seances__hall-title').outerText);
  // console.log(arrPick);

  // for(let j = 0; j < movieSeancesHall.length; j++) {
  //   let movieSeancesHallTitle = movieSeancesHall[j].querySelectorAll('.movie-seances__hall-title');
  //   console.log(movieSeancesHallTitle[0].outerText);
  movieSeancesHall.filter((item, index) => {
    // let movieSeancesHallTitle = item.querySelectorAll('.movie-seances__hall-title');
    // console.log(movieSeancesHallTitle[0].outerText);
    let arrPick = item.querySelector('.movie-seances__hall-title').outerText;
    console.log(arrPick);
        // if(arrPick.indexOf(item) !== index) {
        //   //item.remove();
        //   //movieSeancesHall.remove();
        //   console.log(item.outerText);
        // }
      })
  // }

  // arrPick.filter((item, index) => {
  //       if(arrPick.indexOf(item) !== index) {
  //         //item.remove();
  //         //movieSeancesHall.remove();
  //         console.log(item);
  //       }
  //     })
    

  // for(let j = 0; j < movieSeancesHall.length; j++) {
  //   // if() {

  //   // }
  //   console.log(movieSeancesHall[j].querySelector('.movie-seances__hall-title'));
  // }
}



