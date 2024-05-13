<?php
    include "../config.php";
    include "reponseC.php";
    $reponseC = new reponseC();
    $reponseC->deleteReponse($_GET['id']);
    header('Location: ../view/Back Office/Reponse.php');
?>