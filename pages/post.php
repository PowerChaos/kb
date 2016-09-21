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
		$stmt = $db->prepare("SELECT * FROM posts Where id LIKE :naam");
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
			<?php } //end staff ?>
				</ul>
</div>
<div id="post">			
<div class="alert alert-info text-center">
<strong><?php echo $titel ?></strong>
</div>
<?php			
echo html_entity_decode($result['info']);
?>	
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