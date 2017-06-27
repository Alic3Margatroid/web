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
	$sql = "select * from Message where receiver='".$_GET['user']."';";
	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_NUM);
	echo "Message received by ".$_GET['user'];
	echo "<script> var test = 'checking ".$_GET['user']."'</script>";
	while($row != NULL){
		
		echo "<p class='botread'><b>Author:</b> ".$row[2]." <b>To:</b> ".$row[4]."<br><b>Title:</b> ".$row[1]."<br><b>Content:</b> ".$row[3]."<br></p>";
		echo "<hr><br>";	
		$row = $result->fetch_array(MYSQLI_NUM);
	}
	//echo "<script> window.location='http:\/\/rekt.t1.test.com';</script>";
	

	
	$conn->close();
 ?>
