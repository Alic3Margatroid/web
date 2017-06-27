
<?php 
if(isset($_SESSION['use'])){
	echo "<script>window.location='index.php?page=home.php';</script>";
}

 ?>

<?php

echo "<h1>LOGIN</h1>";

$servername = "localhost";
$username = "user3";
$password = "nghia123";
$database = "";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

// $sql = "CREATE DATABASE IF NOT EXISTS db_sqli;";
// if ($conn->query($sql) !== TRUE) {   
//     echo "Error creating database: " . $conn->error;
// }

$conn->query("USE db_xss;");
// $sql = "CREATE TABLE IF NOT EXISTS User(username VARCHAR(30) NOT NULL PRIMARY KEY, password VARCHAR(256) NOT NULL);";
// if ($conn->query($sql) !== TRUE) {
//     echo "Error creating table: " . $conn->error;
// }

if(isset($_POST["submit"])){
	$sql = "SELECT * from User where username = ?;";
	$stmt = mysqli_prepare($conn,$sql);
	$stmt->bind_param("s", $_POST['username']);

	if ($stmt->execute() === TRUE) {
		$stmt->bind_result($username, $password);
		while($stmt->fetch()){
        	if (password_verify($_POST['password'], $password)){
        		echo "OK";
        		$_SESSION['use'] = $username;

        		echo "<script>window.location='index.php?page=home.php';</script>";
        	}
        	else{
        		echo "Invalid username/password";
        	}
    	}
	}
	else{
		echo "FAIL:(";
	}
}
$conn->close();
?>
<form action="index.php?page=login.php" method="post">
	 <p>Username: <input type="text" name="username"></p>
	 <p>Password: <input type="password" name="password"></p>
	 <input id="submit" type="submit" name="submit" value="Login">
</form>
