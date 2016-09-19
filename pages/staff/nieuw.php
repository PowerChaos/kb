<?php
if (s()){
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
?>
			<div class="summernote container">
				<div class="row">
					<div class="span12">
						<h2>POST DATA</h2>
						<pre>
							<?php print_r($_POST); ?>
						</pre>
						<pre>
							<?php echo htmlspecialchars($_POST['content']); ?>
						</pre>
					</div>
				</div>
				<div class="row">
					<form class="span12" id="postForm" action="" method="POST" enctype="multipart/form-data">
						<div class="control-group">
							<select id="hc" class="demo-default" placeholder="Type your name..." name='hc'>
								<option value="">Type your name ...</option>
							</select>
						</div>
						<fieldset>
							<legend>Make Post</legend>
							<p class="container">
								<textarea class="input-block-level" id="summernote" name="content" rows="18">
								</textarea>
							</p>
						</fieldset>
						<button type="submit" class="btn btn-primary">Save changes</button>
						<button type="button" id="cancel" class="btn">Cancel</button>
					</form>
				</div>
			</div>

<?
}//end try
?>	