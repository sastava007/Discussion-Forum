<?php  
session_start();
$id=$_GET['id'];
include('dbconn.php');
$query=mysqli_query($con,"UPDATE users SET verified=1 WHERE ID=".$id." ");
header('Location: admin.php');

?>