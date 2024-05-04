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

    public function getCoursByCategoryId($category_id)
    {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("SELECT cours.*, categorie.type_doc
                                FROM cours
                                INNER JOIN categorie ON cours.category = categorie.id_category
                                WHERE categorie.id_category = :category_id");
        $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $query->execute();
        $cours = $query->fetchAll();
    
        return $cours;
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
            $query = $pdo->prepare("SELECT * FROM cours WHERE id_cours = :id_cours");
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

    // Nouvelle méthode pour les statistiques des cours
    public function getCoursStatistics() {
        $pdo = config::getConnexion();
        try {
            // Requête pour le total des cours
            $totalQuery = $pdo->prepare("SELECT COUNT(*) as total FROM cours");
            $totalQuery->execute();
            $totalCours = $totalQuery->fetch(PDO::FETCH_ASSOC)['total'];
    
            // Requête pour la répartition par catégorie
            $categoryQuery = $pdo->prepare("SELECT c.type_doc, COUNT(*) as count FROM cours AS cr INNER JOIN categorie AS c ON cr.category = c.id_category GROUP BY cr.category");
            $categoryQuery->execute();
            $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);
    
            // Requête pour les fourchettes de prix
            $priceQuery = $pdo->prepare("SELECT CASE 
                WHEN prix < 20 THEN 'moins de 20 dinars' 
                WHEN prix BETWEEN 20 AND 50 THEN '20 à 50 dinars' 
                ELSE 'plus de 50 dinars' 
            END as priceRange, COUNT(*) as count FROM cours GROUP BY priceRange");
            $priceQuery->execute();
            $prices = $priceQuery->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'totalCours' => $totalCours,
                'categories' => $categories,
                'prices' => $prices
            ];
        } catch (PDOException $e) {
            echo "Error generating statistics: " . $e->getMessage();
            return [];  // Assurez-vous que cette méthode renvoie toujours un tableau.
        }
    }
}
?>
