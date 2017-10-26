<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sclae=1, shrink-to-fit=no">
  		<script>
			function check_id() {
				window.open("./check_id.php?id="+document.member_form.id.value, "IDcheck", "left=200, top=200, width=200, height=60, scrollbars=no, resizables=yes");
			}
			function check_nick() {
				window.open("./check_nick.php?nick="+document.member_form.nick.value, "NICKcheck", "left=200, top=200, width=200, height=60, scrollbars=nom, resizables=yes");	
			}
			function check_input() {
				if(!document.member_form.id.value) {
					alert("아이디를 입력하세요");
					document.member_form.id.focus();
					return;
				}
				if(!document.member_form.pass.value) {
					alert("비밀번호를 입력하세요");
					document.member_form.pass.focus();
					return;
				}
				if(!document.member_form.pass_confirm.value) {
					alert("비밀번호 확인을 입력하세요")
					document.member_form.name.focus();
					return;
				}
				if(!document.member_form.nick.value) {
					alert("휴대폰 번호를 입력하세요");
					document.member_form.nick.focus();
					return;
				}
				if(document.member_form.pass.value != document.member_form.pass_confirm.value) {
					alert("비밀번호가 일치하지 않습니다 \n 다시 입력해주세요");
					document.member_form.pass.focus();
					document.member_form.pass.select();
					return;
				}
				document.member_form.submit();
			}
			function reset_form() {
				document.member_form.id.value="";
				document.member_form.pass.value="";
				document.member_form.pass_confrim.value="";
				document.member_form.name.value="";
				document.member_form.nick.value="";
				document.member_form.hp1.value="010";
				document.member_form.hp2.value="";
				document.member_form.hp3.value="";
				document.member_form.email1.value="";
				document.member_form.email2.value="";

				document.member_form.id.focus();

				return;
			}
		</script>

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
			<form name="member_form" method="post" action="./insert.php">
				<div id="title">
					<h1>회원가입</h1>
				</div>

				<div id="form_join">
					<ul>
						<li>
							<span id="id1">
								<input type="text" name="id" placeholder="아이디 입력">
							</span>
							<span id="id2">
								<a href='#' onclick="check_id()">
								중복확인
								</a>
							</span>
						</li>
						<li>
							<input type="password" name="pass" placeholder="비밀번호">
						</li>
						<li>
							<input type="password" name="pass_confirm" placeholder="비밀번호 확인">
						</li>
						<li>
							<input type="text" name="name" placeholder="이름">
						</li>
						<li>
							<span id="nick">
								<input type="text" name="nick" placeholder="닉네임">
							</span>
							<span id="nick2">
								<a href="#" onclick="check_nick()">
									중복확인
								</a>
							</span>
						</li>
						<li>
							<select class="hp" name="hp1">
								<option value="010">010</option>
								<option value="011">011</option>
								<option value="016">016</option>
								<option value="017">017</option>
								<option value="018">018</option>
								<option value="019">019</option>
							</select>
							-
							<input type="text" class="hp" name="hp2" placeholder="0000">
							-
							<input type="text" class="hp" name="hp3" placeholder="0000">
						</li>
						<li>
							<input type="text" id="email1" name="email1" placeholder="example">
							@
							<input type="text" name="email2" placeholder="domain.com">
						</li>
					</ul>
				</div>
				<div id="button">
					<a href="#" onclick="check_input()">
						저장하기
					</a>
					<a href="#" onclick="reset_form()">
						취소하기
					</a>
				</div>
			</form>
		</div>

        <!-- Optional JavaScript -->
        <!-- JQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>
