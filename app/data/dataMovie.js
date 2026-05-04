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
DataMovie.addFavoris = async function (id_profile, id_movie) {
  let fd = new FormData();
  fd.append("id_profile", id_profile);
  fd.append("id_movie", id_movie);
  let answer = await fetch(HOST_URL + "server/script.php?todo=addFavoris", {
    method: "POST",
    body: fd,
  });
  return await answer.json();
};

DataMovie.getFavoris = async function (id_profile) {
  let answer = await fetch(
    HOST_URL + "server/script.php?todo=getFavoris&id_profile=" + id_profile,
  );
  return await answer.json();
};

DataMovie.isFavoris = async function (id_profile, id_movie) {
  let answer = await fetch(
    HOST_URL +
      "server/script.php?todo=isFavoris&id_profile=" +
      id_profile +
      "&id_movie=" +
      id_movie,
  );
  return await answer.json();
};

DataMovie.deleteFavoris = async function (id_profile, id_movie) {
  let fd = new FormData();
  fd.append("id_profile", id_profile);
  fd.append("id_movie", id_movie);
  let answer = await fetch(HOST_URL + "server/script.php?todo=deleteFavoris", {
    method: "POST",
    body: fd,
  });
  return await answer.json();
};
export { DataMovie };
