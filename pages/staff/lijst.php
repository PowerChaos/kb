<?php
if (s()){
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
require(getenv("DOCUMENT_ROOT")."/functions/database.php");
	try{	
$stmt = $db->prepare("SELECT * FROM gebruikers");
$stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_ASSOC);
?>