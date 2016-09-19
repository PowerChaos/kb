<?
if (!u()){
?>

<link rel="stylesheet" href="//<?php echo $_SERVER['SERVER_NAME']?>/template/boot/css/login.css">
<!-- Login -->
<script src="//<?php echo $_SERVER['SERVER_NAME']?>/template/boot/js/login.js"></script>
<!-- login -->
	<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading"><?php
    echo $_SESSION[ERROR]?$_SESSION[ERROR]:"KB Login"; //show our sesion error above the login form
$_SESSION[ERROR]="";
	?></h2><hr />
        
        <div id="error">
        <!-- error will be shown here ! -->
        </div>
        
        <div class="form-group">
        <input type="username" class="form-control" placeholder="Gebruiker" name="username" id="username" />
        <span id="check-username"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
        </div>
       
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Inloggen
   </button> 
        </div>  
      
      </form>

    </div>
    
</div>
<?php
}
if (u())
{
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
require(getenv("DOCUMENT_ROOT")."/functions/database.php");
	try{	
$stmt = $db->prepare("SELECT
hc.naam as hn,
posts.id as pid,
posts.shc,
posts.naam as pn,
posts.info as pi,
shc.id,
shc.hc,
shc.naam as sn,
hc.id
FROM
hc ,
posts ,
shc
WHERE
posts.shc = shc.id AND
shc.hc = hc.id");
$stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_ASSOC);
?>
<div class="alert alert-info">
 OverZicht Categories
</div>
<table border=1 id='groep' class="table table-striped table-bordered table-hover">
  <thead>
  <tr>	
	<td>HoofdGroep</td>
	<td>SubGroep</td>
	<td>Post</td>
	<td>Info</td>
	</tr>
</thead>
<tbody>	
<?php
foreach($result as $info) {
echo "<tr>";
echo "<td class=warning >$info[hn]</td>";
echo "<td class=warning >$info[sn]</td>";
echo "<td class=success><a href='../post/$info[pid]'>$info[pn]</a></td>";
$in = $info[pi];
$out = strlen($in) > 50 ? substr($in,0,50)."..." : $in;
echo "<td class=info >$in</td>";
echo "</tr>";
}
echo "</tbody></table>";
}//end try
	catch(Exception $e) {
    echo '<h2><font color=red>';
    var_dump($e->getMessage());
	die ('</h2></font> ');
}
}// Einde start sessie
?>

