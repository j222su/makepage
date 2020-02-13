<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>JS</title>
<!-- <link rel="stylesheet" type="text/css" href="./css/login.css"> -->
<script type="text/javascript" src="./js/login.js"></script>
<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<!-- <script src="./js/make_assignpage.js?ver=1"></script> -->
<script src="./js/modernizr.custom.min.js"></script>
<script src="./js/jquery-1.10.2.min.js"></script>
<script src="./js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="./js/slide.js?ver=1"></script>
<script src="./js/make_login.js"></script>
<link rel="stylesheet" type="text/css" href="./css/make_common.css">
<link rel="stylesheet" href="./css/normalize.css">
<link rel="stylesheet" href="./css/slide_image_main.css">
<link rel="stylesheet" href="./css/make_login.css">
</head>
<body>
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
		<div class="slideshow">
			<div class="slideshow_slides">
				<a href="#"><img src="./image/catalina1.jpg" alt="slide1"></a>
		    <a href="#"><img src="./image/grand.jpg" alt="slide2"></a>
		    <a href="#"><img src="./image/lasvegas1.jpg" alt="slide3"></a>
		    <a href="#"><img src="./image/la.jpg" alt="slide4"></a>
			</div>

			<div class="slideshow_nav">
				<a href="#" class="prev">prew</a>
				<a href="#" class="next">next</a>
			</div>

			<div class="slideshow_indicator">
				<a href="#"></a>
				<a href="#"></a>
				<a href="#"></a>
				<a href="#"></a>
			</div>
		</div>


		<div id="divLogin">
      <!-- 로그인 틀 -->
			<div id="divHeader">
				<span>Login</span>
			</div>
      <div id="divForm">
        <form name="make_login" action="make_login.php" method="post">
          <!-- 아이디, 비밀번호, 로그인 -->
          <div id="div-Input">
            <label for="userId"></label>
            <input class="inputIdPw" id="inputId" type="text" name="user_ID" placeholder="아이디 or 이메일">

            <label for="userPw"></label>
            <input class="inputIdPw" id="inputPw" type="password" name="userPw" placeholder="비밀번호">

            <input id="btnLogin" type="button" name="" value="로그인">
          </div>

          <!-- 로그인 상태 유지, 아이디 저장 등등 -->
          <div id="div-Keep">
            <input type="checkbox" name="loginKeep" value="">
            <label for="loginKeep">로그인 상태 유지</label>
            <input type="checkbox" name="saveId" value="">
            <label for="saveId">아이디 저장</label><br/>
            <span id="msg">개인정보보호를위해 개인 PC에서 사용해주세요</span>
          </div>
          <div id="div-buttons">
            <input class="btn" type="button" name="" value="아이디 찾기">
            <input class="btn" type="button" name="" value="비밀번호 찾기">
            <input class="btn" id="btnAssign" type="button" name="" value="회원가입">
          </div>
        </form>
      </div>
    </div>




	</section>
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
