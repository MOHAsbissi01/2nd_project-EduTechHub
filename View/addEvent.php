<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'createEvent') {
    require_once '../Controller/eventController.php';
    $controller = new EventController();
    $controller->createEvent();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Event</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../cssD/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 300px; margin: auto; padding: 20px; }
        form { display: flex; flex-direction: column; }
        label { margin-top: 10px; }
        input[type=text], input[type=datetime-local], select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none; /* Hide error messages by default */
        }
        input[type=submit], input[type=button] {
            padding: 10px 15px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        input[type=button] {
            background-color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Add New Event</h1>

    <form id="eventForm" action="../Controller/eventController.php" method="post" novalidate>
        <!-- Add the 'novalidate' attribute to disable default browser validation -->
        <input type="hidden" name="action" value="createEvent">
        <label for="nom">Event Name:</label>
        <input type="text" id="nom" name="nom">
        <div id="nomError" class="error-message">Event name is required</div>
        <label for="sujet">Subject:</label>
        <input type="text" id="sujet" name="sujet">
        <div id="sujetError" class="error-message">Subject is required</div>
        <label for="date">Event Date:</label>
        <input type="datetime-local" id="date" name="date">
        <div id="dateError" class="error-message">Event date is required</div>
        <label for="lieu">Location:</label>
        <input type="text" id="lieu" name="lieu">
        <div id="lieuError" class="error-message">Location is required</div>
        <label for="organizateur">Organizer's Name:</label>
        <input type="text" id="organizateur" name="organizateur">
        <div id="organizateurError" class="error-message">Organizer's name is required</div>
<!-- In your edit event form -->
<div class="mb-3">
    <label for="affiche" class="form-label">Affiche (Image):</label>
    <!-- Hidden file input field -->
    <input type="file" id="affiche" name="affiche" class="form-control" style="display: none;">
    <!-- Button to trigger file input -->
    <button type="button" id="uploadBtn" class="btn btn-secondary">Upload Image</button>
    </div>

        <!-- Add error message divs for other input fields -->
        <label for="type">Event Type:</label>
        <select id="type" name="type">
            <option value="Atelier">Atelier</option>
            <option value="Conference">Conference</option>
            <option value="Seminaire">Seminaire</option>
            <option value="Formation en ligne">Formation en ligne</option>
            <option value="Table ronde">Table ronde</option>
            <option value="Forum">Forum</option>
            <option value="Hackathon">Hackathon</option>
        </select>
        <div id="typeError" class="error-message">Event type is required</div>
        <label for="frais">Registration Fee:</label>
        <input type="text" id="frais" name="frais">
        <div id="fraisError" class="error-message">Registration fee is required</div>
        <label for="duree">Event Duration:</label>
        <input type="text" id="duree" name="duree">
        <div id="dureeError" class="error-message">Event duration is required</div>

        <input type="submit" value="Confirm" class="btn btn-primary" >
        <input type="button" value="Cancel" class="btn btn-secondary" onclick="window.location.href='menu.php';">
    </form>
</div>

<script>
    document.getElementById('eventForm').addEventListener('submit', function(event) {
        // Your custom validation logic goes here
        var nomInput = document.getElementById('nom');
        var sujetInput = document.getElementById('sujet');
        var dateInput = document.getElementById('date');
        var lieuInput = document.getElementById('lieu');
        var organizateurInput = document.getElementById('organizateur');
        var organizateurInput = document.getElementById('affiche');
        var typeInput = document.getElementById('type');
        var fraisInput = document.getElementById('frais');
        var dureeInput = document.getElementById('duree');

        var isValid = true;

        // Check if the input fields are empty
        if (!nomInput.value.trim()) {
            document.getElementById('nomError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('nomError').style.display = 'none'; // Hide error message
        }

        if (!sujetInput.value.trim()) {
            document.getElementById('sujetError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('sujetError').style.display = 'none'; // Hide error message
        }

        if (!dateInput.value.trim()) {
            document.getElementById('dateError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('dateError').style.display = 'none'; // Hide error message
        }

        if (!lieuInput.value.trim()) {
            document.getElementById('lieuError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('lieuError').style.display = 'none'; // Hide error message
        }

        if (!organizateurInput.value.trim()) {
            document.getElementById('organizateurError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('organizateurError').style.display = 'none'; // Hide error message
        }


        if (!typeInput.value.trim()) {
            document.getElementById('typeError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('typeError').style.display = 'none'; // Hide error message
        }

        if (!fraisInput.value.trim()) {
            document.getElementById('fraisError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('fraisError').style.display = 'none'; // Hide error message
        }

        if (!dureeInput.value.trim()) {
            document.getElementById('dureeError').style.display = 'block'; // Display error message
            isValid = false;
        } else {
            document.getElementById('dureeError').style.display = 'none'; // Hide error message
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });


    // Get the button and file input element
    const uploadBtn = document.getElementById('uploadBtn');
    const afficheInput = document.getElementById('affiche');

    // Add click event listener to the button
    uploadBtn.addEventListener('click', function() {
        // Trigger click event on the file input
        afficheInput.click();
    });


</script>

</body>
</html>
