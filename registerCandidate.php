<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Candidate Registration Portal</title>
    <style>
        body {
            background-color: #27ace854;
        }
        input {
            width: 250px;
            padding: 10px;
            margin: 5px;
            border-radius: 10px;
        }
        hr {
            width: 500px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="master.css">
</head>
<body>
<center>
    <h1>Student Election System</h1>
    <h3><mark>Candidate Registration Portal</mark></h3>
    <h3><a href="index.php">Goto HOME</a></h3>
    <hr>
    <h3>New Candidate's Details</h3>
    <form action="registerCandidateScript.php" method="post">
        <input type="text" placeholder="Name" name="name" required>
        <br>
        <input type="email" placeholder="Email" name="email" required>
        <br>
        <input type="text" placeholder="Contact" name="contact" required>
        <br>
        <input type="text" placeholder="Department" name="Department" required>
        <br>
        <input type="text" placeholder="Position" name="Position" required>
        <br>
        <input class="btn btn-primary" type="submit" name="submit" value="Register">
    </form>
    <hr>
</center>
</body>
</html>
