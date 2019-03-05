<?php
session_start();
$conn=mysqli_connect("localhost","root","","mydb");
if(!$conn)
	echo "<script>window.alert('Connection Faliled');</script>";
mysqli_connect_error();

$username=$_SESSION['username'];
$sql="SELECT * FROM users WHERE username='$username'";
$result=mysqli_query($conn,$sql) or die("Your query is not correct");
$row=mysqli_fetch_array($result);
$image=$row['image'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="Profile.css"/>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
<title>Profile</title>
</head>
<body>
	<nav>
		<div class="nav_container">
			<nav>
				<a href="home.php"><img src="Logo1.png" id="logo1"></a>
				<button><a href="home.php">HOME</a></button>
				<button><a href="http://www.aasf.in">AASF</a></button>
				<button><a href="Profile.php">PROFILE</a></button>
    			<button><a href="our_team.html">OUR TEAM</a></button>
    			<button><a href="logout.php">LOGOUT</a></button>
			</nav>
		</div>
	</nav>

	<div class="profile">
		<h1>Profile Details</h1><br><br>
		<center><img src="<?php echo '/PHP/Discussion-Forum-Backened/uploads/'.$row['image'];?>" height="150vw" width="150vw" style="border-radius: 50%;"></center>
		<input type="text" readonly value=" Name:  <?php echo $row['name'];?>"/><br>
		<input type="text" readonly name="username" value=" Username:  <?php echo $row['username'];?>"/><br>
		<input type="email" readonly name="email" value=" Email Id:  <?php echo $row['email'];?>"/><br>
		<input type="text" readonly name="phone" value=" Mobile:  <?php echo $row['phone'];?>"/>
		<br><br>
		<a href="changepassword.php"><button type="submit">Change Password</button></a>
	</div>
</body>
</html>