<?php include ('includes/connect.php'); ?>
<?php include ('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container main">
        
        <div class="row">
            <div class="col-xs-8 text-center">
                
                <div class="poem">
                    <input type="text" class="poem-line" />
                </div>
                
                <form name="poem">
                    <input type="text" id="word" value="happy">
                    <input type="button" id="wordsearch" value="Go">
                </form>
                <div id="testajax"></div>      
            </div>
            <div class="col-xs-4 stats-sidebar">
                <?php 
                                      
                //$cmu_dict = CMUDict::get();
                //$phonemes1 = $cmu_dict->getPhonemes("carry");
                // echo $phonemes1;
                // echo "<pre>\n";
                // print_r($phonemes1);
                // echo "</pre>\n"; 
                
    $word = "Stardust";
                
    $query = "SELECT * FROM `words` WHERE `w_word` = '".$word."'";
    $result = db_query($query);
    
    if ($result === false) {
       echo "<p class='error'><strong>Database Error</strong>: ".mysqli_error ( $connection)."</p>\n";
        // Handle failure - log the error, notify administrator, etc.
    } else {
        // Fetch all the rows in an array
        //print_r($result);
        $rows = array();
        if ($result->num_rows == 0) {
            
            
            
        } else {
            
            while ($row = mysqli_fetch_assoc($result)) {
                
                echo "<pre>\n";
                print_r($row);
                
                $pronounce = $row['w_pronounce'];
                $syllables = explode(" ", $pronounce);
                
                print_r($syllables);
                
                $syllable_count = 0;
                for ($i = 0; $i < count($syllables); $i++) {
                    $lastletter = substr($syllables[$i], -1);
                    if (preg_match('/^[0-9]+$/', $lastletter)) {
                      // contains only 0-9
                      $syllable_count++;
                      echo "<strong>".$syllables[$i]."</strong>";
                    } else {
                      // contains other stuff
                    }
                }
                echo "<p><span class='word'>".$word."</span></p>\n";
                echo "<p>There are ".$syllable_count." syllables.</p>\n";
                
                echo "</pre>\n";
                
                $last_vowel = count($syllables)-1;
                $total_letters = 0;
                echo "hi: ".$syllables[$last_vowel];
                while (strlen($syllables[$last_vowel]) == 1) {
                    $total_letters += 2;
                    $last_vowel --;
                }
                $total_letters += strlen($syllables[$last_vowel]);
                echo "<strong>".$last_vowel." // ".$total_letters."</strong>\n";
                echo "<p>we should search for: ".substr($row['w_pronounce'],($total_letters*-1))."</p>\n";
                
            }
            
        }
    }
                    
                ?>
            </div>            
        </div>
        <!-- /.row -->
    
    </div>
    <!-- /.container -->

<?php include ('includes/footer.php'); ?>