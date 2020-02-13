<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>JISU</title>
<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="./js/modernizr.custom.min.js"></script>
<script src="./js/jquery-1.10.2.min.js"></script>
<script src="./js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="./js/slide.js?ver=1"></script>
<link rel="stylesheet" type="text/css" href="./css/make_common.css">
<link rel="stylesheet" type="text/css" href="./css/make_message.css">
<link rel="stylesheet" href="./css/normalize.css">
<link rel="stylesheet" href="./css/slide_image_main.css">
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



   	<div id="message_box">
	    <h3 class="title">
<?php
	$mode = $_GET["mode"];
	$num  = $_GET["num"];

	$con = mysqli_connect("localhost", "root", "123456", "sample");
	$sql = "select * from message where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$send_id    = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];

	$content = str_replace(" ", "&nbsp;", $content);
  //공백으로 된 것은 &nbsp로 해라 공백된 것을 살리기 위해서 쓴것 html에서는 공백이 많아도 적용하지 않기 때문에!
	$content = str_replace("\n", "<br>", $content);
  //엔터자리를 br로 표시하지 않고 엔터자체로 표시하겠다~

	if ($mode=="send")
		$result2 = mysqli_query($con, "select name from members where id='$rv_id'");
	else
		$result2 = mysqli_query($con, "select name from members where id='$send_id'");

	$record = mysqli_fetch_array($result2);
	$msg_name = $record["name"];

	if ($mode=="send")
	    echo "송신 쪽지함 > 내용보기";
	else
		echo "수신 쪽지함 > 내용보기";
?>
		</h3>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$msg_name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?=$content?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
				<li><button onclick="location.href='message_response_form.php?num=<?=$num?>'">답변 쪽지</button></li>
				<li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li>
		</ul>
	</div> <!-- message_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
