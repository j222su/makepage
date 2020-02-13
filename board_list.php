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
	    <h3>
	    	게시판 > 목록보기
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
<?php
$bmode_insert = "bmode_insert";
$bmode_update = "bmode_update";

	if (isset($_GET["page"]))
		$page = $_GET["page"];
    //넘어올때 배열로 넘어오는데 get 방식의 page라는 키 값이 존재하는가
	else
		$page = 1;

	$con = mysqli_connect("localhost", "root", "123456", "sample");
	$sql = "select * from board order by num desc";
	$result = mysqli_query($con, $sql); //버퍼라고 할 수 있다.
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale); //반올림은 round  올림 ceil
	else
		$total_page = floor($total_record/$scale) + 1;

	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
     //$i < $total_record; $i++sms 마지막페이지를 위해서 써놓은 것
     //
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      // 레코드셋(data는 무조건 레코드셋)에서 어떤위치를(i) 찾고 싶을 때 쓴다.
      // $result 레코드셋 중에서 10번행으로 이동해라 0~9(1페이지) 10~19(2페이지)
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $num         = $row["num"];
	  $id          = $row["id"];
	  $name        = $row["name"];
	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];
      $hit         = $row["hit"];
      if ($row["file_name"])
      	$file_image = "<img src='./img/file.gif'>";
      else
      	$file_image = " ";
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col4"><?=$file_image?></span>
					<span class="col5"><?=$regist_day?></span>
					<span class="col6"><?=$hit?></span>
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
		$new_page = $page-1;
		echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
		}
  }//end of for
   	if ($total_page>=2 && $page != $total_page) //현재페이지가 마지막 페이지랑 같지 않을 때 보인다.
   	{
		$new_page = $page+1;
		echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->
			<ul class="buttons">
				<li><button onclick="location.href='board_list.php'">목록</button></li>
				<li>
<?php
    if($userid) {
?>
					<button onclick="location.href='board_form.php?bmode=<?=$bmode_insert?>'">글쓰기</button>
<?php
	} else {
?>
					<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
	}
?>
				</li>
			</ul>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
