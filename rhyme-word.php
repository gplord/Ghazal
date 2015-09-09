<?php
	
// Global toggle of verbose output of syllable counting algorithm		
$verbose = false;

$word = "quixotic";

include ('includes/connect.php');
include('functions.php');
	
	if (isset($_POST['word']) && $_POST['word'] != null) {
		$word = $_POST['word'];
	}
	
	$query = "SELECT * FROM `words2` WHERE `w_word` = '".$word."'";
    $result = db_query($query);
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		$pronounce = $row['w_pronounce'];
	    $phonemes = explode(" ", $pronounce);		
	    
	    if ($verbose) echo "<p><span class='word'>".$word."</span></p>\n";
	    if ($verbose) echo "<p>" . implode(" &bull; ", $phonemes) . "</p>\n";
		
		//echo $row['w_syllables']. " syllables.";	    
		
		$vowels_to_match = ($row['w_syllables'] > 2) ? 2 : 1;
		if ($row['w_syllables'] > 3) $vowels_to_match = 3;
		
		// RULE 1
		// this is a tricky one.  words that end in unstressed vowels (eg "h A* pp y") seem to need another vowel.
		// contrast this with "agree"
		// [TO-DO] This needs a total reworking, where we count backwards until we hit the highest accented vowel...
		if ( 
			($row['w_syllables'] > 1) && 
			(preg_match('/0/', substr($phonemes[(count($phonemes)-1)], -1)))
			) {
				
			$vowels_to_match ++;
			echo "<p>Using the final-syllable-is-a-vowel rule!</p>\n";
			
		}
		
		$phonemes_to_match = 0;
					
		if ($verbose) echo "<p>I'm looking for " . $vowels_to_match . " vowels to match.\n";
		
		//while ($vowels_to_match) {
	    for ($i = (count($phonemes)-1); $i >= 0; $i--) {
			
			if ($vowels_to_match == 0) break;
			
	        $lastletter = substr($phonemes[$i], -1);
	        if (preg_match('/^[0-9]+$/', $lastletter)) {	// vowels are marked with numerals to indicate emphasis -- if this matches, it's a vowel
			  
				$vowels_to_match--;
				
				// RULE 2
				// this is another tricky one.  if we've hit the stressed vowel earlier than the rules above, end the match here
				if (preg_match('/1/',$lastletter)) $vowels_to_match = 0;
				
	        } else {
			  
	        }
			// Whether this was a vowel or not, we need to match this phoneme
			$phonemes_to_match++;
			
	    }			
			
	    if ($verbose) echo "<p>There are ".$row['w_syllables']." syllables.</p>\n";
		if ($verbose) echo "<p>There are " . $phonemes_to_match . " phonemes to match.";		
		
		$start_phoneme = count($phonemes) - $phonemes_to_match;
		
		$rhyme_match_array = array();
		
		for ($i = $start_phoneme; $i < count($phonemes); $i++) {
			$rhyme_match_array[] = $phonemes[$i];
		}
		$rhyme_match_string = implode(" ", $rhyme_match_array);
		
		if ($verbose) echo "We need to match on ".$rhyme_match_string;
		
		$query = "SELECT * FROM `words2` WHERE `w_pronounce` LIKE '%".$rhyme_match_string."'";// AND `w_syllables` = ".$row['w_syllables'];
	    $subresult = db_query($query);
		
		if ($verbose) echo "<p>There are " . $subresult->num_rows . " results.</p>\n";
						
        if ($subresult->num_rows > 1) {
			
			// DROPDOWN
			//echo "<select name='rhyme-matches'>\n";
			
			while ($subrow = mysqli_fetch_assoc($subresult)) {
				if (!preg_match('/\)/', substr($subrow['w_word'], -1))) {	// Filter out duplicates, which are notated in the dictionary with "(1)", etc, at the end
					if ($subrow['w_word'] != $row['w_word']) {
						// DROPDOWN
						//echo "<option value='" . $subrow['w_word'] . "'>" . $subrow['w_word'] . "</option>";
						$final_words[] = $subrow['w_word'];
					}
				}
			}		
			
			// DROPDOWN
			//echo "</select>\n";

		} else {

			echo "<p><strong>No strong rhyme matches found.</strong></p>\n";
			
			// RULE 3
			// Weaker rhymes -- this is basically trimming off the first phoneme we needed, trying to find matches at one fewer
			// Ex. "Antipathy" has no matches -- looking for "I*pathy" -- so then it tries just "pathy", and returns "apathy, empathy" etc
			// [TO-DO] We *could* make this recursive, trying again and again until we get something, trimming the leading phoneme each time
			// Would that actually make for better rhymes?
			
			//-----------------------------------------------------
			
			$rhyme_match_array = array();
			for ($i = $start_phoneme+1; $i < count($phonemes); $i++) {
				$rhyme_match_array[] = $phonemes[$i];
			}
			$rhyme_match_string = implode(" ", $rhyme_match_array);
			
			echo "We need to match on ".$rhyme_match_string;
			
			$query = "SELECT * FROM `words2` WHERE `w_pronounce` LIKE '%".$rhyme_match_string."'";// AND `w_syllables` = ".$row['w_syllables'];
		    $subsubresult = db_query($query);
			
			echo "there are " . $subsubresult->num_rows . " results";
							
			$final_words = array();
							
	        if ($subsubresult->num_rows > 1) {
				
				// [TO-DO] Make an option to generate this as a dropdown list!
				// DROPDOWN
				//echo "<select name='rhyme-matches'>\n";
				
				while ($subsubrow = mysqli_fetch_assoc($subsubresult)) {
					if (!preg_match('/\)/', substr($subsubrow['w_word'], -1))) {	// Filter out duplicates, which are notated in the dictionary with "(1)", etc, at the end
						if ($subsubrow['w_word'] != $row['w_word']) {
							// DROPDOWN
							//echo "<option value='" . $subsubrow['w_word'] . "'>" . $subsubrow['w_word'] . "</option>";
							$final_words[] = $subsubrow['w_word'];
						}
					}
				}		
				
				// DROPDOWN
				//echo "</select>\n";
	
			} else {
	
				echo "<strong>No weaker rhyme matches found.</strong>";
	
			}
			
			//=====================================================

		}
                
	}
	
	/*
	echo "<pre>\n";
	print_r($final_words);
	echo "</pre>\n";
	*/
	
	$json = json_encode($final_words);
	echo $json;
	
?>