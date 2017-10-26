<?php
	session_start();
	$userid=$_SESSION['userid'];
	$num=$_POST['num'];
	$ripple_content=$_POST['ripple_content'];

?>
<?php
	if(!$userid) {
		echo ("
			<script>
				window.alert('로그인 후 이용하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}
	include "../lib/dbconn.php";

	$regist_day=date("Y-m-d (H:i)");

	$sql="INSERT INTO lost_ripple (parent, id, content, regist_day) VALUES ('$num', '$userid', '$ripple_content', '$regist_day');";
	mysql_query($sql, $connect);
	mysql_close();
	
	echo("
		<script>
			location.href='./view.php?num=$num';
		</script>
	");
?>
