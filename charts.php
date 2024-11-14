<!DOCTYPE html>
<html>
<head>
    <title>Election Results</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="master.css">
    <style>
        body {
            font-family: 'Secular One', sans-serif;
            text-align: center;
        }
        canvas {
            margin-top: 50px;
            max-width: 600px;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
</head>
<body>

<h1>Election Results</h1>

<div class="container">
    <canvas id="resultChart"></canvas>
</div>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentVote";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the candidates and their vote counts
$sql = "SELECT name, voteCount FROM candidate";
$result = $conn->query($sql);

// Initialize arrays to hold candidate names, vote counts, and percentages
$candidates = [];
$totalVotes = 0;

if ($result->num_rows > 0) {
    // Calculate the total votes and store the results
    while ($row = $result->fetch_assoc()) {
        $totalVotes += $row['voteCount'];
        $candidates[] = $row;
    }
} else {
    echo "<h3>No voting results available yet.</h3>";
}

$conn->close();

// Calculate percentage for each candidate and sort them by percentage in descending order
foreach ($candidates as &$candidate) {
    $candidate['percentage'] = $totalVotes > 0 ? ($candidate['voteCount'] / $totalVotes) * 100 : 0;
}
usort($candidates, function ($a, $b) {
    return $b['percentage'] <=> $a['percentage'];
});

// Prepare data for chart: sorted names, vote counts, and percentages
$candidateNames = array_column($candidates, 'name');
$voteCounts = array_column($candidates, 'voteCount');
$percentages = array_column($candidates, 'percentage');

// Convert PHP arrays into JSON for use in JavaScript
$candidateNamesJSON = json_encode($candidateNames);
$percentagesJSON = json_encode($percentages);
?>

<script>
// Parse the JSON-encoded PHP data
let candidateNames = JSON.parse('<?php echo $candidateNamesJSON; ?>');
let percentages = JSON.parse('<?php echo $percentagesJSON; ?>');

// Check if we have valid data
if (candidateNames.length > 0 && percentages.length > 0) {
    // Create the pie chart
    var ctx = document.getElementById('resultChart').getContext('2d');
    var resultChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: candidateNames, // Candidate names as labels
            datasets: [{
                data: percentages, // Percentages as data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let label = tooltipItem.label || '';
                            let percentage = percentages[tooltipItem.dataIndex].toFixed(2);
                            return `${label}: ${percentage}%`;
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Student Election Voting Results'
                }
            },
            responsive: true
        }
    });
} else {
    document.write("<h3>No results to display yet.</h3>");
}
</script>

<h3><a href="dashboard.php">Go to Dashboard</a></h3>

</body>
</html>
