<?php
require_once('../controller/categorieC.php');
$controller = new CategorieC();

if (isset($_GET['id_categorie']) && isset($_GET['type_doc'])) {
    $id_categorie = filter_input(INPUT_GET, 'id_categorie', FILTER_SANITIZE_NUMBER_INT);
    $type_doc = filter_input(INPUT_GET, 'type_doc', FILTER_SANITIZE_STRING);

    if ($id_categorie !== false && $id_categorie !== null && $type_doc !== false && $type_doc !== null) {
        // Retrieve docs by type and category
        $pieces = $controller->getCoursByTypeAndCategory($type_doc, $id_categorie);

        // Display the id_cours of the retrieved doc
        foreach ($pieces as $piece) {
            echo "ID: " . htmlspecialchars($piece['id_cours']) . "<br>";
        }
    } else {
        // Invalid category ID or type of work, handle the error
        echo "Invalid category ID or type of work.";
        exit();
    }
} else {
    // Parameters not specified, handle the error
    echo "Categorie ID or type of work not specified.";
}
?>
