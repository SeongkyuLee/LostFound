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
        <link rel="stylesheet" href="./css/main.css">

    </head>
        
    <body>
        <!-- 상단메뉴바 -->
		<div>
			<?php include "./lib/nav.php";?>
		</div>

		<div class="container">
			<div class="jumbotron">
				<h1 class="display-6" style="text-align: left"> About </h1>
				<p class="lead"> Lost & Found는 인터넷 분실물 센터입니다. 분실물과 습득물을  등록해주세요. 해당되는 아래의 버튼을 눌러서 서비스를 시작해보세요.</p>
				<p class="addBtns">
					<a class="btn btn-lg btn-primary" href="./lost/write_form.php" role="button">분실물 등록</a>
					<a class="btn btn-lg btn-secondary" href="./found/write_form.php" role="button">습득물 등록</a>
				</p>
			</div><!--end of jumbotron-->

			<div class="row marketing">
				<div class="col-lg-6">
					<input type="text" id="address" placeholder="주소 입력" />
					<button onclick="changeAddress()" id="address_btn" >주소 변경</button>

					<div id="map">지도</div>
					<?php include "./lib/map.php"; ?>
					<script>
						function setCookie(cname, cvalue, exdays) {
							var date = new Date();
							date.setTime(date.getTime() + (exdays*24*60*60*1000));
							var expires = "expires="+ date.toUTCString();
							document.cookie= cname+"="+cvalue+";"+expires+";path=/";
						}
						function getCookie(cname) {
							var name = cname + "=";
							var decodedCookie = decodeURIComponent(document.cookie);
							var ca = decodedCookie.split(';');
							for(var i = 0; i < ca.length; i++) {
								var c = ca[i];
								while (c.charAt(0) ==' ') {
									c = c.substring(1);
								}
								if (c.indexOf(name) == 0) {
									return c.substring(name.length, c.length);
								}
							}
							return "";
						}
						
						var address = getCookie("user_address");
						searchAddressToCoordinate(address);
						function changeAddress() {
							var input = document.getElementById("address").value;
							searchAddressToCoordinate(input);
							setCookie("user_address", input, 1);
						}
					</script>
				</div>
				<div class="col-lg-6">
					<?php
						include "./lib/dbconn.php";
					
						$find=$_COOKIE['find'];
						$search=$_COOKIE['search'];

						echo "<h4>최근 검색한 키워드 : $search</h4>";

						if($search and $find) {
							$sql = "SELECT * FROM lost WHERE $find LIKE '%$search%' ORDER BY num DESC";
							$result=mysql_query($sql, $connect);
							$total_record=mysql_num_rows($result);

							if($total_record != 0) {
								$list_num = min(3, $total_record);
								for ($i = 0;$i < $list_num;$i++) {
									mysql_data_seek($result, $i);
									$row=mysql_fetch_array($result);

									echo "<h5> 제목 : $row[subject] </h5>";
									echo "<p> 내용 : <br/>  $row[content] </p>";
									echo "<img src='$row[image_path]' />";
								}
							}
						}
					?>
				</div>
			</div>

			<!--
			<div class="row marketing">
				<div class="col-lg-6" id="lost-img">
					<h4>최근 등록된 분실물</h4>
					<p>분실물 사진이 여기 나오게 하자.</p>
					<img class="img-responsive" src="./data/lost.png" />
				</div>

				<div class="col-lg-6" id="found-img">
					<h4>최근 등록된 습득물</h4>
					<p>습득물 사진이 여기 나오게 하자.</p>
					<img class="img-responsive" src="./data/found.png" />
				</div>
			</div>
			<footer class="footer">
				<p> &copy; Company 2017 </p>
			</footer>
			-->
		</div> <!-- end of container-->

        <!-- Optional JavaScript -->
        <!-- JQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>
