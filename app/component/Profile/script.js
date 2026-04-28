let templateFile = await fetch("./component/Profile/template.html");
let template = await templateFile.text();

let Profile = {};

Profile.format = function(profiles) {
    if (profiles.length === 0) {
        return "<p>Aucun profil disponible.</p>";
    }
    let html = "";
    for (let profile of profiles) {
        let carte = template;
        carte = carte.replace("{{id}}", profile.id);
        carte = carte.replaceAll("{{name}}", profile.name);
        carte = carte.replace("{{avatar}}", profile.avatar ? "https://mmi.unilim.fr/~lavillonniere7/SAE2.03-lavillonniere/server/images/" + profile.avatar : "");
        carte = carte.replace("{{min_age}}", profile.min_age);
        html += carte;
    }
    return html;
};

export { Profile };