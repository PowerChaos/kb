<?php
if (u())
{
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../home">Knowledge Base</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
		<div class="col-sm-3 col-md-3">
			<form class="navbar-form" role="search" action="../home" method="POST" name="searchbar">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="search">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
		</div>
      <ul class="nav navbar-nav navbar-right">
	  	  	  <?php
	  if (s())
	  {
?>		
		<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Post Menu
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="../s/nieuw">Nieuwe Post</a></li>
		<li><a href="../s/bewerk">Bewerk Post</a></li>
		<li><a href="../s/lijst">zie all posten</a></li>		
        </ul>
      </li>
<?php		
	  }
	  ?>
	  	  <?php
	  if (a())
	  {
		  
?>					
		<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Menu
        <span class="caret"></span></a>
        <ul class="dropdown-menu">					
		<li><a href="../a/gebruikers">Gebruikers</a></li>
        </ul>
      </li>
<?php		
	  }
	  ?>
	  <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['naam'] ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../pass">wachtwoord</a></li>
          <li><a href="../logout">Log Uit</a></li> 
        </ul>
      </li>
      </ul>
    </div>
  </div>
</nav>
 	<!-- Dynamic SiteBar -->
<div class="container-fluid">
<div class="row">
<div class="col-sm-3 col-lg-2">
<nav class="navbar navbar-default navbar-fixed-side">
<ul id="tree1">
<?php
require(getenv("DOCUMENT_ROOT")."/functions/database.php");
	try{	
$stmt = $db->prepare("SELECT * FROM hc ORDER BY naam ASC");
$stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_ASSOC);

}//end try
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
	foreach($result as $info) {
echo "<li>$info[naam]";
echo "<ul>";

	try{
$hc = $info[id];		
$stmthc = $db->prepare("SELECT * FROM shc where hc =:hc ORDER BY naam ASC");
$stmthc->execute(array(':hc' => $hc));
$resultsub = $stmthc->fetchall(PDO::FETCH_ASSOC);

}//end try
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}

foreach($resultsub as $sub) {
echo "<li>$sub[naam]";
echo "<ul>";

	try{
$subhc = $sub[id];		
$stmtsubhc = $db->prepare("SELECT * FROM posts where shc =:subhc ORDER BY naam ASC");
$stmtsubhc->execute(array(':subhc' => $subhc));
$resultpost = $stmtsubhc->fetchall(PDO::FETCH_ASSOC);

}//end try
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}

foreach($resultpost as $post) {
echo "<li><a href='../post/$post[id]'>$post[naam]</a></li>";
}
echo "</ul>";
}
echo "</li>";
echo "</ul>";
echo "</li>";
}
?>
</ul>
</nav>			
</div>
<!-- Dynamic SiteBar --> 	
<?php
}
?>
        <!-- Page Content -->
<div class="col-sm-9 col-lg-10">