let templateFile = await fetch(
  "./component/iteration3/MovieDetail/template.html",
);
let template = await templateFile.text();

let MovieDetail = {};

MovieDetail.format = function (film, isFav) {
  let html = template;

  html = html.replaceAll("{{id}}", film.id);
  html = html.replaceAll("{{name}}", film.name);
  html = html.replace("{{image}}", "../../server/images/" + film.image);
  html = html.replace("{{description}}", film.description);
  html = html.replace("{{director}}", film.director);
  html = html.replace("{{year}}", film.year);
  html = html.replace("{{length}}", film.length);
  html = html.replace("{{min_age}}", film.min_age);
  html = html.replace("{{trailer}}", film.trailer);

  // Boutons Favoris stylisés (btn-add et btn-remove doivent être dans ton CSS global)
  if (isFav == 1) {
    html = html.replace(
      "{{favoris}}",
      `<button class="btn-remove" onclick="C.handlerDeleteFavoris(${film.id})">Retirer</button>`,
    );
  } else {
    html = html.replace(
      "{{favoris}}",
      `<button class="btn-add" onclick="C.handlerAddFavoris(${film.id})">Ajouter aux favoris</button>`,
    );
  }

  return html;
};

export { MovieDetail };
