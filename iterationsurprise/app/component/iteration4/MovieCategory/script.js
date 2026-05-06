let templateFile = await fetch("./component/iteration4/MovieCategory/template.html");
let template = await templateFile.text();

import { Movie } from "../../iteration1/Movie/script.js";

let MovieCategory = {};

MovieCategory.format = function(categoryName, films) {
    let html = template;
    html = html.replace("{{categoryName}}", categoryName);
    html = html.replace("{{movies}}", Movie.format(films));
    return html;
};

export { MovieCategory };

