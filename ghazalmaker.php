<?php include ('includes/connect.php'); ?>
<?php include ('includes/header.php'); ?>

    <!-- Page Content -->
    <div class="container main">
        
        <div class="row">
            <div class="col-xs-8">
                
                <div id="poem" class="poem" data-num-lines="10" data-num-couplets="5">
					
					<div class="couplet" id="couplet-1" data-couplet-no="1">
	                    <div class="poem-linez" id="line-1" data-line-no="1">
							<input type="text" id="poem-line-1" class="line-odd poem-line-first" data-line-no="1" data-toggle="tooltip" title="0" />
                        	<input type="text" id="rhyme" class="poem-line-rhyme" />
							<input type="text" id="repeat" class="poem-line-repeat" />
						</div>
						<div class="poem-linez" id="line-2" data-line-no="2"> 
		                    <input type="text" id="poem-line-2" class="line-even poem-line-free" data-line-no="2" data-toggle="tooltip" title="0" />
	                        <input type="text" id="rhyme" class="poem-line-rhyme" />
							<input disabled type="text" id="repeat" class="poem-line-repeat" />
						</div>
					</div>
					
					<div class="couplet" id="couplet-2" data-couplet-no="2">
						<div class="poem-linez" id="line-3" data-line-no="3"> 
							<input type="text" id="poem-line-3" class="line-odd poem-line-free" data-line-no="3" data-toggle="tooltip" title="0" />
						</div>
						<div class="poem-linez" id="line-4" data-line-no="4">
		                    <input type="text" id="poem-line-4" class="line-even poem-line" data-line-no="4" data-toggle="tooltip" title="0" />
    	                    <input type="text" class="poem-line-rhyme" />
							<input disabled type="text" class="poem-line-repeat" />
						</div>
					</div>
                    
                    <div class="couplet" id="couplet-3" data-couplet-no="3">					
						<input type="text" id="poem-line-5" class="line-odd poem-line" data-line-no="5" data-toggle="tooltip" title="0" />
	                    <input type="text" id="poem-line-6" class="line-even poem-line" data-line-no="6" data-toggle="tooltip" title="0" />
                        <input type="text" class="poem-line-rhyme" />
						<input disabled type="text" class="poem-line-repeat" />
					</div>
					
					<div class="couplet" id="couplet-4" data-couplet-no="4">					
						<input type="text" id="poem-line-7" class="line-odd poem-line" data-line-no="7" data-toggle="tooltip" title="0" />
	                    <input type="text" id="poem-line-8" class="line-even poem-line" data-line-no="8" data-toggle="tooltip" title="0" />
                        <input type="text" class="poem-line-rhyme" />
						<input disabled type="text" class="poem-line-repeat" />
					</div>
					
					<div class="couplet" id="couplet-5" data-couplet-no="5">					
						<input type="text" id="poem-line-9" class="line-odd poem-line" data-line-no="9" data-toggle="tooltip" title="0" />
	                    <input type="text" id="poem-line-10" class="line-even poem-line" data-line-no="10" data-toggle="tooltip" title="0" />
                        <input type="text" class="poem-line-rhyme" />
						<input disabled type="text" class="poem-line-repeat" />
					</div>
					
                </div>
				
				<div id="couplet-template" style="display:none">
					<div class="couplet" id="couplet-" data-couplet-no="">
	                    <input type="text" id="poem-line-" class="line-odd poem-line" data-line-no="" />
	                    <input type="text" id="poem-line-" class="line-even poem-line" data-line-no="" />
                        <input type="text" class="poem-line-rhyme" />
						<input disabled type="text" class="poem-line-repeat" />
					</div>
				</div>
				
				<input type="button" id="btn-add-couplet" value="Add Couplet" />
                
                <div id="testajax"></div>      
            </div>
            <div id="sidebar" class="col-xs-4 stats-sidebar">
                <ul id="sidebar-list"></ul>
            </div>            
        </div>
        <!-- /.row -->
    
    </div>
    <!-- /.container -->

<?php include ('includes/footer.php'); ?>