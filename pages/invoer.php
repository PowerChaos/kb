<?php
require(getenv("DOCUMENT_ROOT")."/functions/database.php");

/*
Ruimte tussen verschillende post invoer functies
*/

//verwerking Data van pass.php
if ($_POST[info] == 'pass') //pass submit
{
	$hash = NEW PasswordStorage;
	$p2 =$hash->verify_password($_POST['oldpass'],$_SESSION['hash']);
if (($p2)&& $_POST['newpass'] == $_POST['newpass2'])
{
			$changepass = $db->prepare("UPDATE gebruikers SET wachtwoord=:hash WHERE id=:uid");
			$hashpass = $hash->create_hash($_POST["newpass"]);
			$changepass->execute(array(':hash' => $hashpass,':uid' => $_SESSION[id]));
			$_SESSION[relog] = "yes";			
}
else
{
$_SESSION[ERROR] = "Wachtwoord komt niet overeen<br>oud wachtwoord: $_POST[oldpass]<br>nieuw wachtwoord: $_POST[newpass] <br>Wachtwoord Herhaling: $_POST[newpass2]";	
}
if ($_SESSION[relog] =="")
{
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://{$_SERVER['SERVER_NAME']}//pass\" />";
}
else
{
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://{$_SERVER['SERVER_NAME']}/\" />";	
}
} // einde verwerking pass.php

/*
Ruimte tussen verschillende post invoer functies
*/

 // Begin verwerking users.php
 
if ($_POST['users'] == 'rechten') //Rechten aanpassen
{
$waarde = $_POST['id'];
$data = $_POST['rechten'];
	if ($waarde > 1)
	{
	try{
$stmt = $stmt = $db->prepare("UPDATE gebruikers SET rechten =:data WHERE id =:waarde ");
$stmt->execute(
array(
':waarde' => $waarde, 
':data' => $data 
 ));
	}
catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}

switch ($data) {
    case "3":
        $data = "admin";
        break;
	case "2":
		$data = "staff";        
        break;
    case "b":
		$data = "Geblokeerd";
		break;
	default:
		$data = "gebruiker";
	}
$_SESSION[ERROR] = "Rechten zijn aangepast naar $data" ;
}
else
{
$_SESSION[ERROR] = "de rechten van id $waarde kan niet worden veranderd";
}

echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://{$_SERVER['SERVER_NAME']}/a/gebruikers\" />";
}
 

/*
Ruimte tussen verschillende post invoer functies
*/

if ($_POST['users'] == 'hernoem') //Rechten aanpassen
{
$waarde = $_POST['id'];
$data = $_POST['naam'];
	try{
$stmt = $stmt = $db->prepare("UPDATE gebruikers SET name =:data WHERE id =:waarde ");
$stmt->execute(
array(
':waarde' => $waarde, 
':data' => $data 
 ));
	}
catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
$_SESSION[ERROR] = "naam is aangepast naar $data" ;
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://{$_SERVER['SERVER_NAME']}/a/gebruikers\" />";
}
 

/*
Ruimte tussen verschillende post invoer functies
*/

if ($_POST['users'] == 'toevoegen') //Gebruiker toevoegen
{
$hash = NEW PasswordStorage;
$data = $_POST['wachtwoord'];
$hashpass = $hash->create_hash($data);
$naam = $_POST['naam'];
	try{
$stmt = $db->prepare("ALTER TABLE gebruikers AUTO_INCREMENT =2");
$stmt->execute();		
$stmt = $db->prepare("INSERT INTO gebruikers (naam,wachtwoord) VALUES (:naam,:data)");
$stmt->execute(
array(
':naam' => $naam, 
':data' => $hashpass,
 ));
	}
catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
$_SESSION[ERROR] = "Gebruiker Toegevoegd met wachtwoord: <font color='red'>$data</font>" ;
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://{$_SERVER['SERVER_NAME']}/a/gebruikers\" />";
}

/*
Ruimte tussen verschillende post invoer functies
*/

if ($_POST['users'] == 'wachtwoord') //Rechten aanpassen
{
$hash = NEW PasswordStorage;
$waarde = $_POST['id'];
$data = $_POST['wachtwoord'];
$hashpass = $hash->create_hash($data);
	try{
$stmt = $stmt = $db->prepare("UPDATE gebruikers SET wachtwoord =:data WHERE id =:waarde ");
$stmt->execute(
array(
':waarde' => $waarde, 
':data' => $hashpass 
 ));
	}
catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
$_SESSION[ERROR] = "wachtwoord is aangepast naar $data" ;
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://{$_SERVER['SERVER_NAME']}/a/gebruikers\" />";
}

/*
Ruimte tussen verschillende post invoer functies
*/

 // einde verwerking users.php 

//Geen Direct Acces
if (empty($_POST)) // Geen direct acces :D
{
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://{$_SERVER['SERVER_NAME']}/\" />";	
}
?>