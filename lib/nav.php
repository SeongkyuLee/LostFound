<?php
	session_start();
	$userid=$_SESSION['userid'];
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/lostandfound/index.php">Lost & Found</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
	<ul class="navbar-nav mr-auto">     
	    <li class="nav-item">
		<a class="nav-link" href="/lostandfound/lost/write_form.php">분실물 등록</a>
	    </li>
	    <li class="nav-item">
		<a class="nav-link" href="/lostandfound/found/write_form.php">습득물 등록</a>
	    </li>

	    <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">보관 리스트</a>
		<div class="dropdown-menu" aria-labelledby="dropdown01">
		  <a class="dropdown-item" href="/lostandfound/lost/list.php">분실물 리스트</a>
		  <a class="dropdown-item" href="/lostandfound/found/list.php">습득물 리스트</a>
		</div>
	    </li>

	    <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">회원 정보</a>
		<div class="dropdown-menu" aria-labelledby="dropdown01">
		<?php
			if($userid) {
				echo ("
					<a class='dropdown-item' href='/lostandfound/login/logout.php'>로그아웃</a>
					<a class='dropdown-item' href='/lostandfound/member/member_form.php'>회원가입</a>
					<a class='dropdown-item' href='/lostandfound/member/member_modify_form.php'>회원정보 수정</a>
				");
			} else {
				echo ("
					<a class='dropdown-item' href='/lostandfound/login/login_form.php'>로그인</a>
					<a class='dropdown-item' href='/lostandfound/member/member_form.php'>회원가입</a>				
				");
			}
		?>
		</div>
	    </li>
	</ul>

	<!--
	<form class="form-inline my-2 my-lg-0" action="./search.html" method="get">
	    <input class="form-control mr-sm-2" type="text" placeholder="물건 또는 지역을 입력" aria-label="Search" name="q">
	    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="검색">
	</form>
	-->
    </div>
</nav>
