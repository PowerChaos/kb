<?php
if ($_POST['name'])
{
require(getenv("DOCUMENT_ROOT")."/functions/database.php");		
if ($_POST['hc'])
{
try{	
	$stmt = $db->prepare("SELECT * FROM hc ORDER BY naam");
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
    $rows[] = "{ \"name\": \"$info[naam]\",\"id\": \"$info[id]\" }";
}

// output to the browser
echo "[\n" .join(",\n", $rows) ."\n]";
}//end HC
if ($_POST['shc'])
{
		// parameters from URL
		$naam = $_POST['id'];
		try{	
			$stmt = $db->prepare("SELECT * FROM shc Where hc = :naam");
			$stmt->execute(array(':naam' => $naam));
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
			$rows[] = "{ \"name\": \"$info[naam]\",\"id\": \"$info[id]\" }";
		}
		
		// output to the browser
		echo "[\n" .join(",\n", $rows) ."\n]";
	}//end SHC	
}//end name
?>