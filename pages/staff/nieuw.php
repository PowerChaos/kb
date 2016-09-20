<?php
if (s()){
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
?>
<script type="text/javascript" src="//<?php echo $_SERVER['SERVER_NAME']?>/template/boot/js/dropdown.js"></script>
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
				<form class="form-horizontal" id="postForm" action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="hc">Hoofd Category</label>
    <div class="col-sm-10">
      <select id="hc" class="demo-default" placeholder="HoofdCategory" name='hc'>
								<option value="">HoofdCategory</option>
							</select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="shc">Sub Category:</label>
    <div class="col-sm-10"> 
      <select id="shc" class="demo-default" placeholder="SubCategory" name='shc'>
								<option value="">SubCategory</option>
							</select>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-12">
	<textarea class="input-block-level" id="summernote" name="content" rows="18">
	</textarea>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

				</div>
			</div>

<?
}//end try
?>	