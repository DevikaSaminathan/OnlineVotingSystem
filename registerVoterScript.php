<?php 
session_start();

$con = mysqli_connect("localhost", "root", "", "StudentVote") or die (mysqli_error($con));

$name = $_POST["name"];
$studentId = $_POST["sid"];
$password = $_POST["pass"];
$email = $_POST["email_id"];
$contact = $_POST["contact"];

// Validate email and contact
if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@vicas.org') !== false) {
    // Check if the contact number is exactly 10 digits
    if (preg_match('/^\d{10}$/', $contact)) {
        
        // Check if the email or student ID already exists in the database
        $check_query = "SELECT * FROM users WHERE email = '$email' OR studentId = '$studentId'";
        $result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($result) > 0) {
            // If a matching email or student ID exists
            echo '<span class="error">Error: This email or student ID is already registered.</span>';
        } else {
            // If no duplicate is found, insert the data into the database
            $insert_query = "INSERT INTO users (name, studentId, password, email, contact) 
                             VALUES ('$name', '$studentId', '$password', '$email', '$contact')";
            $insert_submit = mysqli_query($con, $insert_query) or die(mysqli_error($con));

            // Show success message with details
            echo '<span class="success">Registration successful!</span><br>';
            echo '<b>Details:</b><br>';
            echo 'Name: ' . htmlspecialchars($name) . '<br>';
            echo 'Student ID: ' . htmlspecialchars($studentId) . '<br>';
            echo 'Email: ' . htmlspecialchars($email) . '<br>';
            echo 'Contact: ' . htmlspecialchars($contact) . '<br>';
        }

    } else {
        echo '<span class="error">Error: Contact number must be exactly 10 digits.</span>';
    }
} else {
    echo '<span class="error">Error: Email must be a valid @vicas.org email address.</span>';
}
?>
