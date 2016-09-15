<?php
require(getenv("DOCUMENT_ROOT")."/functions/database.php");	
if ($_POST['bewerk'] == "blokeer")
{
	$id = $_POST['id'];
	try{
	$stmt = $db->prepare("update gebruikers SET rechten='b' WHERE id =:id ORDER BY id");
	$stmt->execute(array(':id' => $id));
	$info = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}	
echo 'success';	
}
if ($_POST['bewerk'] == "deblokeer")
{
	$id = $_POST['id'];
	try{
	$stmt = $db->prepare("update gebruikers SET rechten='0' WHERE id =:id ORDER BY id");
	$stmt->execute(array(':id' => $id));
	$info = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}	
echo 'success';	
}
if ($_POST['bewerk'] == "delete")
{
	$id = $_POST['id'];
	try{
	$stmt = $db->prepare("DELETE FROM gebruikers WHERE id =:id ORDER BY id");
	$stmt->execute(array(':id' => $id));
	$info = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}	
echo 'success';	
}
?>
<script>
function werkbij(val,dat) {
	$.ajax({
	type: "POST",
	url: "../ajax/users.php",
	data:'bewerk='+dat+'&id='+val,
	success: function(data){
	//alert(dat+" Succesvol uitgevoerd");
	window.location.reload();
	}
	});
}
</script>
<?php
if ($_POST['groep'] == "blokeer")
{
?>
<table border=1 class="table table-striped table-bordered table-hover">
<thead>
<tr>
    <th><center>Blokeer id <?php echo $_POST['waarde'];?></center></th>
	</tr>
</thead>
<tbody>	
<tr class='info'>
<td><center><button TYPE="submit" class='btn btn-danger' VALUE="blokeer" id="<?php echo $_POST['waarde']; ?>" onclick="werkbij(this.id,'blokeer');"><i class='material-icons' title='Blokeer' aria-hidden='true'>lock</i><span class="sr-only">Blokeer</span></button></center></td>
</tr>
</tbody>
</table>
<br>
<?php
}
elseif ($_POST['groep'] == "deblokeer")
{
?>
<table border=1 class="table table-striped table-bordered table-hover">
<thead>
<tr>
    <th><center>deBlokeer id <?php echo $_POST['waarde'];?></center></th>
	</tr>
</thead>
<tbody>	
<tr class='info'>
<td><center><button TYPE="submit" class='btn btn-success' VALUE="deblokeer" id="<?php echo $_POST['waarde']; ?>" onclick="werkbij(this.id,'deblokeer');"><i class='material-icons' title='deBlokeer' aria-hidden='true'>lock_open</i><span class="sr-only">deBlokeer</span></button></center></td>
</tr>
</tbody>
</table>
<br>
<?php
}
elseif ($_POST['groep'] == "rechten")
{
?>

<form action="../invoer" method="POST" class='text-center'>
<input type="hidden" name="users" value="rechten">
<input type="hidden" name="id" value="<?php echo $_POST['waarde'] ?>">
<table border=1 class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>Pas Rechten aan voor <?php echo $_POST['waarde'];?></th>
	</tr>
<thead>
<tbody>
<tr>						
	<td>
	 <select class="form-control" name="rechten" id="rechten">
<option value='0'>Gebruiker</option>
<option value='2'>Staff</option>
<option value='3'>Admin</option>
<option value='b'>Geblokeerd</option>
</select>
	</td>
  </tr>
 </tbody>
</table>
<button TYPE="submit" class='btn btn-success' VALUE="rechten aanpassen"><i class='material-icons' title='Rechten aanpassen' aria-hidden='true'>verified_user</i><span class="sr-only">Pas rechten aan</span></button>
</form>	
<br>
<?php
}
elseif ($_POST['groep'] == "hernoem")
{
try{
$stmt = $db->prepare("SELECT * FROM gebruikers WHERE id=:pn ORDER BY id ASC");
$stmt->execute(array('pn' => $_POST['waarde']));
$account = $stmt->fetch(PDO::FETCH_ASSOC);
}
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
?>

<form action="../invoer" method="POST" class='text-center'>
<input type="hidden" name="users" value="hernoem">
<input type="hidden" name="id" value="<?php echo $_POST['waarde'] ?>">
<table border=1 class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>Pas Naam aan voor <?php echo $account['name'];?></th>
	</tr>
<thead>
<tbody>
<tr>						
	<td>
<input type="text" name="naam" value='<?php echo $account['name'];?>'><br>
	</td>
  </tr>
 </tbody>
</table>
<button TYPE="submit" class='btn btn-success' VALUE="naam aanpassen"><i class='material-icons' title='Rechten aanpassen' aria-hidden='true'>verified_user</i><span class="sr-only">Pas naam aan</span></button>
</form>	
<br>
<?php
}
elseif ($_POST['groep'] == "toevoegen")
{
?>
<form action="../invoer" method="POST" class='text-center'>
<input type="hidden" name="users" value="toevoegen">
<table border=1 class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th>Naam</th>
	</tr>
<thead>
<tbody>
<tr>						
	<td>
<input type="text" name="naam" value='Naam Gebruiker' onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Naam Gebruiker';}"><br>
	</td>	
  </tr>
 </tbody>
</table>
<button TYPE="submit" class='btn btn-success' VALUE="Toevoegen"><i class='material-icons' title='Rechten aanpassen' aria-hidden='true'>verified_user</i><span class="sr-only">Toevoegen</span></button>
</form>	
<br>
<?php
}
elseif ($_POST['groep'] == "wachtwoord")
{
?>
<form action="../invoer" method="POST" class='text-center'>
<input type="hidden" name="users" value="wachtwoord">
<input type="hidden" name="id" value='<?php echo $_POST['waarde']?>'>
<table border=1 class="table table-striped table-bordered table-hover text-center">
<thead>
<tr>
	<th>Nieuw Wachtwoord</th>
	</tr>
<thead>
<tbody>
<tr>						
	<td>
<input type="text" name="wachtwoord" value='Nieuw Wachtwoord' onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nieuw Wachtwoord';}">
	</td>	
  </tr>
 </tbody>
</table>
<button TYPE="submit" class='btn btn-success' VALUE="Verander"><i class='material-icons' title='Rechten aanpassen' aria-hidden='true'>vpn_key</i><span class="sr-only">Verander</span></button>
</form>	
<br>
<?php
}
/* CopyRight PowerChaos 2016 */
?>