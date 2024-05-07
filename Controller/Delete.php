<?php
    include "../config.php";
    include "reclamationC.php";
    $recC = new reclamationC();
    $recC->deletereclamation($_GET['id']);
    header('Location: ../View/Back Office/Reclamation.php');
?>