<?php 
if(!isset($_SESSION['use'])){
	echo "<script>window.location='index.php?page=home.php';</script>";
}
?>
<?php 
	$servername = "localhost";
	$username = "user3";
	$password = "nghia123";
	$database = "";

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
	$conn->query("USE db_xss;");

	$sql = "select * from Message where receiver = '".$_SESSION['use']."';";

	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_NUM);
	//echo "<p>".$_SESSION['use']."<p>";
	while($row != NULL){
		//TODO
		echo "<b>From:</b> ".$row[2]."<br><b>Title:</b> ".$row[1]."<br><b>Content:</b> ".$row[3]."<br>";
		
		
	 	echo "<hr>";
		$row = $result->fetch_array(MYSQLI_NUM);
	}

	$conn->close();
?>
