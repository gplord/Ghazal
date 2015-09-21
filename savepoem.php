<?php

include('functions.php');
include ('includes/connect.php');

// if (isset($_POST['line']) && $_POST['line'] != null) {
// 	$line = $_POST['line'];
// } else {
// 	die("ERROR");
// }
// 
// echo count_line($line);

// echo "<pre>\n";
// print_r($_POST);
// echo "</pre>\n";

// print_r($_POST);

if (isset($_POST['poemdata']['poem_email']) && ($_POST['poemdata']['poem_email'] != null)) {
	
	$insert_query = "INSERT INTO `poems` (`poem_email`, `poem_author`, `poem_title`, `poem_text`)
	VALUES (?, ?, ?, ?)";
	if ($stmt = $connection->prepare($insert_query)) {
		$stmt->bind_param("ssss", $_POST['poemdata']['poem_email'],$_POST['poemdata']['poem_author'],$_POST['poemdata']['poem_title'], trim($_POST['poemdata']['poem_text']));
		$stmt->execute();
	}	
		
	printf("Poem added: %d\n", mysqli_affected_rows($connection));
		
// 	$stmt->bind_param('s', $name);
// 
// $stmt->execute();
// 
// $result = $stmt->get_result();
// while ($row = $result->fetch_assoc()) {
//     // do something with $row
// }
	
	
} else {
	die("This page cannot be accessed directly.");
}
	
?>