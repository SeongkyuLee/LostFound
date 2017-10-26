<?php
	session_start();
	
	$userid=$_SESSION['userid'];

	include "../lib/dbconn.php";

	$num=$_GET['num'];
	$sql="SELECT * FROM lost WHERE num=$num";

	$result=mysql_query($sql, $connect);

	$row=mysql_fetch_array($result);

	$item_num=$row['num'];
	$item_id=$row['id'];
	$item_subject=$row['subject'];
	$item_content=$row['content'];
	$item_place=$row['place'];
	$item_image_path=$row['image_path'];
	$item_date=$row['regist_day'];
	$item_hit=$row['hit'];

	$page=$_GET['page'];
	$new_hit=$item_hit + 1;
	$sql="UPDATE lost SET hit=$new_hit WHERE num=$num";
	mysql_query($sql, $connect);
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sclae=1, shrink-to-fit=no">
        
        <title>Lost & Found</title>
        <meta name="description" content="Lost & Found stuffs">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="../css/main.css">

		<script>
			function check_input() {
				if(!document.ripple_form.ripple_content.value) {
					alert("내용을 입력하세요!");
					document.ripple_form.ripple_content.focus();
					return;
				}
				document.ripple_form.submit();
			}

			function del(href) {
				if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
					document.location.href=href;
				}
			}
		</script>
    </head>
        
    <body>
        <!-- 상단메뉴바 -->
		<?php include "../lib/nav.php";?>

		<div id="content">
			<div id="title">
				<h1>분실물</h1>
			</div>
			<hr>
			<div id="view.title">
				<div id="view.title1">
					<?=$item_subject?>
				</div>
				<div id="view.title2">
					<?=$item_id?> | 조회수 : <?=$item_hit?> | <?=$item_date?>
				</div>
			</div> <!-- end of view_title-->
			<hr>

			<hr>
			<div id="view_content">
				내용 : <?=$item_content?>
				<img src="<?=$item_image_path?>">
			</div>
			<hr>
			<div id="ripple">
				<?php
					$item_num = $_GET['num'];
					$sql="SELECT lost_ripple.num, lost_ripple.id, member.nick, lost_ripple.content, lost_ripple.regist_day FROM lost_ripple LEFT JOIN member ON lost_ripple.id=member.id WHERE lost_ripple.parent=$item_num;";
					$ripple_result=mysql_query($sql,$connect);

					while($row_ripple=mysql_fetch_array($ripple_result)) {
						$ripple_num=$row_ripple['num'];
						$ripple_id=$row_ripple['id'];
						$ripple_nick=$row_ripple['nick'];
						$ripple_content=str_replace("\n", "<br>", $row_ripple['content']);
						$ripple_content=str_replace(" ", "&nbsp;", $ripple_content);
						$ripple_date=$row_ripple['regist_day'];
				?>
				<hr>
				<ul>
					<li id="writer_title1">
						<?=$ripple_nick?>
					</li>
					<li id="writer_title2">
						<?=$ripple_date?>
					</li>
					<li id="writer_title3">
						<?php
							if($userid=="admin"||$userid==$ripple_id) {
								echo "
								<form name='ripple_delete_form' method='post' action='delete_ripple.php'>
									<input type='hidden' name='num' value=$item_num>
									<input type='hidden' name='ripple_num' value=$ripple_num>
									<input type='submit' value='댓글 삭제'>
								</form>";
							}
						?>
					</li>
					<li id="ripple_content">
						<?=$ripple_content?>
					</li>
				</ul>
				<hr>
				<?php
					}
				?>
			</div>
			<hr>
			<form name="ripple_form" method="post" action="insert_ripple.php">
				<div id="ripple_box">
					<div id="ripple_box1">
						<h1>댓글쓰기</h1>
					</div>
					<span id="ripple_box2">
						<textarea rows="5" cols="65" name="ripple_content"></textarea>
					</span>
					<span id="ripple_box3">
						<input type="hidden" name="page" value=<?=$page?>>
						<input type="hidden" name="num" value=<?=$item_num?>>
						<input type="submit" value="댓글 달기">
					</span>
				</div>
			</form>
			<hr>

			<div id="view_button">
				<span>
					<form name="list_form" method="get" action="list.php">
						<input type="hidden" name="page" value=<?=$page?>>
						<input type="submit" value="목록">
					</form>
				</span>
					<?php
						if($userid==$item_id or $userid=="admin") {
					?>
				<span>
					<form name="modify_form" method="post" action="modify_form.php">
						<input type="hidden" name="num" value=<?=$num?>>
						<input type="hidden" name="page" value=<?=$page?>>
						<input type="submit" value="수정">
					</form>
				</span>
				<span>
					<form name="delete_form" method="post" action="delete.php">
						<input type="hidden" name="num" value=<?=$num?>>
						<input type="hidden" name="page" value=<?=$page?>>
						<input type="submit" value="삭제">
					</form>
				</span>
					<?php
						}
					?>
				<?php
					if($userid) {
				?>
				<form name="write_form" method="get" action="write_form.php">
					<input type="submit" value="글쓰기">
				</form>
				<?php
					}
				?>
			</div> <!-- end of view_button-->
		</div> <!--end of content-->
        <!-- Optional JavaScript -->
        <!-- JQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>
