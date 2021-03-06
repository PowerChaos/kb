<?php
if (u()){
echo "<h1>".$_SESSION[ERROR]."</h1>";
$_SESSION[ERROR] ="";
if ($_GET['post'])
	{
			// parameters from URL
	$post = $_GET['post'];
	require(getenv("DOCUMENT_ROOT")."/functions/database.php");
	try{	
		$stmt = $db->prepare("SELECT * FROM posts Where id = :naam");
		$stmt->execute(array(':naam' => $post,));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();
		if (!empty($count))
		{
		$titel = $result['naam'];		
?>
<script type="text/javascript" class="init">
		function post(val, dat) {
			$.ajax({
				type: "POST",
				url: "../ajax/post.php",
				data:'groep='+dat+'&waarde='+val,
				success: function(data){
					//alert(data);
					//alert ("del: " +dat+ " en waarde: " +val);
					$("#modal").modal('show');
					$("#modalcode").html(data);
					
				}
			});
		}
</script>
<div class='right-fix hidden-print pull-right'>
			<ul>
				<li><a href="#" class="btn btn-success btn-sm" onclick="PrintElem('#post')" ><i class='material-icons' title='print' aria-hidden='true'>print</i><span class="sr-only">print</span></a></li>
			<?php if (s()){ //start Staff?>	
			<li><a href='# 'class="btn btn-danger btn-sm" data-toggle='modal' data-target='#modal' id='<?php echo $post;?>' onclick='post(this.id,"verwijder");'><i class='material-icons' title='verwijder' aria-hidden='true'>cancel</i><span class='sr-only'>verwijder</span></a></li>
			<li><a href='# 'class="btn btn-info btn-sm" data-toggle='modal' data-target='#modal' id='<?php echo $post;?>' onclick='post(this.id,"verplaats");'><i class='material-icons' title='verplaats' aria-hidden='true'>content_cut</i><span class='sr-only'>verplaats</span></a></li>
			
			<form action="../s/bewerk" method="POST" name="bewerk">
			<input type="hidden" name="post" value="bewerk">
			<input type="hidden" name="id" value="<?php echo $post ?>">
			<li><a href='#'class="btn btn-warning btn-sm" onClick="document.bewerk.submit();"><i class='material-icons' title='bewerk' aria-hidden='true'>create</i><span class='sr-only'>bewerk</span></a></li></form>
	<?php } //end staff ?>
				</ul>
</div>
<div class='col-sm-11 col-lg-11'>			
<div class="row alert alert-info hidden-print">
<div class="col-md-4">
Gemaakt door <font color="red"><?php echo $result['cu']; ?></font> @ <font color="purple"><?php echo $result['cts']; ?></font>
</div>
<div class ='col-md-4 text-center'>
<strong><?php echo $titel ?></strong>
</div>
<div class='col-md4 pull-right'>
<?php echo ($result['eu']?"bewerkt bij <font color='red'> ".$result['eu']."</font> @ <font color='purple'>".$result['ets']."</font>":"");?>
</div>
</div>
<div id="post">
<?php		
echo html_entity_decode($result['info']);
?>
</div>	
</div>
	<script type="text/javascript">
		function PrintElem(elem)
		{
			Popup($(elem).html());
		}
		
		function Popup(data) 
		{
			var mywindow = window.open('', 'post', 'height=auto,width=auto');
			mywindow.document.write('<html><head><title><?php echo $titel ?></title>');
			mywindow.document.write('</head><body >');
			mywindow.document.write(data);
			mywindow.document.write('</body></html>');
			
			mywindow.document.close(); // necessary for IE >= 10
			mywindow.focus(); // necessary for IE >= 10
			
			mywindow.print();
			mywindow.close();
			
			return true;
		}
		
	</script>	
<?php
	}//end post
	else
	{
		echo "<div class='alert alert-danger text-center'>
		<strong>Post id $post Bestaat Niet</strong>
		</div>";		
	}
	}
		catch(Exception $e) {
			echo '<h2><font color=red>';
			var_dump($e->getMessage());
			die ('</h2></font> ');
		}	
	}
	else
	{
			echo "Geen Post OntVangen";
	}
} //end user