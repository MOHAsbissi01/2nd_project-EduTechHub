<?php
require_once '../Model/eventModel.php';

$eventModel = new EventModel();
$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchResults = $eventModel->searchEventByName($searchQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Events</title>
    <link rel="stylesheet" type="text/css" href="../cssD/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            margin-top: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"], button[type="button"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"], button[type="button"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover, button[type="button"]:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search for an Event</h1>
        <form action="recherche.php" method="get">
            <input type="text" name="search" placeholder="Enter name">
            <input type="submit" value="Search">
            <button type="button" onclick="window.location.href='eventslist.php';">Cancel</button>
        </form>

        <?php if (!empty($searchResults)): ?>
            <h2>Search Results</h2>
            <ul>
                <?php foreach ($searchResults as $event): ?>
                    <li><?php echo htmlspecialchars($event['nom']); ?> - <?php echo htmlspecialchars($event['date']); ?> - <?php echo htmlspecialchars($event['lieu']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
