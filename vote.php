<?php 
session_start();
 ?>

<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet"> 

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentVote";

echo "<h1>Student Election System </h1>";
echo"<h2>Please vote your candidate.</h2>";
echo "<h2>Registed Candidates are:<br></h2>";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, name, email ,Department , Position FROM candidate";
$result = $conn->query($sql);

?>
<form action='voteCaste.php' method='POST'>
    <table class="table">
<?php	
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><label>";
    	echo "<input type=\"radio\" name=\"chosen_candidate\" value=\"".$row['id']."\">";
        echo " ID: ". $row["id"]. " ,  Name: ". $row["name"]. " , Position: " . $row["Position"].", Department:" .$row["Department"] . "<br><hr>";
        echo "</label></tr>";
    }
} else {
    echo "0 results";
}

$conn->close();
?> 
</table>
<input type="submit" value="Vote Now" class="btn">
</form>
<style>
	body{
		background-color:#1000;
        /* Add the background image here */
        background-size: cover; /* Ensures the image covers the whole page */
        background-position: center; /* Centers the background image */
        font-family: "Secular One", serif;
        text-align: center;
        max-width: 750px;
        margin-right: auto;
        margin-left: auto;
	}  
    h1{
        color: aqua;
    }
    .btn{
        padding:5px 15px;
        background-color: #00ffd2;
    }
</style>

