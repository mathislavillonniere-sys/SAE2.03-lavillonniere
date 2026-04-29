// URL où se trouve le répertoire "server" sur mmi.unilim.fr

let HOST_URL = "../";
// let HOST_URL = "https://lavillonniere-sae203.mmi-limoges.fr/";

let DataMovie = {};

DataMovie.requestMovies = async function (age = 0) {
  let answer = await fetch(
    HOST_URL + "server/script.php?todo=readmovies&age=" + age,
  );
  let data = await answer.json();
  return data;
};

DataMovie.requestMovieDetails = async function (id) {
  let answer = await fetch(
    HOST_URL + "server/script.php?todo=readMovieDetail&id=" + id,
  );
  let data = await answer.json();
  return data;
};

DataMovie.requestCategories = async function () {
  let answer = await fetch(HOST_URL + "server/script.php?todo=readCategories");
  let data = await answer.json();
  return data;
};

export { DataMovie };
