
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="../logo.ico" />
     <title>Read Edit Delete DATA</title>
<link rel="stylesheet" href="../css/style1.css">
    <script>
        function filterUsers(role) {
            var rows = document.querySelectorAll("tr");
            rows.forEach(function(row) {
                if (row.cells.length > 0) {
                    if (role === "all" || row.cells[0].innerText === role) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        }

        function confirmDelete(email) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "../controller/delete_data.php?email=" + email;
            }
        }
    </script>
</head>
<body>

<div>
    <button onclick="filterUsers('all')">All Users</button>
    <button onclick="filterUsers('1')">Admins</button>
    <button onclick="filterUsers('2')">Teachers</button>
    <button onclick="filterUsers('3')">Students</button>
</div>

<?php

require_once '../model/config.php';

try {
    $pdo = config::getConnexion();
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();

    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Image</th><th>Action</th></tr>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><img src='" . $row['image'] . "' alt='" . $row['name'] . "' style='max-width: 100px;'></td>";
        echo "<td><a href='edit_user.php?email=" . $row['email'] . "'>Edit</a> | <a href='javascript:void(0)' onclick='confirmDelete(\"" . $row['email'] . "\")'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?> 
</body>
</html>
