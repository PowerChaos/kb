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
				<form class="form-horizontal" id="postForm" action="../invoer" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="nieuw" value="nieuw">
			<div class="form-group">
				<label class="control-label col-sm-2" for="info">Titel van post</label>
				<div class="col-sm-10">
				<input type="text" name="naam" value="" placeholder='Titel van Post' class="form-control" id="naam">
				</div>
			</div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="hc">Hoofd Category</label>
    <div class="col-sm-10">
      <select id="hc"  placeholder="Hoofd Category" name='hc'>
								<option value="">HoofdCategory</option>
							</select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="shc">Sub Category:</label>
    <div class="col-sm-10"> 
      <select id="shc"  placeholder="Sub Category" name='shc'>
								<option value="">SubCategory</option>
							</select>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-12">
	<textarea class="input-block-level" id="summernote" name="info" rows="18">
	</textarea>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-12">
      <button type="submit" id="submit" value="Submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

				</div>
			</div>

<?
}//end try
?>	