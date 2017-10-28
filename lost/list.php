<?php
	session_start();
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
  	<?php
		include "../lib/dbconn.php";

		$scale=10;
		$mode=$_GET['mode'];
		if($mode=="search") { //검색 모드
			$find=$_GET['find'];	
			$search=$_GET['search'];

			setcookie('find', $find, time() + 60 * 60 * 24 * 1000, '/');
			setcookie('search', $search, time() + 60 * 60 * 24 * 1000, '/');

			if(!$search) {
				echo ("
					<script>
						window.alert('검색할 단어를 입력해 주세요!')
						history.go(-1)
					</script>
				");
				exit;
			}

			$sql = "SELECT * FROM lost WHERE $find LIKE '%$search%' ORDER BY num DESC";
		} else {//보기 모드
			$sql = "SELECT * FROM lost ORDER BY num DESC";
		}

		$result=mysql_query($sql, $connect);

		$total_record=mysql_num_rows($result);

		if($total_record % $scale==0)
			$total_page=floor($total_record/$scale);
		else
			$total_page=floor($total_record/$scale) + 1;

		$page=$_GET['page'];
		if(!$page)
			$page=1;

		$start=($page - 1) * $scale;

		$number=$total_record - $start;
	?>

    <body>
        <!-- 상단메뉴바 -->
		<?php include "../lib/nav.php";?>

		<div id="content">
			<div id="title">
				<h1>분실물 등록</h1>
			</div>

			<!-- 검색-->
			<form name="board_form" method="get" action="list.php">
				<div id="list_search">
					<input type="hidden" name="mode" value="search">
					<select name="find">
						<option value="subject">제목</option>
						
						<!--
						<option value="content">내용</option>
						<option value="nick">닉네임</option>
						<option value="name">이름</option>
						-->
					</select>
					<input type="text" name="search">
					<input type="submit" value="검색">
				</div> <!-- end of list_search-->
			</form>

			<div id="list_content">
				<?php
					for($i=$start; $i<$start + $scale && $i<$total_record; $i++) {
						mysql_data_seek($result, $i);
						$row=mysql_fetch_array($result);

						$item_num=$row['num'];
						$item_id=$row['id'];
						$item_hit=$row['hit'];
						$item_date=$row['regist_day'];
						$item_date=substr($item_date, 0, 10);
						$item_subject=str_replace(" ", "&nbsp;", $row['subject'])
				?>
				<hr class="one">
				<div id="list_item">
					<div id=list_item1">
						글번호 : <?=$number?>
					</div>
					<div id="list_item2">
						제목 : 
						<a href="view.php?num=<?=$item_num?>&page=<?=$page?>">
							<?=$item_subject?>
						</a>
					</div>
					<div id="list_item3">
						아이디 : <?=$item_id?>
					</div>
					<div id="list_item4">
						등록일 : <?=$item_date?>
					<div>
					<div id="list_item5">
						조회수 : <?=$item_hit?>
					</div>
				</div>
				<hr class="two">
				<?php
					$number--;
					}
				?>
				<div id="page_button">
					<div id="page_num">
						<?php 
							if($page!=1) {
								$prev=$page-1;
								echo ("
									<a href='list.php?page=$prev'>이전</a>
								");
							} else {
								echo "이전";
							}
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
							//게시판 목록 하단에 페이지 번호 출력
							for($i=1; $i<=$total_page;$i++) {
								if($page==$i) {
									echo "<b> $i </b>";
								} else {
									echo "<a href='list.php?page=$i'>$i</a>";
								}
							}
						?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
							if($page!=$total_page) {
								$next=$page+1;
								echo ("
									<a href='list.php?page=$next'>다음</a>
								");
							} else {
								echo "다음";
							}
						?>
					</div> <!-- end of page_num-->

					<div id="button">
						<a href="list.php?page=<?=$page?>">목록</a>
						<a href="./write_form.php">글쓰기</a>
					</div> <!--end of button-->
				</div> <!--end of page_button-->
			</div> <!--end of content-->
		</div> <!--end of wrap-->
												
        <!-- Optional JavaScript -->
        <!-- JQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>
