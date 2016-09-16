<?php
if (u())
{
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
require(getenv("DOCUMENT_ROOT")."/functions/database.php");
if (!isset($_GET['post']))
{

	try{	
$sub = $_GET['sub'];	
$stmt = $db->prepare("SELECT * FROM shc where id = :sub");
$stmt->execute(
array(':sub' => $sub)
);
$result = $stmt->fetchall(PDO::FETCH_ASSOC);
?>
<div class="alert alert-info">
  overzicht Sub Categories
</div>
<table border=1 id='groep' class="table table-striped table-bordered table-hover">
  <thead>
  <tr>	
	<td>ID</td>
	<td>Naam</td>
	</tr>
</thead>
<tbody>	
<?php
foreach($result as $info) {
echo "<tr><td class=warning >$info[id]</td>";
echo "<td class=success><a href='../sub/$info[id]/$info[id]'>$info[naam]</a></td>";
}
echo "</tbody></table>";
}//end try
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
}
elseif (isset($_GET['post']))
{
		try{	
$sub = $_GET['post'];	
$stmt = $db->prepare("SELECT * FROM posts where shc = :sub");
$stmt->execute(
array(':sub' => $sub)
);
$result = $stmt->fetchall(PDO::FETCH_ASSOC);
?>
<div class="alert alert-info">
  overzicht Posten
</div>
<table border=1 id='groep' class="table table-striped table-bordered table-hover">
  <thead>
  <tr>	
	<td>ID</td>
	<td>Naam</td>
	<td>Info</td>
	</tr>
</thead>
<tbody>	
<?php
foreach($result as $info) {
echo "<tr><td class=warning >$info[id]</td>";
echo "<td class=success><a href='../post/$info[id]'>$info[naam]</a></td>";
$in = $info[info];
$out = strlen($in) > 50 ? substr($in,0,50)."..." : $in;
echo "<td class=info >$out</td>";
}
echo "</tbody></table>";
}//end try
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
	
}
else{
	echo "hmm geen info ?";
}
}// Einde start sessie
?>