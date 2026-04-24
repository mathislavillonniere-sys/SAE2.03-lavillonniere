let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function(hAbout, hHome, categories) {
    let html = template;
    html = html.replace("{{hAbout}}", hAbout);
    html = html.replace("{{hHome}}", hHome);
    
    let categoriesHtml = "";
    if (categories) {
        for (let cat of categories) {
            categoriesHtml += `<li class="navbar__dropdown__item" onclick="C.handlerCategory('${cat.name}')">${cat.name}</li>`;
        }
    }
    html = html.replace("{{categories}}", categoriesHtml);
    return html;
};

export { NavBar };