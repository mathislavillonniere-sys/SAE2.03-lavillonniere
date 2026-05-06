let templateFile = await fetch("./component/Landing/template.html");
let template = await templateFile.text();

let Landing = {};

Landing.format = function () {
  return template;
};

export { Landing };
