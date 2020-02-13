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
<link rel="stylesheet" type="text/css" href="./css/make_board.css">
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

   	<div id="board_box">
	    <h3 class="title">
			게시판 > 내용보기
		</h3>
<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];
  $bmode_insert = "bmode_insert";
  $bmode_update = "bmode_update";

	$con = mysqli_connect("localhost", "root", "123456", "sample");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
  //mysqli_fetch_array는 $result값을 배열로 바꾼다.
  //mysqli_fetch_row도 $result값을 배열로 바꾼다.
  //mysqli_fetch_row는 인덱스로 값을 찾고
  //mysqli_fetch_array는 인덱스와 필드명으로 값을 찾을 수 있다.
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update board set hit=$new_hit where num=$num";
	mysqli_query($con, $sql);
?>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
				<?=$content?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>
				<li><button onclick="location.href='board_form.php?num=<?=$num?>&page=<?=$page?>&bmode=<?=$bmode_update?>'">수정</button></li>
				<li><button onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<li><button onclick="location.href='board_form.php?bmode=<?=$bmode_insert?>'">글쓰기</button></li>
				<li><button onclick="location.href='board_form.php?bmode=<?=$bmode_insert?>'">답변달기</button></li>
		</ul>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
