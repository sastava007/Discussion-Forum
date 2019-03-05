<?php

	include('content_function.php');
	session_start();
	addview($_GET['cid'], $_GET['scid'], $_GET['tid']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" type="text/css" href="home.css">
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

		<?php

	     // LOOK AFTER HERE WE HAVE FORCEFULLUY YSED "!" SIGN. FIND THE REASON WHY SESSION IS LOST
			if (isset($_SESSION['username']))
			{
				replytopost($_GET['cid'], $_GET['scid'], $_GET['tid']);
			}
		?>
		<div class="content">
			<?php disptopic($_GET['cid'], $_GET['scid'], $_GET['tid']); ?>
		</div>
</body>
</html>