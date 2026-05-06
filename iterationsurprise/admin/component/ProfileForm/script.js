let templateFile = await fetch("./component/ProfileForm/template.html");
let template = await templateFile.text();

let ProfileForm = {};

ProfileForm.format = function (handler, profiles) {
  let html = template;
  html = html.replace("{{handler}}", handler);

  let optionsHtml = "";
  if (profiles) {
    for (let p of profiles) {
      optionsHtml += `<option value="${p.id}">${p.name}</option>`;
    }
  }
  html = html.replace("{{profiles}}", optionsHtml);
  return html;
};

export { ProfileForm };
