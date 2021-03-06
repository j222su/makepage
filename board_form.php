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
<script>
  function check_input() {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
<?php
  $bmode=$_GET["bmode"];
if($bmode==="bmode_insert") {
  $mode = "insert";
  $subject="";
  $content="";
	$file_name="";
} else if($bmode==="bmode_update") {
  $mode = "modify";
  $num  = $_GET["num"];
	$page = $_GET["page"];
	$con = mysqli_connect("localhost", "root", "123456", "sample");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$name       = $row["name"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name  = $row["file_name"];
}



  // if(isset($_GET["bmode"])) {
  //   $bmode=$_GET["bmode"];
  // } else {
  //   $bmode="1";
  // }

	if (!$userid )
	{
		echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
// exit; php명령어이다.
	}
?>
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
	    <h3 id="board_title">
	    		게시판 > 글 쓰기
		</h3>

<?php
if($mode=="modify") {
  ?>
  <form  name="board_form" method="post" action="board_insert_and_modify.php?mode=<?=$mode?>&num=<?=$num?>&page=<?=$page?>"
  enctype="multipart/form-data">
<?php
} else {

?>
  <form  name="board_form" method="post" action="board_insert_and_modify.php?mode=<?=$mode?>" enctype="multipart/form-data">
    <?php
}
 ?>


	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일</span>
              <span class="col2"><?=$file_name?></span>
			        <span class="col2"><input type="file" name="upfile"></span>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
