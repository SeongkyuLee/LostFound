<?php
$category = $_POST["category"];
$id = $_POST["id"];
$pwd = $_POST["pwd"];
$title = $_POST["title"];
$content = $_POST["content"];

$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["image"]["name"]);
if(move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
	echo "파일이 업로드 되었습니다.";
} else {
	echo "파일 업로드 공격의 가능성이 있습니다\n";
}
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>물건 등록</title>
	</head>
	<body>
		<?php if(strcmp($category, "lost")==0) { ?>
		<p> 분실물이 등록되었습니다. </p>
		<form action="./lost.html" method="post">
			<p>
				<input type="hidden" name="title" value=<?php echo $title?>>
				<input type="hidden" name="content" value=<?php echo $content?>>
				<input type="hidden" name="image-path" value=<?php echo $target_file?>>
			</p>
			<p>
				<input type="submit" value="등록된 분실물 확인">
			</p>
		</form>

		<?php } else { ?>
		<p> 습득물이 등록되었습니다. </p>
		<form action="./found.html" method="post">
			<p>
				<input type="hidden" name="title" value=<?php echo $title?>>
				<input type="hidden" name="content" value=<?php echo $content?>>
				<input type="hidden" name="image-path" value=<?php echo $target_file?>>
			</p>
			<p>
				<input type="submit" value="등록된 습득물 확인">
			</p>
		</form>
		<?php } ?>
	</body>
</html>
