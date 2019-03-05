<?php
$conn=mysqli_connect("localhost","root","");
if(!$conn)
	echo "<script>window.alert('Connection Faliled');</script>";
mysqli_connect_error();


/*Create database*/
$error="";
$sql="CREATE DATABASE mydb";
if(!mysqli_connect("localhost","root","","mydb"))
	if(!mysqli_query($conn,$sql))
		echo "<script>window.alert('database creation failed');</script>";

/*Create table*/
$sql="CREATE TABLE users(
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name varchar(30),
username varchar(10),
email varchar(25),
password varchar(64),
phone varchar(10),
image varchar(100)
)";

if($conn)
$conn=mysqli_connect("localhost","root","","mydb");
mysqli_query($conn,$sql);
function err($n)
{
	$n=trim($n);
	$n=stripslashes($n);
	$n=htmlspecialchars($n);
	return $n;
}

/*Recieve data from the form*/
if (isset($_POST["submit"]))
{
 	$name1=err($_POST['name']);
 	$pass=err($_POST['pass1']);
 	$pass1=err($_POST['pass2']);
 	$usr=err($_POST['usr']);	
 	$email=err($_POST['email']);
 	$phone=err($_POST['phone']);
 	//$image=$_FILES['pic']['name'];
 	//$tmp_name = $_FILES['pic']['tmp_name'];
 	//echo $image;
 	//$image=$_POST['image'];

 	//$name = mysqli_real_escape_string($conn, $_POST['name']);
 	$file = $_FILES['image']['name'];
 	$tmp_file = $_FILES['image']['tmp_name'];
 	$uploadDir = '/uploads/';
 	$curDir = getcwd();									// Getting current working directory
	$uploadPath = $curDir.$uploadDir.basename($file);
	move_uploaded_file($tmp_file, $uploadPath);
	//echo $uploadPath;

 	$query = mysqli_query($conn,"SELECT username FROM users WHERE username='".$usr."' ");
	if (mysqli_num_rows($query) != 0)
	{	
	    $error="* Username already exist!";
	    /*exit('Username Already Exist');*/
	}
	else
	{
	  	if($pass!=$pass1)
 			echo "<script>window.alert('Check Password');</script>";
 		else
 		{
	 		//$img=$_FILES['pic']['usr'];
	 		$pass=hash('sha256', $_POST['pass1']);
	 		$sql="INSERT INTO users(name,username,password,phone,email,image) VALUES('$name1', '$usr', '$pass', '$phone','$email','$file')";
	 		
	 		if(!mysqli_query($conn,$sql))
	 			echo"<script>window.alert('insertion failed');</script>";
	 		else
 			{
 				header('Location: Welcome.php');
 				echo"<script>window.alert('Registration Successful');</script>";
 			}
	 	}
	}
}

?>


<!-- HTML PART STARTED -->
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" type="text/css" href="Registration.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
</head>
<body>
	<nav>
		<div class="nav_container">
			<nav>
				<a href="home.html"><img src="Logo1.png" id="logo1"></a>
    			<button><a href="Welcome.php">LOGIN</a></button>
			</nav>
		</div>
	</nav>

	<div class="registration_form">
		<img src="new_user1.png">
		<h1>Registration Form</h1>
		<form name="regform" method="post" action="Registration.php" enctype="multipart/form-data">
			<p>Name</p>
			<input type="text" name="name" id="Name" placeholder=" Enter Your Name" required>
			<p>Username</p>
			<input type="text" name="usr" id="username" placeholder=" Enter Username" required>
			<p>Email</p>
			<input type="email" name="email" id="email" placeholder="Enter Email Id" required>
			<p>Password</p>
			<input type="Password" name="pass1" id="password" placeholder="Enter Password" required>
			<p>Confirm Password</p>
			<input type="Password" name="pass2" id="confirm password" placeholder="Confirm Password" required>
			<p>Mobile Number</p>
			<input type="Number" name="phone" id="mobile number" placeholder="Enter Mobile No" required>
			<p>Upload Pic</p>
			<input type="file" name="image" accept="image/*" value="Choose File">
			<p style="font-size: 1.1vw; color:red;"> <?php echo $error; ?></p> 
			<br><br><br>
			<input type="submit" name="submit" value="Sign Up" id="submit">
		</form>		
	</div>
</body>
</html>
