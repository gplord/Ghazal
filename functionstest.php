<?php
	
// Global toggle of verbose output of syllable counting algorithm		
$verbose = false;
$countsource = false;

// $_GET override for verbose output, overrides global setting above via URL 
if (isset($_GET['verbose'])) {
	$verbose = $_GET['verbose'];
}
if (isset($_GET['countsource'])) {
	$countsource = $_GET['countsource'];
}


$word = "Stardust";
$line = "The quick brown fox jumps over the lazy dog";

include('functions.php');
include ('includes/connect.php');

echo "<h3>".$word."</h3>\n";
echo "<hr>\n";
echo "<p>".count_word($word)."</p>\n";

echo "<h3>".$line."</h3>\n";
echo "<hr>\n";
echo "<p>".count_line($line)."</p>\n";
	
?>