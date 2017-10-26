<?php
	session_start();
	$userid=$_SESSION['userid'];
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sclae=1, shrink-to-fit=no">
        
        <title>Lost & Found</title>
        <meta name="description" content="Lost & Found stuffs">

		<script>
			function check_id() {
				window.open("check_id.php?id=" + document.member_form.id.value, "IDcheck", "left=200, top=200, width=250, height=100, scrollbars=no, resizable=yes");
			}
			function check_nick() {
				window.open("check_nick.php?nick="+document.member_form.nick.value, "NICKcheck", "left=200, top=200, width=250, height=100, scrollbars=no, resizable=yes");
			}
			function check_input() {
				if(!document.member_form.pass.value) {
					alert("비밀번호를 입력하세요.");
					document.member_form.pass.focus();
					return;
				}
				if(!document.member_form.pass_confirm.value) {
					alert("비밀번호 확인을 입력하세요.");
					document.member_form.pass_confirm.focus();
					return;
				}
				if(!document.member_form.nick.value) {
					alert("닉네임을 입력하세요.");
					document.member_form.nick.focus();
					return;
				}
				if(!document.member_form.hp2.value||!document.member_form.hp3.value) {
					alert("휴대폰 번호를 입력하세요.");
					document.member_form.hp2.focus();
					return;
				}
				if(document.member_form.pass.value != document.member_form.pass_confirm.value) {
					alert("비밀번호가 일치하지 않습니다. \n 다시 입력해주세요");
					document.member_form.pass.focus();
					document.member_form.pass.select();
					return;
				}
				document.member_form.submit();
			} 
			function reset_form() {
				document.member_form.id.value="";
				document.member_form.pass.value="";
				document.member_form.pass_confirm.value="";
				document.member_form.name.value="";
				document.member_form.nick.value="";
				document.member_form.hp1.value="010";
				document.member_form.hp2.value="";
				document.member_form.hp3.value="";
				document.member_form.email1.value="";
				document.member_form.email2.value="";
			
				return;
			}
		</script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="../css/main.css">

    </head>
        
	<?php
		include "../lib/dbconn.php";

		$sql="SELECT * FROM member WHERE id='$userid'";
		$result=mysql_query($sql, $connect);
		$row=mysql_fetch_array($result);

		$hp=explode("-", $row['hp']);
		$hp1=$hp[0];
		$hp2=$hp[1];
		$hp3=$hp[2];

		$email=explode("@", $row['email']);
		$email1=$email[0];
		$email2=$email[1];

		mysql_close();
	?>
    <body>
        <!-- 상단메뉴바 -->
		<?php include "../lib/nav.php";?>
		<div id="content">
			<form name="member_form" method="post" action="modify.php">
				<div id="title">
					<h1>회원정보수정</h1>
				</div>
			
				<div id="form_join">
					<ul>
						<li>아이디 : <?=$row['id']?></li>
						<li>이름 :<?=$row['name']?></li>
						<li>
							<span id="nick1">
								닉네임 : <input type="text" name="nick" value="<?=$row['nick']?>">
							</span>
							<span id="nick2">
								<a href='' onclick="check_nick()">중복검사</a>
							</span>
						</li>
						<li>비밀번호 : <input type="password" name="pass"></li>
						<li>비밀번호 확인 : <input type="password" name="pass_confirm"></li>

						<li>
							핸드폰 번호 :
							<input type="text" class="hp" name="hp1" value="<?=$hp1?>">
							-
							<input type="text" class="hp" name="hp2" value="<?=$hp2?>">
							-
							<input type="text" class="hp" name="hp3" value="<?=$hp3?>">
						</li>
						<li>
							이메일 주소 :
							<input type="text" id="email1" name="email1" value="<?=$email1?>">
							@
							<input type="text" id="email2" name="email2" value="<?=$email2?>">
						</li>
					</ul>
				</div>
				<div id="button">
					<a href='#' onclick="check_input()">저장하기</a>
					&nbsp;&nbsp;
					<a href='#' onclick="reset_form()">취소하기</a>
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
