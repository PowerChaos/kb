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
			<form class="navbar-form" role="search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="q">
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
 	<!-- Dynamic SiteBar -->
<div class="navbar-fixed-left">

	<ul id="tree1">
	<!-- HoofdCategory -->
		<li><a href="#">HoofdCategory</a>
	<!-- HoofdCategory -->	
			<ul>
	<!-- SubCategory -->		
				<li>SubCategory</li>
				<li>SubCategory
	<!-- SubCategory -->			
					<ul>
	<!--Posts -->				
								<li>Post</li>
								<li>Post</li>
								<li>Post</li>
	<!--Posts -->							
							</ul>
						</li>
	<!-- SubCategory -->					
				<li>SubCategory</li>
	<!-- SubCategory -->			
			</ul>
		</li>
	<!-- HoofdCategory -->	
		<li>HoofdCategory</li>
	<!-- HoofdCategory -->	
	</ul>			
</div>
	<!-- Dynamic SiteBar --> 
</nav>
	
<?php
}
?>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
			<div class="container content">