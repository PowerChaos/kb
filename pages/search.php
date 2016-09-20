<?php
if (u()){
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
if ($_GET['search'])
	{
			// parameters from URL
	$post = $_GET['search'];
	require(getenv("DOCUMENT_ROOT")."/functions/database.php");
	try{	
		$stmt = $db->prepare("SELECT * FROM posts Where info LIKE :naam");
		$stmt->execute(array(':naam' => '%'.$post.'%'));
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		foreach($result as $info) {
		$titel = $info['naam'];
		echo "<a href='../post/{$info[id]}'".$titel."</a>";
		}
			}//end try
			catch(Exception $e) {
				echo '<h2><font color=red>';
				var_dump($e->getMessage());
				die ('</h2></font> ');
		

	}
	}//end post
	else
	{
			?>
						<form class="navbar-form" role="search" action="../zoek/" method="GET">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="search">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
			<?php
		
	}
}
?>