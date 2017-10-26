<?php
	session_start();
	include "../lib/dbconn.php";

	$num=$_POST['num'];
	$sql="SELECT * FROM lost WHERE num=$num";
	$result=mysql_query($sql, $connect);
	
	$row=mysql_fetch_array($result);
	$item_subject=$row['subject'];
	$item_content=$row['content'];
	$item_place=$row['place'];
	echo $item_place;
	$item_image_path=$row['image_path'];
	$userid=$_SESSION['userid'];
	$usernick=$_SESSION['usernick'];
	$page=1;
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

    </head>
        
    <body>
        <!-- 상단메뉴바 -->
		<?php include "../lib/nav.php";?>
		<div id="content">
			<div id="title">
				<h1>분실물 등록</h1>
			</div> <!--end of title-->
			<div id="write_form_title"><h2>글쓰기</h2></div>

			<form name="board_form" method="post" action="./insert.php" enctype="multipart/form-data">
				<div id="write_form">
					<div id="write_row1">
						<div class="col1"> 닉네임 </div>
						<div class="col2"> <?=$usernick?></div>
					</div> <!--end of write_row1-->
					<div id="write_row2">
						<div class="col1"> 제목 </div>
						<div class="col2">
							<input type="text" name="subject" value="<?=$item_subject?>">
						</div>
					</div> <!--end of write_row2-->
					<div id="write_row3">
						<div class="col1"> 내용 </div>
						<div class="col2">
							<textarea rows="15" cols="80" name="content"><?=$item_content?></textarea>
						</div>
					</div> <!--end of write_row3-->
					<div id="write_row4">
						<div class="col1"> 분실 장소 </div>
						<div class="col2">
							<input type="text" name="place" value="<?=$item_place?>">
						</div>
					</div> <!--end of write_row4-->
					<div id="write_row5">
						<div class="col1"> 사진 </div>
						<div class="col2">
							<input type="hidden" name="image_path" value="<?=$item_image_path?>">
							<input type="file" name="image" value="사진등록">
						</div>
					</div> <!--end of write_row5-->
				</div> <!-- end of write_form-->

				<div id="write_button">
					<input type="hidden" name="mode" value="modify">
					<input type="hidden" name="num" value=<?=$num?>>
					<input type="submit" value="완료">
					<a href="./list.php?page=<?=$page?>">목록</a>
				</div> <!--end of write_button-->
			</form>
		</div> <!-- end of content-->

        <!-- Optional JavaScript -->
        <!-- JQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>
