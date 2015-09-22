<?php

include('functions.php');
include ('includes/connect.php');

if (isset($_POST['poemdata']['poem_email']) && ($_POST['poemdata']['poem_email'] != null)) {
	
	$insert_query = "INSERT INTO `poems` (`poem_email`, `poem_author`, `poem_title`, `poem_text`)
	VALUES (?, ?, ?, ?)";
	if ($stmt = $connection->prepare($insert_query)) {
		$stmt->bind_param("ssss", $_POST['poemdata']['poem_email'],$_POST['poemdata']['poem_author'],$_POST['poemdata']['poem_title'], trim($_POST['poemdata']['poem_text']));
		$stmt->execute();
	}	
	
	if (mysqli_affected_rows($connection)) {
		print (mysqli_affected_rows($connection));
	}
	
} else {
	die("This page cannot be accessed directly.");
}
	
?>