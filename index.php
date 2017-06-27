<?php   session_start();  
if ($_SESSION['use'] == 'admin' && !isset($_COOKIE['flag'])){
       setcookie('flag','w3lc0m3_t0_th3_fl4g');
}
if ($_SESSION['use'] != 'admin'){
	setcookie('flag', '', time() - 3600);
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<a href="index.php?page=home.php">Home</a>
<a href="index.php?page=login.php">Login</a>
<a href="index.php?page=register.php">Register</a>
<a href="index.php?page=sendmessage.php">Send Messages</a>
<a href="index.php?page=receivemessage.php">Receive Messages</a>

<?php 
		if ($_SESSION['use'] == 'admin'){
			echo '<a href="index.php?page=manage.php">Manage Messages</a>';
		}
		$servername = "localhost";
		$username = "user3";
		$password = "nghia123";
		$database = "";

		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
		}

		$sql = "CREATE DATABASE IF NOT EXISTS db_xss;";
		if ($conn->query($sql) !== TRUE) {   
		    echo "Error creating database: " . $conn->error;
		}

		$conn->query("USE db_xss;");
		$sql = "CREATE TABLE IF NOT EXISTS User(username VARCHAR(100) NOT NULL PRIMARY KEY, password VARCHAR(100) NOT NULL);";
		if ($conn->query($sql) !== TRUE) {
		    echo "Error creating table: " . $conn->error;
		}
		$sql = "CREATE TABLE IF NOT EXISTS Message(id INT primary key auto_increment,title varchar(100) not null, author varchar(100) not null, content varchar(500) not null, receiver varchar(100) not null, foreign key (author) references User(username), foreign key (receiver) references User(username));
";
		if ($conn->query($sql) !== TRUE) {
		    echo "Error creating table: " . $conn->error;
		}
		$conn->close();
 ?>
<?php 
	if(isset($_SESSION['use'])){
		echo "<a href='index.php?page=logout.php'> Logout</a> "; 
		echo "<h1>WELCOME TO THE PAGE</h1>";
		echo "<h2> Hello " . $_SESSION['use'] ."</h2>";
		
	}
	else{
		echo "<h1>WELCOME TO THE PAGE</h1>";
		echo "<p>You have to log in to use the message page</p>";
	}
?>

<?php
    $page = NULL;      
	$page = isset($page) ? $page : $_GET['page'];
	if (!empty($page) ){
		switch ($page) {
			case 'home.php': case 'login.php': case 'logout.php': case 'register.php': case 'sendmessage.php': case 'manage.php': case 'receivemessage.php': case 'getmessage.php':
				include($page);
				break;
			
			default:
				include("home.php");
				break;
		}
	}
	else{
		include("home.php");
	}
?>




</body>
</html>
