

<?php
ob_start();

// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Fetch data from NASA API
$api_key = '8sSd7xP09D5QgPUnSyigBgtlHyw8xZNcJi01zBCq';
$nasa_endpoint = 'https://api.nasa.gov/planetary/apod';
$nasa_url = "$nasa_endpoint?api_key=$api_key";
$response = file_get_contents($nasa_url);
$data = json_decode($response, true);

// Download the image
$image_url = $data['url'];
$image_data = file_get_contents($image_url);

// Save the image to the "space_img" folder
$save_path = '../space_img/' . basename($image_url);
file_put_contents($save_path, $image_data);

// Get the user's destination from the input field
if (isset($_POST['destination'])) {
    $destination = $_POST['destination'];

    // Construct the email body
    $title = $data['title'];
    $explanation = $data['explanation'];
    $body = "$title\n\n$explanation";

    // Send email with the saved image as an attachment
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = 2; // Enable verbose debug output
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'sbissimohamed9@gmail.com'; // Replace with your email address
    $mail->Password = 'exzsybbdxhiybvfg'; // Replace with your email password
    $mail->SMTPSecure = 'ssl'; // Use 'tls' or 'ssl' based on your server configuration
    $mail->Port = 465; // Use the appropriate port (465 for SSL, 587 for TLS)

    $mail->setFrom('sbissimohamed9@gmail.com', 'EduTech');
    $mail->addAddress($destination);
    $mail->Subject = "NASA's Astronomy Picture of the Day";
    $mail->Body = $body;
    $mail->addAttachment($save_path, 'apod_image.jpg'); // Attach the saved image

    try {
        $mail->send();
        echo 'Message has been sent to ' . $destination;

        // Redirect the user to space.php
        header('Location: space.php'); // Add this line
        exit; // Terminate script execution
    } catch (Exception $e) {
        echo "Message could not be sent to $destination. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Destination not provided.';
}
ob_end_flush();
?>

