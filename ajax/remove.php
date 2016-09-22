<?php
require(getenv("DOCUMENT_ROOT")."/functions/database.php");	
if ($_POST['bewerk'] == "deleteshc")
{
	$id = $_POST['id'];
	try{	
	$stmt = $db->prepare("DELETE FROM posts WHERE shc =:id ORDER BY id");
	$stmt->execute(array(':id' => $id));
	$stmt2 = $db->prepare("DELETE FROM shc WHERE id =:id ORDER BY id");
	$stmt2->execute(array(':id' => $id));
	$post = $stmt2->rowCount();
	}
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}	
$_SESSION[ERROR] = "Sub Category ID $id  en $post posten successvol verwijderd";		
}
if ($_POST['bewerk'] == "deletehc")
{
	$id = $_POST['id'];
	try{
	$stmt = $db->prepare("SELECT id FROM shc WHERE hc =:id ORDER BY id");
	$stmt->execute(array(':id' => $id));
	$result = $stmt->fetchall(PDO::FETCH_ASSOC);
	foreach($result as $info)
	{
	$stmt2 = $db->prepare("DELETE FROM posts WHERE shc =:id ORDER BY id");
	$stmt2->execute(array(':id' => $info['id']));
	$post += $stmt2->rowCount();
	$stmt3 = $db->prepare("DELETE FROM shc WHERE id =:id ORDER BY id");
	$stmt3->execute(array(':id' => $info['id']));
	$sub += $stmt3->rowCount();
	}
	$stmt4 = $db->prepare("DELETE FROM hc WHERE id =:id ORDER BY id");
	$stmt4->execute(array(':id' => $id));
	}
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}	
$_SESSION[ERROR] = "Hoofd Category ID $id en $sub sub categorie's en $post posten successvol verwijderd";		
}
?>
<script>
	function werkbij(val,dat) {
		$.ajax({
			type: "POST",
			url: "../ajax/remove.php",
			data:'bewerk='+dat+'&id='+val,
			success: function(data){
				//alert(dat+" Succesvol uitgevoerd");
				window.location.reload();
			}
		});
	}
</script>
<?php if ($_POST['groep'] == "verwijdershc")
{
?>
<table border=1 class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><center>verwijder Sub Category <font color='red'>id <?php echo $_POST['waarde'];?></font> en alle posten</center></th>
		</tr>
	</thead>
	<tbody>	
		<tr class='info'>
			<td><center><button TYPE="submit" class='btn btn-danger' VALUE="delete" id="<?php echo $_POST['waarde']; ?>" onclick="werkbij(this.id,'deleteshc');"><i class='material-icons' title='verwijder' aria-hidden='true'>delete_forever</i><span class="sr-only">verwijder</span></button></center></td>
		</tr>
	</tbody>
</table>
<br>
<?php
}
if ($_POST['groep'] == "verwijderhc")
{
?>
<table border=1 class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><center>verwijder HoofD Category <font color='red'>id <?php echo $_POST['waarde'];?></font> en alle Sub Category's en Posten</center></th>
		</tr>
	</thead>
	<tbody>	
		<tr class='info'>
			<td><center><button TYPE="submit" class='btn btn-danger' VALUE="delete" id="<?php echo $_POST['waarde']; ?>" onclick="werkbij(this.id,'deletehc');"><i class='material-icons' title='verwijder' aria-hidden='true'>delete_forever</i><span class="sr-only">verwijder</span></button></center></td>
		</tr>
	</tbody>
</table>
<br>
<?php
}
?>