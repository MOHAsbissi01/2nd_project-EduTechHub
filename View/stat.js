// Retrieve category counts from PHP
var categoryCounts = <?php echo json_encode($categoryCounts); ?>;

// Extract category labels and counts
var categories = Object.keys(categoryCounts);
var counts = Object.values(categoryCounts);

// Create a bar chart
var ctx = document.getElementById('categoryChart').getContext('2d');
var categoryChart = new Chart(ctx, {
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
