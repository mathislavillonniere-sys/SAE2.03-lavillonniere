let templateFile = await fetch("./component/iteration3/MovieDetail/template.html");
let template = await templateFile.text();

let MovieDetail = {};

MovieDetail.format = function (film) {
  let html = template;
  html = html.replaceAll("{{name}}", film.name);
  html = html.replace("{{image}}", "../server/images/" + film.image);
  html = html.replace("{{description}}", film.description);
  html = html.replace("{{director}}", film.director);
  html = html.replace("{{year}}", film.year);
  html = html.replace("{{length}}", film.length);
  html = html.replace("{{min_age}}", film.min_age);
  html = html.replace("{{trailer}}", film.trailer);
  return html;
};

export { MovieDetail };