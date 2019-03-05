<?php 
	$con = mysqli_connect("localhost", "root", "", "test_upload");
	if (mysqli_connect_errno($con)) {
		echo "Failed to connect to the database".mysqli_connect_error($con);
	}
?>