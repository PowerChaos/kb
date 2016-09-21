<?php
require(getenv("DOCUMENT_ROOT")."/functions/database.php");	
if ($_POST['bewerk'] == "delete")
{
	$id = $_POST['id'];
	try{
	$stmt = $db->prepare("DELETE FROM posts WHERE id =:id ORDER BY id");
	$stmt->execute(array(':id' => $id));
	}
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}	
$_SESSION[ERROR] = "Post ID $id successvol verwijderd";		
}
?>
<script>
	function werkbij(val,dat) {
		$.ajax({
			type: "POST",
			url: "../ajax/post.php",
			data:'bewerk='+dat+'&id='+val,
			success: function(data){
				//alert(dat+" Succesvol uitgevoerd");
				window.location.reload();
			}
		});
	}
</script>
<?php if ($_POST['groep'] == "verwijder")
{
?>
<table border=1 class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><center>verwijder Post <font color='red'>id <?php echo $_POST['waarde'];?></font></center></th>
		</tr>
	</thead>
	<tbody>	
		<tr class='info'>
			<td><center><button TYPE="submit" class='btn btn-danger' VALUE="delete" id="<?php echo $_POST['waarde']; ?>" onclick="werkbij(this.id,'delete');"><i class='material-icons' title='verwijder' aria-hidden='true'>delete_forever</i><span class="sr-only">verwijder</span></button></center></td>
		</tr>
	</tbody>
</table>
<br>
<?php
}
if ($_POST['groep'] == "verplaats")
{
	// parameters from URL
	try{	
		$stmt = $db->prepare("SELECT
		shc.id AS shcid,
		shc.hc,
		shc.naam AS shcn,
		hc.id,
		hc.naam AS hcn
		FROM
		hc ,
		shc
		WHERE
		shc.hc = hc.id
		ORDER BY
		hcn ASC
		");
		$stmt->execute();
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
	}//end try
	catch(Exception $e) {
		echo '<h2><font color=red>';
		var_dump($e->getMessage());
		die ('</h2></font> ');
	}
	$rows = array();
	foreach($result as $info)
	{
		$rows[] = "{ \"name\": \"$info[hcn] - $info[shcn]\",\"id\": \"$info[shcid]\" }";
	}
	
	// output to the browser
	$options =  "[\n" .join(",\n", $rows) ."\n]";		
?>
<script>
$('#shc').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: 'name',
		options: <?php echo $options ?>,
		plugins: ['restore_on_backspace'],
		create: false,
});
</script>
	<form action="../invoer" method="POST" class='text-center'>
		<input type="hidden" name="post" value="verplaats">
		<input type="hidden" name="id" value="<?php echo $_POST['waarde'] ?>">
		<table border=1 class="table table-striped table-bordered table-hover text-center">
			<thead>
				<tr>
					<th><center>Verplaats POST <font color='red'>id <?php echo $_POST['waarde'];?></font></center></th>
				</tr>
				<thead>
					<tbody>
						<tr>						
							<td>
								<div class="form-group">
    <label class="control-label col-sm-2" for="shc">Sub Category:</label>
    <div class="col-sm-10"> 
      <select id="shc"  placeholder="Sub Category" name='shc'>
								<option value="">SubCategory</option>
								</select>
    </div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<button TYPE="submit" class='btn btn-success' VALUE="rechten aanpassen"><i class='material-icons' title='Rechten aanpassen' aria-hidden='true'>verified_user</i><span class="sr-only">Pas rechten aan</span></button>
			</form>	
			<br>
<?php
}
?>