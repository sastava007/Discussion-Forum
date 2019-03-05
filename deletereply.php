<?php
session_start();
include('content_function.php');
include('dbconn.php');
$rid=$_GET['rid'];
$id=$_GET['uid'];
$cid=intval($_GET['cid']);
$scid=intval($_GET['scid']);
$tid=intval($_GET['tid']);
$username=$_SESSION['username'];
$query=mysqli_query($con,"SELECT ID FROM users where username='".$username."' ");
$row=mysqli_fetch_assoc($query);
$uid=$row['ID'];
$admin_id=6;
$query2=mysqli_query($con,"DELETE FROM replies WHERE reply_id='".$rid."' AND ".$id." =".$uid." OR ".$id."= ".$admin_id." ");
header('Location: readtopic.php?cid='.$cid.'&scid='.$scid.'&tid='.$tid.'');

?>
