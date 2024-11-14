<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | Student Voting System</title>
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
    <style>
      body {
    color: white;
    background-color: #274; /* Fallback color */
/* Make sure the path is correct */
    background-size: cover; /* Ensures the image covers the entire page */
    background-position: center; /* Centers the background image */
    background-attachment: fixed; /* Keeps the image fixed in place while scrolling */
    background-repeat: no-repeat; /* Ensures the image doesn't repeat */
}

        input {
            width: 250px;
            padding: 10px;
            margin: 5px;
            border-radius: 10px;
        }
        hr {
            align: center;
            width: 500px;
        }
        .error {
            color: red;
        }
        .success {
            color: black;
        }
    </style>
    <script>
        function validateForm() {
            var email = document.forms["voterForm"]["email_id"].value;
            var contact = document.forms["voterForm"]["contact"].value;
            var emailError = document.getElementById("emailError");
            var contactError = document.getElementById("contactError");
            var isValid = true;

            emailError.innerHTML = "";
            contactError.innerHTML = "";

            if (!email.endsWith("@vicas.org")) {
                emailError.innerHTML = "Invalid email. Must be a @vicas.org email.";
                isValid = false;
            }

            if (!/^\d{10}$/.test(contact)) {
                contactError.innerHTML = "Contact number must be exactly 10 digits.";
                isValid = false;
            }

            return isValid;
        }

        function submitForm(event) {
            event.preventDefault(); 

            if (validateForm()) {
                var formData = new FormData(document.forms["voterForm"]);

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "registerVoterScript.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("message").innerHTML = xhr.responseText;
                    }
                };
                xhr.send(formData);
            }
        }
    </script>
</head>
<body style="background-image: url('assest/vote3_bg.jpg'); background-size: cover; background-position: center;">
<center>
    <h1>Student Election System</h1>
    <h3>New User Registration</h3>
    <h3><a href="index.php">Goto HOME</a></h3>
    <hr>
    <h3>New Record Insertion</h3>
    <form name="voterForm" method="post" onsubmit="submitForm(event)">
        <input type="text" placeholder="Name" name="name" required><br>
        <input type="text" placeholder="Student ID" name="sid" required><br>
        <input type="password" placeholder="Password" name="pass" required><br>
        <input type="text" placeholder="Contact" name="contact" required>
        <span id="contactError" class="error"></span><br>
        <input type="text" placeholder="Email" name="email_id" required>
        <span id="emailError" class="error"></span><br>
        <input class="btn btn-primary" type="submit" name="submit" value="Register">
    </form>
    <hr>
    <div id="message"></div> 
    <h3><a href="voterlogin.php">voter login</a></h3>
</center>
</body>
</html>
