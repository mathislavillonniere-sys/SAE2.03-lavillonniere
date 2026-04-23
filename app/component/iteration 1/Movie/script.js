let templateFile = await fetch("./component/iteration1/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (hAbout, hHome) {
  let html = template;
  html = html.replace("{{title}}", hAbout);
  html = html.replace("{{image}}", hAbout);

  return html;
};

export { Movie };