let HOST_URL = "../";

let DataProfile = {};

DataProfile.add = async function (formData) {
  const config = {
    method: "POST",
    body: formData,
  };
  let answer = await fetch(
    HOST_URL + "server/script.php?todo=addProfile",
    config,
  );
  let data = await answer.json();
  return data;
};

DataProfile.readProfiles = async function () {
  let answer = await fetch(HOST_URL + "server/script.php?todo=readProfiles");
  let data = await answer.json();
  return data;
};

DataProfile.update = async function (formData) {
  const config = {
    method: "POST",
    body: formData,
  };
  let answer = await fetch(
    HOST_URL + "server/script.php?todo=updateProfile",
    config,
  );
  let data = await answer.json();
  return data;
};
export { DataProfile };
