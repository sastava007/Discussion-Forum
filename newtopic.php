<?php
	include ('content_function.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" type="text/css" href="newtopic.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    			<button><a href="Logout.php">LOGOUT</a></button>
			</nav>
		</div>
	</nav>
<br><br><br>
<img src="banner2.png" width="100%" height="279vw" style="border-radius: 1vw;"><br>
		
				<div class="addnew_topic">
				<?php 
					if (isset($_SESSION['username']))
					{
						echo "<form action='addnewtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'
							  method='POST'>
							  <center><img src='ques.png' height='90vw' width='90vw'></center>
							  <p>Title: </p>
							  <input type='text' id='topic' name='topic' placeholder='Add Title' required>
							  <p>Description: </p>
							  <textarea id='content' name='content'></textarea><br><br><br>
							  <input type='submit' value='Add Question' id='submit' placeholder='Describe your question' required>
							  </form>";
					}
					else
					{
						echo "<p>Please Login First or <a href='Registration.html'>click here</a> to register.</p>";
					}
				?>

				</div>
</body>
</html>