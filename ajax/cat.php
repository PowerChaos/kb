<?php
if ($_POST['name'])
{
if ($_POST['hc'])
{
// parameters from URL
$naam = $_POST['name'];
require(getenv("DOCUMENT_ROOT")."/functions/database.php");
try{	
	$stmt = $db->prepare("SELECT * FROM hc Where naam LIKE :naam");
	$stmt->execute(array(':naam' => $naam.'%',));
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
		require(getenv("DOCUMENT_ROOT")."/functions/database.php");
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
	if ($_POST['change_shc'])
	{
		// parameters from URL
		$naam = $_POST['name'];
		require(getenv("DOCUMENT_ROOT")."/functions/database.php");
		try{	
			$stmt = $db->prepare("SELECT
			shc.id,
			shc.hc,
			shc.naam,
			hc.id,
			hc.naam AS hcn
			FROM
			hc ,
			shc
			WHERE
			shc.hc = hc.id
			AND
			shc.naam = :naam
			");
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
			$rows[] = "{ \"name\": \"$info[naam] - $info[hcn]\",\"id\": \"$info[id]\" }";
		}
		
		// output to the browser
		echo "[\n" .join(",\n", $rows) ."\n]";
	}//end SHC	
}//end name
?>