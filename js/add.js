<script>
    function validateForm() {
        var idCours = document.getElementById("id_cours").value;
        var titre = document.getElementById("titre").value;
        var proprietaire = document.getElementById("proprietaire").value;
        var prix = document.getElementById("prix").value;
        var description = document.getElementById("description").value;
        var image = document.getElementById("image").value;
        var category = document.getElementById("category").value;
        var pdf = document.getElementById("pdf").value;

        if (idCours === "" || titre === "" || proprietaire === "" || prix === "" || description === "" || image === "" || category === "" || pdf === "") {
            alert("Veuillez remplir tous les champs");
            return false;
        }

        return true;
    }
</script>