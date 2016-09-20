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
		$titel = $result['naam'];
			}//end try
			catch(Exception $e) {
				echo '<h2><font color=red>';
				var_dump($e->getMessage());
				die ('</h2></font> ');
			}			
?>
<div class='right-fix' data-spy="affix" data-offset-top="50">
	<a href="#" class="btn btn-success btn-lg  pull-right hidden-print right-fix" onclick="PrintElem('#post')" >
		<span class="glyphicon glyphicon-print"></span> Print <?php echo $titel ?>
    </a></div>
<div id="post">			
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
		echo "Geen Post Gevonden";		
	}
} //end user