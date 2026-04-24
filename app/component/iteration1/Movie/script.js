let templateFile = await fetch("./component/iteration1/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (films) {

  if (films.length === 0) {
    return "<p>Aucun film disponible pour le moment.</p>";
  }

  let html = "";
  for (let film of films) {
    let carte = template;
    carte = carte.replace("{{id}}", film.id);
    carte = carte.replace("{{name}}", film.name);
    carte = carte.replace("{{image}}", "https://mmi.unilim.fr/~lavillonniere7/SAE2.03-lavillonniere/server/images/" + film.image);
    html += carte;
  }
  return html;
};

export { Movie };