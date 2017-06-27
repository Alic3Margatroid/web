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
	$sql = "select * from Message;";
	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_NUM);

	while($row != NULL){
		//TODO
		if ($row[2] == $_SESSION['use']){
			echo "<b>To:</b> ".$row[4]."<br><b>Title:</b> ".$row[1]."<br><b>Content:</b> ".$row[3]."<br>";
			echo "<hr><br>";	
		}
		$row = $result->fetch_array(MYSQLI_NUM);
	}

	if(isset($_POST["submit"])){
		$title = $_POST['title'];
		$author = $_SESSION['use'];
		$content = $_POST['content'];
		$receiver = $_POST['receiver'];
		$sql = "INSERT INTO Message(title,author,content,receiver) VALUES ('".$title."','".$author."','".$content."','".$receiver."');";
		
		if($conn->query($sql)===TRUE){
			echo "Post successfully";
			echo "<script>window.location='index.php?page=sendmessage.php';</script>";
		}
		else{
			echo "FAIL:(";
		}
	}
	$conn->close();
 ?>

<form action="index.php?page=sendmessage.php" method="post">
	<p>To: <input type="text" name="receiver" maxlength="30" size="30"></p>
	<p>Title: <input type="text" name="title" maxlength="100" size="100"></p>
	<p>Content: <input type="text" name="content" maxlength="500" size="100"></p>
	<input type="submit" name="submit" value="Post">
</form>
