<?php
include "../../config.php";
include "../../Controller/reponseC.php";
include "../../Model/reponse.php";
include "../../Controller/send_reponse.php";

$error = null;
// Assuming you have a method to get the response ID from GET or session
$response_id = $_GET['id_rep']; // or any other method to get the response ID
$responseC = new reponseC();
$response = $responseC->getReponseById($response_id); // Get the response information
if (isset($_POST["subject"]) && isset($_POST["msg"])) {
    if (!empty($_POST["subject"]) && !empty($_POST["msg"])) {
        $resp = new reponse($response_id, null,$_POST["subject"], $_POST["msg"]);
        $responseC->updateReponse($resp); // Update the response

        $sendResult = sendResponseEmail($_POST["subject"], $_POST["msg"], $_GET['email'], $_GET['nom']);
    
        if ($sendResult === true) {
            $error =  "Email sent successfully to " . $_GET['email'] . "";
  
        } else {
            $error = "Error sending email to " .$_GET['email'] . ": " . $sendResult . "";
        }


        // Redirect back to the reclamation page or any other page
        header('Location:Reponse.php');
        exit();
    } else {
        $error = "Missing info";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EduTechHub - Bootstrap Admin Template</title>
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
        <!-- Menu -->
        <?php require ('menu.php'); ?>
        <!-- Form Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-md-8 offset-md-2">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Update Response</h6>
                        <?php if ($error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                    value="<?php echo $response['subject']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="msg" class="form-label">Message</label>
                                <textarea class="form-control" id="msg" name="msg" rows="5"
                                    required><?php echo $response['msg']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form End -->
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
