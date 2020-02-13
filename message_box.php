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
  <link rel="stylesheet" href="./css/slide_image_main.css"><link rel="stylesheet" type="text/css" href="./css/make_common.css">
<link rel="stylesheet" type="text/css" href="./css/make_message.css">
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

   	<div id="message_box">
	    <h3>
<?php
 		if (isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;

		$mode = $_GET["mode"];

		if ($mode=="send")
			echo "송신 쪽지함 > 목록보기";
		else
			echo "수신 쪽지함 > 목록보기";
?>
		</h3>
	    <div>
	    	<ul id="message">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">
<?php
						if ($mode=="send")
							echo "받은이";
						else
							echo "보낸이";
?>
					</span>
					<span class="col4">등록일</span>
				</li>
<?php
	$con = mysqli_connect("localhost", "root", "123456", "sample");

	if ($mode=="send")
		$sql = "select * from message where send_id='$userid' order by num desc";
	else
		$sql = "select * from message where rv_id='$userid' order by num desc";

	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산
  // total_page는 게시물 개수를 10으로 나눠서 나누어 떨어지면 그 몫이 total_page가 되고
  // total_page는 게시물 개수를 10으로 나눠서 나누어 떨어지지 않으면  소수점은 버리고 1더한 값이 아래 숫자에 페이지 수를 보여준다.
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

	// 표시할 페이지($page)에 따라 $start 계산
  // start는 지금 2page를 한다고 했을 때 (10~19)까지인데 2page에서 첫번째로 보여지는 게시물번호가 10이라는 것!!
  // 1page는 (0~9)까지
	$start = ($page - 1) * $scale;


  //number는 내가 원하는 페이지의 첫번째 위치
  //138개의 게시물에서 2page에는 10을 뺀 값인 128번 게시물부터 보여진다.
  //138 137 136 135 134 133 132 131 130 129는 1page
  //128 127 126 125 124 123 122 121 120 119는 2page
	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      // 레코드셋(data는 무조건 레코드셋)에서 어떤위치를(i) 찾고 싶을 때 쓴다.
      $row = mysqli_fetch_array($result);
      // 레코드셋에 있는 포인터를 배열로 가져와라.
      // 이동한 레코드를 배열로 가져와서 row로 넘겨라
      // 하나의 레코드 가져오기
	  $num    = $row["num"];
	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];

	  if ($mode=="send")
	  	$msg_id = $row["rv_id"];
	  else
	  	$msg_id = $row["send_id"];

	  $result2 = mysqli_query($con, "select name from members where id='$msg_id'");
	  $record = mysqli_fetch_array($result2);
	  $msg_name     = $record["name"];
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
					<span class="col3"><?=$msg_name?>(<?=$msg_id?>)</span>
					<span class="col4"><?=$regist_day?></span>
				</li>
<?php
   	   $number--;
   }
   mysqli_close($con);
?>
	    	</ul>
			<ul id="page_num">
<?php
	if ($total_page>=2 && $page >= 2)
	{
    //total_page는
    //전체페이지가 2페이지 이상있으면 이전페이지를 갈 수 있고 현재페이지가 2페이지 이상이면 그 이전페이지를 갈 수 있다.
		$new_page = $page-1;
		echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)
     //현재페이지가 마지막 페이지가 아니면 다음을 보여주겠다.
   	{
		$new_page = $page+1;
		echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->
			<ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
				<li><button onclick="location.href='message_form.php'">쪽지 보내기</button></li>
			</ul>
	</div> <!-- message_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
