<!DOCTYPE html>
<html lang="en">

<head>
<script>
$(document).ready(function(){
    $("#search").keyup(function(){
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {query:query},
                success: function(data) {
                    $('#searchResult').html(data);
                }
            });
        } else {
            $('#searchResult').html("");
        }
    });
});
</script>
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
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Reclamation</h6>
                        <form action="Reclamation.php" method="get">
                            <input type="text" name="search" placeholder="Search by name...">
                            <input type="submit" value="Search">
                        </form>
                        <!-- Ajoutez ce formulaire pour le tri par nom -->
                        <form action="Reclamation.php" method="get">
                            <input type="hidden" name="sortby" value="name">
                            <input type="submit" value="Sort by Name">
                        </form>
                        </center>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Numero</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Add reponse</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    <input type="text" id="search" placeholder="Search by name...">
                                        <div id="searchResult"></div>
                                </thead>
                                <tbody>
                                    <?php
                                    include "../../config.php";
                                    include "../../Controller/reclamationC.php";
                                    $recC = new reclamationC();

                                    // Check if the search or sortby parameter is set
                                    if (isset($_GET['search'])) {
                                        $search = $_GET['search'];
                                        $list = $recC->searchReclamationByName($search);
                                    } elseif (isset($_GET['sortby']) && $_GET['sortby'] == 'name') {
                                        $list = $recC->ListreclamationSortedByName();
                                    } else {
                                        $list = $recC->Listreclamation();
                                    }

                                    if ($list) {
                                        foreach ($list as $reclamation) {
                                            ?>
                                            <tr>
                                                <td><?php echo $reclamation['id_recla']; ?></td>
                                                <td><?= htmlspecialchars($reclamation['nom']); ?></td>
                                                <td><?php echo $reclamation['num']; ?></td>
                                                <td><?= htmlspecialchars($reclamation['email']); ?></td>
                                                <td><?php echo $reclamation['description']; ?></td>
                                                <td> <a
                                                        href="add_reponse.php?id_recla=<?php echo $reclamation['id_recla']; ?>&email=<?php echo $reclamation['email']; ?>&nom=<?php echo $reclamation['nom']; ?>">reponse</a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="update_reclamation.php?id=<?php echo $reclamation['id_recla']; ?>">update</a>
                                                    <a
                                                        href="../../Controller/Delete.php?id=<?php echo $reclamation['id_recla']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No reclamations found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->

        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



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