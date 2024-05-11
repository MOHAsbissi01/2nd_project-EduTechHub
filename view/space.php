<!DOCTYPE html>
<html lang="en">

  <head>
  <link rel="shortcut icon" type="image/x-icon" href="../logo.ico" />
  <title>Space</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>NASA APOD - Explore the Cosmos</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">
 
  </head>

<body>

   

  <!-- Sub Header -->
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
            <marquee behavior="scroll" direction="left">
              <p   style="font-weight: bold;">  Hello!  And   Welcome   to   our   education   and   formation   Website   --   <span style="color: red;">EduTechHub</span>   --</p>
            </marquee>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index-3.php" class="logo">
                           EduTechHub
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li><a href="index-3.php">Home</a></li>
                          <li class="has-sub">  
                         
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-20">
        <h2> NASA's Astronomy   </h2>
          <h6>  Picture of the Day
          </h6>
         
        </div>
      </div>
    </div>
          </section>

          <section class="meetings-page" id="meetings">
            <div class="container">
              <div class="row">
              <div class="col-lg-12 align-self-center">
                <div class="row">
                  <div class="col-lg-15">

                    <style>
         
                h1 {
                    font-size: 28px;
                    margin-bottom: 20px;
                    letter-spacing: 2px;
                    animation: slideInDown 1s ease-in-out;
                    color: #fff;
                }
                h2 {
                    font-size: 24px;
                    margin-bottom: 20px;
                    letter-spacing: 2px;
                    animation: slideInDown 1s ease-in-out;
                    color: #fff;
                }
                p {
                    font-size: 18px;
                    line-height: 1.6;
                    line-while-height: 1 ;
                    margin-bottom: 30px;
                    animation: fadeInUp 1s ease-in-out;
                    color: #fff;
                }
                img {
                    max-width: 100%;
                    height: auto;
                    margin-top: 20px;
                    border: 2px solid #fff;
                    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
                    animation: zoomIn 1s ease-in-out;
                }
                .space-tab {
                    background-color: #111;
                    padding: 30px;
                    border-radius: 10px;
                    margin-top: 40px;
                    box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
                    animation: pulse 2s infinite alternate;
                }

                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                @keyframes slideInDown {
                    from { transform: translateY(-20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
                @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
              
              
            </style>
                

<h1>NASA's Astronomy Picture of the Day</h1>
<div class="space-tab">
<?php
                
                $api_key = '8sSd7xP09D5QgPUnSyigBgtlHyw8xZNcJi01zBCq';

                // NASA API endpoint (Astronomy Picture of the Day)
                $nasa_endpoint = 'https://api.nasa.gov/planetary/apod';

                // Construct the API URL with the API key
                $nasa_url = "$nasa_endpoint?api_key=$api_key";

                // Make the API request
                $response = file_get_contents($nasa_url);

                // Decode the JSON response
                $data = json_decode($response, true);

                // Display the relevant information to users
                if (isset($data['title']) && isset($data['explanation'])) {
                    echo "<h2>{$data['title']}</h2>";
                    echo "<p>{$data['explanation']}</p>";
                    // Display the image if available
                    if (isset($data['url'])) {
                        echo "<img src='{$data['url']}' alt='NASA Image of the Day'>";
                    }
                } else {
                    echo "Error fetching NASA data. Please try again later.";
                }

            /*    echo "<form method='post'><button type='submit' name='save'>Save</button></form>";*/

                ?>

<?php
 

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 require 'PHPMailer/src/Exception.php';
 require 'PHPMailer/src/PHPMailer.php';
 require 'PHPMailer/src/SMTP.php';
 
 require '../model/config.php';
 
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
 
 // Get the user's email from the input field
 if (isset($_POST['email'])) {
     $email = $_POST['email'];
 
     // Construct the email body
     $title = $data['title'];
     $explanation = $data['explanation'];
     $body = "<h2>$title</h2><p>$explanation</p>";
 
     // Send email with the saved image as an attachment
     $mail = new PHPMailer(true);
     $mail->isSMTP();
     $mail->SMTPDebug = 2; // Enable verbose debug output
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'sbissimohamed9@gmail.com';
     $mail->Password = 'exzsybbdxhiybvfg';
     $mail->SMTPSecure = 'ssl';
     $mail->Port = 465;
 
     $mail->setFrom('sbissimohamed9@gmail.com', 'EduTech');
     $mail->addAddress($email);
     $mail->Subject = "NASA's Astronomy Picture of the Day";
     $mail->Body = $body;
     $mail->addAttachment($save_path, 'apod_image.jpg'); // Attach the saved image
 
     try {
         $mail->send();
       /*  echo 'Message has been sent to ' . $email; */
     } catch (Exception $e) {
         /* echo "Message could not be sent to $email. Mailer Error: {$mail->ErrorInfo}"; */
     }
 }
 ?>


</div>

 
<form method="post" action="z-mail.php">
        <label for="destination">Enter your destination:</label>
        <input type="email" name="destination" id="destination" required>
        <input type="submit" name="save" value="Send Email">
    </form>

<!--////////////////////////////////////////-->
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="pagination">
            
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/isotope.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/lightbox.js"></script>
    <script src="../assets/js/tabs.js"></script>
    <script src="../assets/js/isotope.js"></script>
    <script src="../assets/js/video.js"></script>
    <script src="../assets/js/slick-slider.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>


  </body>

</html>
