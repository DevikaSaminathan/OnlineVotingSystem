<?php
session_start();
if (!isset($_SESSION['vid'])) {
    header("location: voterLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Election System</title>
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="master.css">
    <style>
        body {
            background-color: #27ace854;
        }
        input {
            width: 250px;
            padding: 5px;
            margin: 5px;
            border-radius: 10px;
        }
        hr {
            width: 500px;
        }
    </style>
</head>
<body>
<center>
    <h1>Student Election System</h1>
    <h3>Voter's Dashboard</h3>
    <hr>

    <?php
    $id = $_SESSION['vid'];
    $db = new mysqli("localhost", "devi", "devi", "StudentVote");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Fetch the email
    $stmt = $db->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    // Display the email
    echo "<p><b>Hello, Welcome to our office bearer Election , click vote</b></p>";

    $db->close();
    ?>

    <hr>
    <h3><a href="vote.php">vote</a></h3>
    <h3><a href="logout.php">LOGOUT</a></h3>
    <h3><a href="index.php">Goto HOME</a></h3>
</center>
</body>
</html>
