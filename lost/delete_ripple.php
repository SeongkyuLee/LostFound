<?php
	include "../lib/dbconn.php";

	$num=$_POST['num'];
	$ripple_num=$_POST['ripple_num'];	
	$sql="DELETE FROM lost_ripple WHERE num=$ripple_num";
	mysql_query($sql, $connect);
	mysql_close();

	echo("
		<script>
			location.href='view.php?num=$num';
		</script>
	");
?>
