<?php
if (s()){
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
if ($_POST['post'] == "bewerk")
{
	$post = $_POST['id'];
	require(getenv("DOCUMENT_ROOT")."/functions/database.php");
	try{	
		$stmt = $db->prepare("SELECT * FROM posts Where id = :naam");
		$stmt->execute(array(':naam' => $post,));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt2 = $db->prepare("SELECT * FROM shc Where id = :naam");
		$stmt2->execute(array(':naam' => $result[shc],));
		$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
		$stmt3 = $db->prepare("SELECT * FROM hc Where id = :naam");
		$stmt3->execute(array(':naam' => $result2[hc],));
		$result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
	?>
<script type="text/javascript" src="//<?php echo $_SERVER['SERVER_NAME']?>/template/boot/js/s/nieuw.php.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var post = '<?php echo html_entity_decode($result['info']);?>'
	$('#summernote').summernote('code', post);
	var select_shc, $select_shc;
	$select_shc = $('#shc').selectize({
	});
	select_shc  = $select_shc[0].selectize;
	select_shc.enable();
});	
</script>	
<div class="alert alert-success text-center">
	<strong>Bewerk Post debug: <?php echo $result2[hc] ." - ". $result['shc'] ?> </strong>
</div>
	<div class="span12">
		<h2>POST DATA</h2>
		<pre>
			<?php print_r($_POST); ?>
		</pre>
	</div>
			<div class="summernote container">
					<div class="row">
				<form class="form-horizontal" id="postForm" action="" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="post" value="bewerk">
				<input type="hidden" name="id" value="<?php echo $post ?>">
			<div class="form-group">
				<label class="control-label col-sm-2" for="info">Titel van post</label>
				<div class="col-sm-10">
				<input type="text" name="naam" value="<?php echo $result['naam'] ?>" placeholder='Titel van Post' class="form-control" id="naam">
				</div>
			</div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="hc">Hoofd Category</label>
    <div class="col-sm-10">
      <select id="hc"  placeholder="Hoofd Category" name='hc'>
								<option value="<?php echo $result3['id'] ?>"><?php echo $result3['naam'] ?></option>
							</select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="shc">Sub Category:</label>
    <div class="col-sm-10"> 
      <select id="shc"  placeholder="Sub Category" name='shc'>
								<option value="<?php echo $result2['id'] ?>"><?php echo $result2['naam'] ?></option>
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
}//end Try
	catch(Exception $e) {
		echo '<h2><font color=red>';
		var_dump($e->getMessage());
		die ('</h2></font> ');
	}//end try
}
else
{
echo "Direct acces gaat niet , ga via een post om die te bewerken";
}
}	
?>	