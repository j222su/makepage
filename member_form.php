<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>JS</title>
<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="./js/make_assignpage.js?"></script>
<script src="./js/modernizr.custom.min.js"></script>
<script src="./js/jquery-1.10.2.min.js"></script>
<script src="./js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="./js/slide.js?ver=1.js"></script>
<link rel="stylesheet" type="text/css" href="./css/make_common.css">
<!-- <link rel="stylesheet" type="text/css" href="./css/make_assignpage.css"> -->
<link rel="stylesheet" href="./css/normalize.css">
<link rel="stylesheet" href="./css/slide_image_main.css">
<link rel="stylesheet" href="./css/make_member_form.css">
<style media="screen">
	.redSpan {
		color: red;
	}
</style>
</head>
<body>
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
<!-- 슬라이드이미지 -->
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

<!-- 회원가입 -->
    <div id="main_content">
			<div id="joinInfo">
				회원가입
			</div>
			<div id="divMain">
        <form name="member_assign" action="./member_insert.php" method="post">
          <table>
            <!-- 사용자ID -->
            <tr>
              <td class="tdFirst">
                <label for="userID">사용자ID<span class="spanInfo"> *</span></label>
              </td>

              <td>
                <input id="userID" type="text" name="user_ID">
                <input id="btnIdCheck"type="button" name="" value="ID 중복확인"><br>
								<span class="redSpan" id="idSpan"></span>
              </td>
            </tr>

          <!-- 비밀번호 -->
          <tr>
            <td class="tdFirst">
              <label for="pwpw">비밀번호<span class="spanInfo"> *</span></label>
            </td>

            <td>
              <input id="pwpw" type="password" name="pwpw">
              <span>·4~12자리의 영문, 숫자, 특수문자(!, @, $, %, ^, *)만 가능</span><br/>
              <span class="redSpan" id="pwSpan"></span>
            </td>
          </tr>

          <!-- 비밀번호 확인 -->
          <tr>
            <td class="tdFirst">
              <label for="pwChk">비밀번호 확인<span class="spanInfo"> *</span></label>
            </td>

            <td>
              <input id="pwChk" type="password" name="pwChk">
              <span class="redSpan" id="pwChkSpan"></span>
            </td>
          </tr>

          <!-- 성명 -->
          <tr>
            <td class="tdFirst">
              <label for="userName">성명<span class="spanInfo"> *</span></label>
            </td>

            <td>
              <input id="userName" type="text" name="userName">
              <span>·띄어쓰기 없이 입력바랍니다.</span><br/>
              <span class="redSpan" id="userNameSpan"></span>
            </td>
          </tr>

          <!-- e-mail -->
          <tr>
            <td class="tdFirst">
              <label for="email">E-mail<span class="spanInfo"> *</span></label>
            </td>

            <td>
              <input id="inputEmail" type="email" name="email" style="width : 230px">
              <span><strong>메일 수신여부</strong></span><br/>
              <span>·<strong>할인 이벤트정보</strong> 및 할인쿠폰, 관심분야 등 꼭 필요한 정보를 빠르게 받아보실 수 있습니다.</span><br/>
              <span>·비밀번호 분실 시 E-mail로 확인해 드리니, <strong style="color:blue">정확한 E-mail주소를 기입</strong>해 주세요.</span><br/>
              <span class="redSpan" id="emailSpan"></span>
            </td>
          </tr>

          <!-- 우편번호 -->
          <tr>
            <td class="tdFirst">
              <label for="postCode">우편번호<span class="spanInfo"> *</span></label>
            </td>

            <td>
              <input type="postCode" name="postCode" style="width : 50px"><span>-</span>
              <input type="postCode" name="postCode" style="width : 50px">
              <input type="button" name="" value="우편번호 검색">
            </td>
          </tr>

          <!-- 주소 -->
          <tr>
            <td class="tdFirst">
              <label for="address">주소<span class="spanInfo"> *</span></label>
            </td>

            <td>
              <input type="text" name="address" style="width : 400px"><br/>
              <input type="text" name="address" style="width : 400px">
            </td>
          </tr>

          <!-- 휴대폰번호 -->
          <tr>
            <td class="tdFirst">
              <label for="cellPhone">휴대폰번호<span class="spanInfo"> *</span></label>
            </td>

            <td>
              <input id="cPFirst" type="number" name="cellPhone" style="width : 40px"><span>-</span>
              <input id="cPSecond" type="number" name="cellPhone" style="width : 50px"><span>-</span>
              <input id="cPThird" type="number" name="cellPhone" style="width : 50px">
              <span class="redSpan" id="cellPhoneSpan"></span>
            </td>
          </tr>
          </table>
          <button id="btnNext" type="button" name="button">회원가입하기</button>
      </form>
    </div> <!--divMain -->
  	</div> <!-- main_content -->
	</section>

	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
