<?php 
session_start();
?>

<?php
$con = mysqli_connect("localhost", "root", "", "StudentVote") or die (mysqli_error($con));

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["contact"];
$Department = $_POST["Department"];
$Position = $_POST["Position"];

// Check if the email is from the domain @vicas.org
if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@vicas.org') !== false) {

    // Check if the contact number is exactly 10 digits
    if (preg_match('/^\d{10}$/', $phone)) {
        echo '<br><h1><center>Student Election System</center></h1>';
        echo '<h3><center>Your details have been successfully recorded</center></h3>';
        echo "<center><hr>Your details are:<br>";
        echo "Name : $name <br>";
        echo "Email : $email <br>";
        echo "Contact : $phone <br>";    
        echo "Department : $Department <br>";
        echo "Position : $Position <br>";
        
        echo "<hr></center>";

        // Insert the data into the database
        $insert_query = "INSERT INTO candidate(name, email, contact, Department, Position) VALUES('$name', '$email', '$phone','$Department','$Position')";
        $insert_submit = mysqli_query($con, $insert_query) or die(mysqli_error($con));
    } else {
        echo '<br><h1><center>Student Election System</center></h1>';
        echo '<h3><center>Error: Contact number must be exactly 10 digits.</center></h3>';
    }
} else {
    echo '<br><h1><center>Student Election System</center></h1>';
    echo '<h3><center>Error: Email must be a valid @vicas.org email address.</center></h3>';
}
?>

<style>
hr {
    align: center;
    width: 500px;
}
</style>
<center>
    <a href="./index.php">Home</a>
</center>
<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="master.css">
