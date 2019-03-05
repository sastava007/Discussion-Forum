<?php
$rid=$_GET['rid'];
$id=$_GET['uid'];
$cid=intval($_GET['cid']);
$scid=intval($_GET['scid']);
$tid=intval($_GET['tid']);

include('content_function.php');
add_upvote($rid,$id);
/*include ('dbconn.php');
$i=$i+1;
if($i%2==0)
{
	$query2=mysqli_query($con,"UPDATE users SET rating=rating+1 WHERE ID=".$id."");
	$query=mysqli_query($con,"UPDATE replies SET upvote=upvote+1 WHERE reply_id=".$rid." ");
}
else
{
	$query2=mysqli_query($con,"UPDATE users SET rating=rating WHERE ID=".$id."");
	$query=mysqli_query($con,"UPDATE replies SET upvote=upvote+1 WHERE reply_id=".$rid." ");
}

if($query)
if($query2)*/

header('Location: readtopic.php?cid='.$cid.'&scid='.$scid.'&tid='.$tid.'');

?>