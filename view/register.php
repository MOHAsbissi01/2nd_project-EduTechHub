<?php

include_once '../controller/RegisterController.php';

// Create instance of RegisterController
$registerController = new RegisterController();
// Call register method to handle form submission
$message = $registerController->register();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post" enctype="multipart/form-data" id="registrationForm">
      <h3>Register Now</h3>
      <?php
      if(isset($message)){
         echo '<div class="message">'.htmlspecialchars($message).'</div>';
      }
      ?>
      <input type="text" name="name" placeholder="Enter username" class="box" required>
      <input type="email" name="email" placeholder="Enter email" class="box" required>
      <input type="password" name="password" placeholder="Enter password (minimum 8 characters)" class="box" required>
      <input type="password" name="cpassword" placeholder="Confirm password" class="box" required>
      <select name="role" class="box" id="roleSelect" required>
         <option value="student">select a choice or will be student by default </option>
         <option value="admin">Admin</option>
         <option value="teacher">Teacher</option>
         <option value="student">Student</option>
      </select>
      <input type="text" name="code" placeholder="Enter code" class="box" id="codeInput" style="display: none;">
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="Register Now" class="btn">
      <p>Already have an account? <a href="../view/login.php">Login now</a></p>
   </form>
</div>

<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    var role = this.value;
    var codeInput = document.getElementById('codeInput');
    if (role === 'admin') {
        codeInput.style.display = 'block';
    } else {
        codeInput.style.display = 'none';
    }
});

document.getElementById('registrationForm').addEventListener('submit', function(event) {
    var role = document.getElementById('roleSelect').value;
    var pass = document.getElementsByName('password')[0].value;
    if (role === 'admin' && pass.length < 8) {
        alert('Password must be at least 8 characters long!');
        event.preventDefault(); // Prevent form submission
    }
});


</script>

</body>
</html>
