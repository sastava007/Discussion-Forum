<?php
	session_start();
	include ('content_function.php');
	addview($_GET['cid'], $_GET['scid'], $_GET['tid']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="home.css">
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
<img src="banner3.png" width="100%" height="300vw" style="border-radius: 1vw;">
<br><br><br>
<div class="container1">
	<div class="container4">
		<div style="font-family: 'Ubuntu'; font-size: 3vw;padding-left:1vw; font-style: italic;font-weight: bold;color: green">
			Categories<br>
		</div><br>	
		<?php dispcategories(); ?>
	</div>
	<div class="container3" style="height: relative;">
		<?php
			disptopic($_GET['cid'], $_GET['scid'], $_GET['tid']);
			//echo "<div class='content'><p>All Replies (".countReplies($_GET['cid'], $_GET['scid'], $_GET['tid']).")
				  //</p></div>";
			dispreplies($_GET['cid'], $_GET['scid'], $_GET['tid']);
		?>
        <br><br>
		<?php
				replytopost($_GET['cid'], $_GET['scid'], $_GET['tid']);
		?>

	</div>
</div>
	
</body>
</html>