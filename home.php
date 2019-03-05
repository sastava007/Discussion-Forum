<?php
	include ('content_function.php');
	session_start();
?>

<!-- HTML PART -->
<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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
<br><br>
<img src="aasf_banner.jpeg" style="width: 100%; height: 25vw; border-radius: 1vw;">;
<br>

<br><br><br><br>
<div class="container1">
	<div class="container2">
		<div style="font-family: 'Ubuntu'; font-size: 3vw; padding-left: 2vw; font-weight: bold;color: green">
			Categories<br>
		</div><br>
	<?php dispcategories(); ?>
<br><br>
	<div style="font-family: 'Ubuntu'; font-size: 2vw;font-weight: bold;color: black;padding-left: 2vw;">
			Leaderboard</div><br>
			<div style="background-color: #e9164b; color:white;font-family:'Ubuntu';font-size: 16px; padding:1vw;padding-left: 0vw; border-radius: 0.8vw;width: 15vw;">
					<?php leaderboard(); ?>
			</div>
</div>

<div class="container3">
	<div style="font-family:'Ubuntu'; font-size: 5vw;text-align: center;font-weight: bold;color: green">
			Trending Topics<br>
		</div><br>
	<?php dispfeed(); ?>
</div>

</div>
<br><br>

</body>
</html>