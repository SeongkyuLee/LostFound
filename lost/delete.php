<?php
	session_start();

	include "../lib/dbconn.php";

	$num=$_POST['num'];
	$sql="DELETE FROM lost WHERE num=$num;";
	mysql_query($sql, $connect);
	$sql="DELETE FROM lost_ripple WHERE parent=$num;";
	mysql_query($sql, $connect);
	mysql_close();
	echo("
		<script>
			location.href='list.php';
		</script>
	");
?>
