<?php
	$id=$_POST['id'];
	$pass=$_POST['pass'];
	$name=$_POST['name'];
	$nick=$_POST['nick'];
	$hp=$_POST['hp1']."-".$_POST['hp2']."-".$_POST['hp3'];
	$email=$_POST['email1']."@".$_POST['email2'];
	$regist_day=date("Y-m-d (H:i)");

	include "../lib/dbconn.php";

	$sql="SELECT * FROM member WHERE id='$id';";
	$result=mysql_query($sql, $connect);
	$exist_id=mysql_num_rows($result);

	if($exist_id) {
		echo("
			<script>
				window.alert('해당 아이디가 존재합니다.')
				history.go(-1)
			</script>
		");
		exit;
	}
	else {
		$sql="INSERT INTO member(id, pass, name, nick, hp, email, regist_day) VALUES('$id', '$pass', '$name', '$nick', '$hp', '$email', '$regist_day');";
		mysql_query($sql, $connect);
	}

	mysql_close();
	echo("
		<script>
			location.href='../index.php';
		</script>
	");
?>
