<?php
	
// Global toggle of verbose output of syllable counting algorithm		
$verbose = false;
$countsource = false;

include('functions.php');
include ('includes/connect.php');

if (isset($_POST['line']) && $_POST['line'] != null) {
	$line = $_POST['line'];
} else {
	die("ERROR");
}

echo count_line($line);
	
?>