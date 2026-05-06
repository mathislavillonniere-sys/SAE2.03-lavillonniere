let templateFile = await fetch("./component/NavBar/template.html");
let navbarTemplate = await templateFile.text();

let NavBar = {};

NavBar.format = function (categories) {
  let html = navbarTemplate;
  let allTiles = "";

  let tileTemplate = `
    <div class="navbar__category-tile" onclick="C.handlerCategory('{{categoryName}}');">
      {{categoryName}}
    </div>`;

  if (categories) {
    for (let cat of categories) {
      let tile = tileTemplate.replace(/{{categoryName}}/g, cat.name);
      allTiles += tile;
    }
  }

  html = html.replace("{{categories_tiles}}", allTiles);

  if (window.activeProfile == null) {
    html = html.replace("{{profileName}}", "CHOISIR UN PROFIL");
  } else {
    let nom = window.activeProfile.name.toUpperCase();
    html = html.replace("{{profileName}}", `${nom} - CHANGER DE PROFIL`);
  }

  return html;
};

export { NavBar };
