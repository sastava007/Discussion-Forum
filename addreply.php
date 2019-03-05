<?php
	session_start();
	
	include ('dbconn.php');
	
	$comment = nl2br(addslashes($_POST['comment']));
	$cid = $_GET['cid'];
	$scid = $_GET['scid'];
	$tid = $_GET['tid'];
	
	$insert = mysqli_query($con, "INSERT INTO replies (`category_id`, `subcategory_id`, `topic_id`, `author`, `comment`, `date_posted`)
								  VALUES ('".$cid."', '".$scid."', '".$tid."', '".$_SESSION['username']."', '".$comment."', NOW());");

	/*$query=mysqli_query($con,"SELECT MAX(reply_id) FROM replies");
	$row=mysqli_fetch_assoc($query);
	$row=intval($row['reply_id']);
	$insert2=mysqli_query($con,"INSERT INTO log_table (`reply_id`,`id`) VALUES ('".$row."','1')");*/
								  
	if ($insert)
	{
		header("Location: readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."");
	}
?>