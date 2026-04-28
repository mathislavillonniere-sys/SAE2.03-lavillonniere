let HOST_URL = "https://mmi.unilim.fr/~lavillonniere7/SAE2.03-lavillonniere/";

let DataProfile = {};

DataProfile.add = async function(formData) {
    const config = {
        method: "POST",
        body: formData
    };
    let answer = await fetch(HOST_URL + "server/script.php?todo=addProfile", config);
    let data = await answer.json();
    return data;
};

export { DataProfile };