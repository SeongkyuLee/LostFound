<?php
	session_start();
	$userid=$_SESSION['userid'];
	$subject=$_POST['subject'];
	$content=$_POST['content'];
	$place=$_POST['place'];
	$mode=$_POST['mode'];

	if($_FILES["image"]) {
		$temp_file=$_FILES["image"]["tmp_name"];
		$target_dir="../data/";
		$target_file=$target_dir.basename($_FILES["image"]["name"]);
		move_uploaded_file($temp_file, $target_file);
	} else {
		$target_file=$_POST['image_path'];
	}
	$page=1;
?>
<meta charset="utf-8">
<?php
	if(!$userid) {
		echo("
			<script>
				window.alert('로그인 후 이용해 주세요.')
				history.go(-1)
			</script>
		");
		exit;
	}
	if(!$subject) {
		echo("
			<script>
				window.alert('제목을 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}
	if(!$content) {
		echo("
			<script>
				window.alert('내용을 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	$regist_day=date("Y-m-d (H:i)");
	include "../lib/dbconn.php";

	if($mode=="modify") {
		$num=$_POST['num'];
		$sql="UPDATE lost SET subject='$subject', content='$content', place='$place', image_path=$target_file WHERE num=$num;";
	} else {
		$sql="INSERT INTO lost(id, subject, content, place, image_path, regist_day, hit)";
		$sql.="VALUES('$userid', '$subject', '$content', '$place', '$target_file', '$regist_day', 0);";
	}

	mysql_query($sql,$connect);
	$sql="SELECT num FROM lost WHERE regist_day='$regist_day' AND id='$userid'";
	$result=mysql_query($sql,$connect);
	$row=mysql_fetch_array($result);
	$view_num=$row['num'];

	mysql_close();

	echo("
		<script>
			location.href='./list.php?page=$page';
		</script>
	");
?>
