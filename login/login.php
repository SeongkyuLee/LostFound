<?php
	session_start();
?>
<?php
	$id = $_POST['id'];
	$pass=$_POST['pass'];
	if(!$id) {
		echo ("
			<script>
				window.alert('아이디를 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	if(!$pass) {
		echo ("
			<script>
				window.alert('비밀번호를 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	include "../lib/dbconn.php";

	$sql= "SELECT * FROM member WHERE id='$id';";
	$result=mysql_query($sql,$connect);
	$num_match=mysql_num_rows($result);

	if(!$num_match) {
		echo("
			<script>
				window.alert('등록되지 않은 아이디입니다.')
				history.go(-1)
			</script>
		");
	} else {
		$row=mysql_fetch_array($result);
		$db_pass=$row['pass'];

		if($pass!=$db_pass) {
			echo("
				<script>
					window.alert('비밀번호가 틀립니다.')
					history.go(-1)
				</script>
			");
			exit;
		} else {
			$userid=$row['id'];
			$username=$row['name'];
			$usernick=$row['nick'];

			$_SESSION['userid']=$userid;
			$_SESSION['username']=$username;
			$_SESSION['usernick']=$usernick;

			echo("
				<script>
					window.alert('로그인에 성공했습니다.')
					location.href='../index.php';
				</script>
			");
		}
	}
?>
