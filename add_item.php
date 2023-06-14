<?php

	include_once 'database.php';

	if(isset($_POST['submit'])) {
    	$new_item = $_POST["input_value"];
    	$insert_sql = "INSERT INTO items (id, choice, score) VALUES (NULL, '$new_item', '10');";
    	if (!mysqli_query($conn, $insert_sql)) {
		echo "Error: " . $insert_sql . " f " . mysqli_error($conn);
	 	}
	 	mysqli_close($conn);
	}
	header("Location: /index.php");
	exit();

?>