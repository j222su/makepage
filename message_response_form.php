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
<script>
  function check_input() {
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
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
	    <h3 id="write_title">
	    		답변 쪽지 보내기
		</h3>
<?php
	$num  = $_GET["num"];

	$con = mysqli_connect("localhost", "root", "123456", "sample");
	$sql = "select * from message where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$send_id      = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$subject    = $row["subject"];
	$content    = $row["content"];

	$subject = "RE: ".$subject;

	$content = "> ".$content;
	$content = str_replace("\n", "\n>", $content);
	$content = "\n\n\n-----------------------------------------------\n".$content;

	$result2 = mysqli_query($con, "select name from members where id='$send_id'");
	$record = mysqli_fetch_array($result2);
	$send_name    = $record["name"];
?>
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$userid?>">
	    	<input type="hidden" name="rv_id" value="<?=$send_id?>">
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?></span>
				</li>
				<li>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><?=$send_name?>(<?=$send_id?>)</span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">글 내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button type="button" onclick="check_input()">보내기</button>
	    	</div>
	    </form>
	</div> <!-- message_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
