function validateForm() {
    const idCours = document.getElementById("id_cours").value;
    const titre = document.getElementById("titre").value;
    const proprietaire = document.getElementById("proprietaire").value;
    const prix = document.getElementById("prix").value;
    const description = document.getElementById("description").value;
    const image = document.getElementById("image").value;
    const category = document.getElementById("category").value;
    const pdf = document.getElementById("pdf").value;

    if (idCours === "" || titre === "" || proprietaire === "" || prix === "" || description === "" || image === "" || category === "" || pdf === "") {
        alert("Veuillez remplir tous les champs");
        return false;
    }

    return true;
}
