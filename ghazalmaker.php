<?php include ('includes/connect.php'); ?>
<?php include ('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container main">
        
        <div class="row">
            <div class="col-xs-8">
                
				<h4>Ghazal Creator</h4>
								
                <div id="poem" class="poem" data-num-lines="10" data-num-couplets="5">
				
					<div class="poem-authorship">
						<input type="text" id="poem-title" placeholder="My Poem Title"></input>
						by <input type="text" id="poem-author" placeholder="Author's Name"></input>
					</div>
					<hr>
					
					<div id="couplets">
						<div class="couplet" id="couplet-1" data-couplet-no="1">
							<div class="poem-line" id="line-1" data-line-no="1" data-toggle="tooltip" data-line-syllables="0" title="0">
								<input type="text" id="poem-line-1" class="line-odd poem-line-free poem-line-first" data-block-syllables="0" />
								<input type="text" id="rhyme" class="poem-line-rhyme" data-block-syllables="0" />
								<input type="text" id="repeat" class="poem-line-repeat" data-block-syllables="0" />
							</div>
							<div class="poem-line" id="line-2" data-line-no="2" data-toggle="tooltip" data-line-syllables="0" title="0"> 
								<input type="text" class="line-even poem-line-free" title="0" data-block-syllables="0" />
								<input type="text" class="poem-line-rhyme" data-block-syllables="0" />
								<input disabled type="text" class="poem-line-repeat" data-block-syllables="0" />
							</div>
						</div>
						
						<div class="couplet" id="couplet-2" data-couplet-no="2">
							<div class="poem-line" id="line-3" data-line-no="3" data-toggle="tooltip" data-line-syllables="0" title="0"> 
								<input type="text" class="line-odd poem-line-free" title="0" data-block-syllables="0" />
							</div>
							<div class="poem-line" id="line-4" data-line-no="4" data-toggle="tooltip" data-line-syllables="0" title="0">
								<input type="text" class="line-even poem-line-free" title="0" data-block-syllables="0" />
								<input type="text" class="poem-line-rhyme" data-block-syllables="0" />
								<input disabled type="text" class="poem-line-repeat" data-block-syllables="0" />
							</div>
						</div>
						
						<div class="couplet" id="couplet-3" data-couplet-no="3">
							<div class="poem-line" id="line-5" data-line-no="5" data-toggle="tooltip" data-line-syllables="0" title="0"> 					
								<input type="text" class="line-odd poem-line-free" title="0" data-block-syllables="0" />
							</div>
							<div class="poem-line" id="line-6" data-line-no="6" data-toggle="tooltip" data-line-syllables="0" title="0">
								<input type="text" class="line-even poem-line-free" title="0" data-block-syllables="0" />
								<input type="text" class="poem-line-rhyme" data-block-syllables="0" />
								<input disabled type="text" class="poem-line-repeat" data-block-syllables="0" />
							</div>
						</div>
						
						<div class="couplet" id="couplet-4" data-couplet-no="4">
							<div class="poem-line" id="line-7" data-line-no="7" data-toggle="tooltip" data-line-syllables="0" title="0"> 					
								<input type="text" class="line-odd poem-line-free" title="0" data-block-syllables="0" />
							</div>
							<div class="poem-line" id="line-8" data-line-no="8" data-toggle="tooltip" data-line-syllables="0" title="0">
								<input type="text" class="line-even poem-line-free" title="0" data-block-syllables="0" />
								<input type="text" class="poem-line-rhyme" data-block-syllables="0" />
								<input disabled type="text" class="poem-line-repeat" data-block-syllables="0" />
							</div>
						</div>
						
						<div class="couplet" id="couplet-5" data-couplet-no="5">
							<div class="poem-line" id="line-9" data-line-no="9" data-toggle="tooltip" data-line-syllables="0" title="0"> 					
								<input type="text" class="line-odd poem-line-free" title="0" data-block-syllables="0" />
							</div>
							<div class="poem-line" id="line-10" data-line-no="10" data-toggle="tooltip" data-line-syllables="0" title="0">
								<input type="text" class="line-even poem-line-free" title="0" data-block-syllables="0" />
								<input type="text" class="poem-line-rhyme" data-block-syllables="0" />
								<input disabled type="text" class="poem-line-repeat" data-block-syllables="0" />
							</div>
						</div>
					</div>
					
                </div>
				
				<div id="couplet-template" style="display:none">
					
					<div class="couplet" id="couplet-" data-couplet-no="">						
						<div class="poem-line" id="line-" data-line-no="" data-toggle="tooltip" data-line-syllables="0" title="0"> 					
							<input type="text" class="line-odd poem-line-free" title="0" data-block-syllables="0" />
						</div>
						<div class="poem-line" id="line-" data-line-no="" data-toggle="tooltip" data-line-syllables="0" title="0">
		                    <input type="text" class="line-even poem-line-free" title="0" data-block-syllables="0" />
    	                    <input type="text" class="poem-line-rhyme" data-block-syllables="0" />
							<input disabled type="text" class="poem-line-repeat" data-block-syllables="0" />
						</div>
					</div>
					
				</div>
				
				<input type="button" id="btn-add-couplet" value="Add Couplet" />
				<input type="button" id="btn-generate" value="Generate Finished Poem" />
                
                <div id="testajax"></div>      
            </div>
            <div id="sidebar" class="col-xs-4 stats-sidebar">
				<h4 class="rhyme-title">Rhyming Suggestions</h4>
				<div class="rhyme-suggestions">
					<div id="rhyme-placeholder"><p>Enter <strong>a single word</strong> into the "Rhyme" box in the first line to receive an auto-generated list of rhymes (if they are available).</p></div>
    	            <ul id="sidebar-list"></ul>
				</div>
            </div>            
        </div>
        <!-- /.row -->
		
		<hr>
		
		<div class="row col-md-6 example">
			<div class="ghazal-example">
				<h4 class="ghazal-title">Ghazal</h4>
				<p class="ghazal-author">BY AGHA SHAHID ALI</p>
				<blockquote class="ghazal-quote">Feel the patient’s heart<br>
				Pounding—oh please, this once—<br>
				—JAMES MERRILL</blockquote>
				
				<p>I’ll do what I must if I’m <span class="ghazal-rhyme">bold</span> <span class="ghazal-repeat">in real time</span>.<br>   
				A refugee, I’ll be <span class="ghazal-rhyme">paroled</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>Cool evidence clawed off like shirts of hell-fire?<br>
				A former existence <span class="ghazal-rhyme">untold</span> <span class="ghazal-repeat">in real time</span> ...</p>
				
				<p>The one you would choose: Were you led then by him?<br>
				What longing, O Yaar, is <span class="ghazal-rhyme">controlled</span> <span class="ghazal-repeat">in real time</span>?</p>
				
				<p>Each syllable sucked under waves of our earth—<br>
				The funeral love comes to <span class="ghazal-rhyme">hold</span> <span class="ghazal-repeat">in real time</span>!</p>
				
				<p>They left him alive so that he could be lonely—<br>
				The god of small things is not <span class="ghazal-rhyme">consoled</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>Please afterwards empty my pockets of keys—<br>
				It’s hell in the city of <span class="ghazal-rhyme">gold</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>God’s angels again are—for Satan!—forlorn.<br>
				Salvation was bought but sin <span class="ghazal-rhyme">sold</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>And who is the terrorist, who the victim?<br>
				We’ll know if the country is <span class="ghazal-rhyme">polled</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>“Behind a door marked DANGER” are being unwound<br>
				the prayers my friend had <span class="ghazal-rhyme">enscrolled</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>The throat of the rearview and sliding down it<br>
				the Street of Farewell’s now <span class="ghazal-rhyme">unrolled</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>I heard the incessant dissolving of silk—<br>
				I felt my heart growing so <span class="ghazal-rhyme">old</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p>Her heart must be ash where her body lies burned.<br>
				What hope lets your hands rake the <span class="ghazal-rhyme">cold</span> <span class="ghazal-repeat">in real time</span>?</p>
				
				<p>Now Friend, the Belovèd has stolen your words—<br>
				Read slowly: The plot will <span class="ghazal-rhyme">unfold</span> <span class="ghazal-repeat">in real time</span>.</p>
				
				<p class="ghazal-attribution">(for Daniel Hall)</p>
			</div>
		</div>
		
		<div class="col-md-6">
			<div id="my-ghazal">
				<div class="ghazal-example">
					<h4 class="ghazal-title"></h4>
					<p class="ghazal-author"></p>
					<div id="poem-text">
					</div>
				</div>
			</div>
			<hr>
			<div id="save" class="form-group">
				<div id="ajax-reply"></div>
				<h4>Save your poem</h4>
				<p>Please enter your email address below, which will be used to store and retrieve your poem later. (We will not email you!)</p>
				<label class="control-label" for="poem-email">Email Address (Required)</label>
				<input type="text" id="poem-email" class="form-control" placeholder="Please enter your email address" /><br>
				<input type="submit" id="save-poem" class="btn btn-primary" value="Save Poem" />
			</div>
				
		</div>
    
    </div>
    <!-- /.container -->

<?php include ('includes/footer.php'); ?>