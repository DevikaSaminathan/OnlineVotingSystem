<?php 
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "studentVote") or die(mysqli_error($conn));

// Get voter ID from session
$vid = $_SESSION['vid'];

// Check if the user has already voted
$sql_check = "SELECT voted FROM users WHERE id='$vid'";
$query_check = mysqli_query($conn, $sql_check) or die(mysqli_error($conn));
$user = mysqli_fetch_assoc($query_check);

echo '<br><h1><center>Student Election System</center></h1>';
echo "<div class='c1'>";

if ($user['voted'] == '1') {
    // User has already voted
    echo "Your vote was already recorded.";
} else {
    // User has not voted yet
    $cand_id = $_POST['chosen_candidate'];
    echo "Your vote was successfully recorded.<br>";
    echo "Voted for candidate with ID = " . $cand_id;

    // Update user's voted status
    $sql1 = "UPDATE users SET voted='1' WHERE id='$vid'";
    $query1_result = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

    // Update candidate vote count
    $sql2 = "UPDATE candidate SET voteCount = voteCount + 1 WHERE id='$cand_id'";
    $query2_result = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
}

echo "</div>";
?>
<h3><a href="dashboard.php">Go to Dashboard</a></h3>
<h3><a href="logout.php">LOGOUT</a></h3>
<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="master.css">
<style type="text/css">
    * {
        text-align: center;
    }
    .c1 {
        border: 2px solid yellow;
        display: inline-block;
        padding: 10px 20px;
    }
    h1 {
        color: aqua;
    }
</style>
