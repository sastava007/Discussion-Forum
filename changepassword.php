<?php
	include('content_function.php');
	include('dbconn.php');
	session_start();

	if (isset($_POST["submit"]))
	{

	$pass=$_POST['pass'];
	$pass1=$_POST['pass1'];
	$pass2=$_POST['pass2'];
	$username=$_SESSION['username'];
	$pass =hash('sha256', $_POST['pass']);

	$query=mysqli_query($con,"SELECT username, password FROM users WHERE username = '".$username."' AND  password = '".$pass."' ");
	 if(mysqli_num_rows($query) > 0 )
	 {
	 	if($pass1=$pass2)
	 		{
	 			$pass1 =hash('sha256', $_POST['pass1']);
	 			$query1=mysqli_query($con,"UPDATE users SET password ='".$pass1."' WHERE username= '".$username."' ");
	 		}
	 		else
	 		{
	 			$error=" * Password didn't match!";
	 		}
	 	header('Location: Profile.php');
	 }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<style type="text/css">
		input{
		width: 60%;
		margin-bottom: 15px;
		font-family: "Ubuntu";
		font-size: 1.12vw;
	}

	input[type="password"]
	{
		border:none;
		height: 25px;
		border-radius: 0.8vw;
		border-bottom: 1px solid #fff;
		padding-left: 0.8rem;
	}
	input[type="submit"]{
		border:none;
		outline: none;
		height: 40px;
		background: #1e88e5;
		font-size:18px;
		font-weight: bold;
        border-radius: 18px;
	}
	input[type="submit"]:hover{
     cursor:pointer;
     background: #FCE302;
     color:#000;
	}
	#submit{
		padding-left: 2px;

	}
	</style>
</head>
<body>
	<nav>
		<div class="nav_container">
			<nav>
				<a href="home.php"><img src="Logo1.png" id="logo1"></a>
				<button><a href="home.php">HOME</a></button>
				<button><a href="#">DISQS</a></button>
				<button><a href="Profile.php">PROFILE</a></button>
    			<button><a href="our_team.html">OUR TEAM</a></button>
    			<button><a href="Logout.php">LOGOUT</a></button>
			</nav>
		</div>
	</nav>
	<br><br><br>
	<center><div style="color:white;font-size: 3vw;font-weight: bold;font-style: Ubuntu;">CHANGE PASSWORD</div></center><br>

	<center><div style="text-align:center;font-size:2vw;font-weight:bold;font-family:Ubuntu;color:white; background-color: #e9164b; width: 30vw;border-radius: 10%;height: 30vw;"><br><br>
		<form action="changepassword.php" method="POST">
			<p style="margin: 0;padding-top: 2px;font-weight: italic;">Current Password</p>
			<input type="Password" name="pass">
			<p style="margin: 0;padding-top: 2px;font-weight: italic;">New Password</p>
			<input type="Password" name="pass1">
			<p style="margin: 0;padding-top: 2px;font-weight: italic;">Comfirm Password</p>
			<input type="Password" name="pass2">
			<br><br>
			<input type="Submit" name="submit" value="Change" id="submit">
		</form>
	</div></center>
</body>
</html>
