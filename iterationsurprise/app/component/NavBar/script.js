let templateFile = await fetch("./component/NavBar/template.html");
let navbarTemplate = await templateFile.text();

let NavBar = {};

window.C = window.C || {};

window.C.toggleCategories = function () {
  const overlay = document.querySelector("#navbar__categories-overlay");
  if (overlay) {
    overlay.classList.toggle("navbar__categories-overlay--active");
  }
};

NavBar.format = function (categories) {
  let html = navbarTemplate;
  let allTiles = "";

  // Le modèle de la tuile est sécurisé ici !
  let tileTemplate = `
    <div class="navbar__category-tile" onclick="C.handlerCategory('{{categoryName}}'); C.toggleCategories();">
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
