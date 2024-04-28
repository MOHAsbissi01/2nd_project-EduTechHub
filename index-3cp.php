<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NASA APOD - Explore the Cosmos</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Helvetica', sans-serif;
            text-align: center;
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            letter-spacing: 2px;
            animation: slideInDown 1s ease-in-out;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-in-out;
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

        /* Keyframe animations */
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
        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
      
    </style>
</head>
<body>
    <h1>NASA's Astronomy Picture of the Day</h1>
    <div class="space-tab">
        <?php
        // Your NASA API key
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
        ?>
    </div>
</body>
</html>


