<?php 
if($_SESSION['use'] != 'admin'){
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
	$sql = "select username from User;";
	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_NUM);
	while($row != NULL){
		echo "<a class='botread' href='index.php?page=getmessage.php&user=".$row[0]."'>".$row[0]."</a>";
		
		echo "<hr><br>";
		$row = $result->fetch_array(MYSQLI_NUM);
	}


	
	$conn->close();
 ?>

