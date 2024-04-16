<?php
require_once('../config.php');

class CategorieC {
    public function listCategories() {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("SELECT * FROM categorie");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors here
            echo "Error fetching categories: " . $e->getMessage();
            return [];
        }
    }

    public function getPiecesByCategoryId($id_category) {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("SELECT * FROM cours WHERE category = :id_category");
            $query->bindParam(':id_category', $id_category, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors here
            return [];
        }
    }

    public function getCoursByTypeAndCategory($type_doc, $id_category) {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("SELECT * FROM cours WHERE category = :id_category AND type_cours = :type_cours");
            $query->bindParam(':id_category', $id_category, PDO::PARAM_INT);
            $query->bindParam(':type_cours', $type_cours, PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors here
            return [];
        }
    }
    public function getCoursById($id_cours) {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("SELECT * FROM pcours WHERE id_cours = :id_cours");
            $query->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors here
            return null;
        }
    }
    public function getTotalCours() {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("SELECT COUNT(*) as total FROM cours");
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (PDOException $e) {
            // Handle errors here
            return 0;
        }
    }

    public function getAllCoursWithPagination($tri = 'asc', $itemsPerPage, $offset) {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("SELECT * FROM cours ORDER BY prix " . ($tri === 'desc' ? 'DESC' : 'ASC') . " LIMIT :itemsPerPage OFFSET :offset");
            $query->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors here
            return [];
        }
    }
    public function getAllCours($tri = 'asc') {
        $pdo = config::getConnexion();
        try {
            $query = $pdo->prepare("SELECT * FROM cours ORDER BY prix " . ($tri === 'desc' ? 'DESC' : 'ASC'));
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors here
            return [];
        }
    }
}
?>
