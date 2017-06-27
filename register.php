<?php
echo "<h1>REGISTER</h1>";

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

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


if(isset($_POST["submit"])){
	if ($securimage->check($_POST['captcha_code']) == false) {
	  echo "The security code entered was incorrect.<br /><br />";
	  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
	  exit;
	}

	$sql = "INSERT INTO User VALUES(?,?);";
	$stmt = mysqli_prepare($conn,$sql);
	$password_hashes = password_hash($_POST['password'],PASSWORD_DEFAULT);
	$stmt->bind_param("ss", $_POST['username'], $password_hashes );
	if ($_POST['username'] !=  htmlspecialchars($_POST['username'])){
		echo "Your username contain unallowed character(s)";
	}
	else if ($stmt->execute() === TRUE){
		echo "Successfully registered";
	}
	else{
		echo "Error creating user";
	}
}
$conn->close();
?>

<form action="index.php?page=register.php" method="post">
	 <p>Username: <input type="text" name="username"></p>
	 <p>Password: <input type="password" name="password"></p>
	 <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
	 <input type="text" name="captcha_code" size="10" maxlength="6" />
	 <p><a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a></p>
	 <input type="submit" name="submit" value="Register">
</form>
