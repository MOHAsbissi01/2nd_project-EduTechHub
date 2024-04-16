<?php
require_once('../config.php');

class coursC
{
    public function listCours()
{
    $pdo = config::getConnexion();
    $query = $pdo->prepare("SELECT cours.*, categorie.type_doc
                    FROM cours
                    INNER JOIN categorie ON cours.category = categorie.id_category");
    $query->execute();
    $cours = $query->fetchAll();

    return $cours;
}


public function deleteCours($id_cours)
{
    // Vérifie si l'identifiant est vide, non numérique ou n'existe pas dans la base de données
    $pdo = config::getConnexion();
    $query_check = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE id_cours = :id");
    $query_check->bindParam(':id', $id_cours, PDO::PARAM_INT);
    $query_check->execute();
    $count = $query_check->fetchColumn();
    
    if (empty($id_cours) || !is_numeric($id_cours) || $count == 0) {
        // Si l'identifiant est invalide ou n'existe pas, affiche un message d'erreur et retourne false
        echo "Invalid or non-existent ID.";
        return false;
    }

    try {
        $query = $pdo->prepare("DELETE FROM cours WHERE id_cours = :id");
        $query->bindParam(':id', $id_cours, PDO::PARAM_INT);

        if ($query->execute()) {
            return true;
        } else {
            // Ajoutez des messages de débogage ici
            echo "Error executing delete query. Debug info: " . implode(" ", $query->errorInfo());
            return false;
        }
    } catch (PDOException $e) {
        // Ajoutez des messages de débogage ici
        echo "Error executing delete query. Exception: " . $e->getMessage();
        return false;
    }
}

    

    public function addCours($id_cours, $titre, $proprietaire, $prix, $description, $image, $category,$pdf)
{
    $pdo = config::getConnexion();

    try {
        $query = $pdo->prepare("INSERT INTO cours (id_cours, titre, proprietaire, prix, description, image, category, pdf) VALUES (:id_cours, :titre, :proprietaire, :prix, :description, :image, :category,:pdf)");
        $query->bindParam(':id_cours', $id_cours);
        $query->bindParam(':titre', $titre);
        $query->bindParam(':proprietaire', $proprietaire);
        $query->bindParam(':prix', $prix);
        $query->bindParam(':description', $description);
        $query->bindParam(':image', $image);
        $query->bindParam(':category', $category);
        $query->bindParam(':pdf', $pdf);
        // Déplacer le fichier téléchargé vers le dossier 'uploads'
        $pdf_tmp = $_FILES['pdf']['tmp_name'];
        $pdf_path = '../uploads/' . $_FILES['pdf']['name'];
        move_uploaded_file($pdf_tmp, $pdf_path);

        // Utiliser le chemin relatif correct pour enregistrer le fichier dans la base de données
        $pdf = '../uploads/' . $_FILES['pdf']['name'];

            if ($query->execute()) {
                return true;
            } else {
                // Ajoutez des messages de débogage ici
                echo "Error executing insert query. Debug info: " . implode(" ", $query->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            // Ajoutez des messages de débogage ici
            echo "Error executing insert query. Exception: " . $e->getMessage();
            return false;
        }
    }

    public function showCours($id_cours)
    {
        $sql = "SELECT * FROM cours WHERE id_cours = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id_cours);
            $query->execute();
            $cours = $query->fetch();
            return $cours;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateCours($id_cours, $titre, $proprietaire, $prix, $description, $image, $category,$pdf)
    {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare("UPDATE cours 
                                    SET titre = :titre, 
                                    proprietaire = :proprietaire,  
                                    prix = :prix, 
                                    description = :description, 
                                    image = :image, 
                                    category = :category,
                                    pdf = :pdf
                                    WHERE id_cours = :id");

            $query->bindParam(':id', $id_cours);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':proprietaire', $proprietaire);
            $query->bindParam(':prix', $prix);
            $query->bindParam(':description', $description);
            $query->bindParam(':image', $image);
            $query->bindParam(':category', $category);
            $query->bindParam(':pdf', $pdf);

            $query->execute();

            return "Cours details updated successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
