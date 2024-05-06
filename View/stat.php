<?php include 'common.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Statistics</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
                h1 {
            color: red;
            text-align: center;
        }
        #categoryChartContainer,
        #dateTimeChartContainer {
            width: 50%; 
            margin: 20px auto;
        }


    </style>
</head>
<body>
    <h1>Event Statistics</h1>
    <!-- Event Category Chart -->
    <div id="categoryChartContainer">
        <canvas id="categoryChart" width="300" height="200"></canvas>
    </div>
<br>
<br><br>
    <!-- Event Date/Time Chart -->
    <div id="dateTimeChartContainer">
        <canvas id="dateTimeChart" width="300" height="200"></canvas>
    </div>

    <?php
    // Include the necessary files to access the EventModel class
    require_once '../Model/eventModel.php';

    // Create an instance of the EventModel class
    $eventModel = new EventModel();

    // Call the getAllEvents() method to retrieve all events
    $events = $eventModel->getAllEvents();

    // Initialize an empty array to store category counts
    $categoryCounts = array();

    // Aggregate event counts by category
    foreach ($events as $event) {
        $category = $event['type']; // Assuming 'type' is the column name for event category
        $categoryCounts[$category] = isset($categoryCounts[$category]) ? $categoryCounts[$category] + 1 : 1;
    }

    // Initialize arrays to store date/time statistics
    $dateCounts = array();
    $timeCounts = array();

    // Aggregate event counts by date and time
    foreach ($events as $event) {
        $dateTime = strtotime($event['date']); // Assuming 'date' is the column name for event date
        $date = date('Y-m-d', $dateTime);
        $time = date('H:00', $dateTime);

        // Date counts
        if (!isset($dateCounts[$date])) {
            $dateCounts[$date] = 0;
        }
        $dateCounts[$date]++;

        // Time counts
        if (!isset($timeCounts[$time])) {
            $timeCounts[$time] = 0;
        }
        $timeCounts[$time]++;
    }
    ?>

    <script>
        // Retrieve category counts from PHP
        var categoryCounts = <?php echo json_encode($categoryCounts); ?>;

        // Extract category labels and counts
        var categories = Object.keys(categoryCounts);
        var counts = Object.values(categoryCounts);

        // Create a bar chart for event category statistics
        var ctxCategory = document.getElementById('categoryChart').getContext('2d');
        var categoryChart = new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Event Count by Category',
                    data: counts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Retrieve date/time counts from PHP
        var dateCounts = <?php echo json_encode($dateCounts); ?>;
        var timeCounts = <?php echo json_encode($timeCounts); ?>;

        // Extract date labels and counts
        var dates = Object.keys(dateCounts);
        var dateValues = Object.values(dateCounts);

        // Extract time labels and counts
        var times = Object.keys(timeCounts);
        var timeValues = Object.values(timeCounts);

        // Create a bar chart for event date/time statistics
        var ctxDateTime = document.getElementById('dateTimeChart').getContext('2d');
        var dateTimeChart = new Chart(ctxDateTime, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Event Count by Date',
                    data: dateValues,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Event Count by Time',
                    data: timeValues,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>

