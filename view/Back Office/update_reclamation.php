<?php
    include "../../config.php";
    include "../../Controller/reclamationC.php";
    include "../../Model/reclamation.php";
    $error = null;

    // Check if the ID is set in the URL
    if(isset($_GET['id'])) {
        $recC = new reclamationC();
        // Fetch the reclamation data based on the ID
        $reclamation = $recC->showreclamation($_GET['id']);
    } else {
        // If ID is not provided, handle the error or redirect
        // For now, let's just redirect to a page where ID is provided
        header('Location:SomePage.php');
        exit; // Stop further execution
    }

    if(isset($_POST["nom"]) 
    && isset($_POST["num"]) 
    && isset($_POST["email"]) 
    && isset($_POST["description"])){
        if(!empty($_POST["nom"])
        && !empty($_POST["num"])
        && !empty($_POST["email"])
        && !empty($_POST["description"])){
            $recC->updatereclamation($_GET['id'],$_POST["email"], $_POST["nom"], $_POST["num"], $_POST["description"]);
            header('Location:Reclamation.php');
            exit; // Stop further execution after redirecting
        }
        else{
            $error = "Missing info"; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <title>EduTechHub
        - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <?php require ('menu.php'); ?>
        <!-- Table Start -->
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <!-- Populate input with email from reclamation data -->
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $reclamation['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Name</label>
                <!-- Populate input with name from reclamation data -->
                <input type="text" class="form-control" id="exampleInputName" name="nom" value="<?php echo $reclamation['nom']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputNumber" class="form-label">Number</label>
                <!-- Populate input with number from reclamation data -->
                <input type="text" class="form-control" id="exampleInputNumber" name="num" value="<?php echo $reclamation['num']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputDescription" class="form-label">Description</label>
                <!-- Populate input with description from reclamation data -->
                <textarea class="form-control" id="exampleInputDescription" name="description"><?php echo $reclamation['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <!-- Table End -->

        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
