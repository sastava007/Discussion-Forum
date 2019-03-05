<?php
	include ('content_function.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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
<br><br>
<img src="banner1.jpg" width="100%" style="border-radius: 1vw;">
<br><br><br><br>
		<?php
		    
			if (isset($_SESSION['username']))
			{

				echo"<button class='new_ques'><a href='newtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'><i class='fa fa-pencil-square-o' style='font-size:22px;color:white'></i> Ask Question</a></button>";	
				echo"<br><br><br>";
			}
			
		?>

<div class="container1">
	<div class="container2">
		<div style="font-family: 'Ubuntu'; font-size: 3vw;text-align: center;font-style: italic;font-weight: bold;color: green">
			Categories<br>
		</div><br>
	<?php dispcategories(); ?>
	</div>

		
		<div class="container3" style="height: relative;">
			<div class="topics">
				<?php disptopics($_GET['cid'], $_GET['scid']); ?>
			</div>
		</div>
</div>
</body>
</html>
