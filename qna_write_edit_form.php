<?php
// session_start();
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";

//*****************************************************
$num=$id=$subject=$content=$day=$hit="";
$mode="insert";
$checked="";
$disabled="";
//*****************************************************
// $id= $_SESSION['userid'];

// 수정글쓰기, 답변글쓰기, New글쓰기 세부분으로 분류했음
if((isset($_GET["mode"])&&$_GET["mode"]=="update")
  ||(isset($_GET["mode"])&&$_GET["mode"]=="response") ){

    $mode=$_GET["mode"];//$mode="update"or"response"
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);

    //update 이면 해당된글, response이면 부모의 해당된글을 가져옴.
    $sql="SELECT * from `qna` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);

    $id=$row['id'];
    $subject= htmlspecialchars($row['subject']);
    $content= htmlspecialchars($row['content']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $day=$row['regist_day'];
    $is_html=$row['is_html'];
    $checked=($is_html=="y")? ("checked"):("");
    $hit=$row['hit'];
    if($mode == "response"){
      $subject="[re]".$subject;
      $content="re>".$content;
      $content=str_replace("<br>", "<br>▶",$content);
      $disabled="disabled";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="./js/modernizr.custom.min.js"></script>
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script src="./js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="./js/slide.js?ver=1"></script>
    <link rel="stylesheet" type="text/css" href="./css/make_common_qna.css">
    <link rel="stylesheet" type="text/css" href="./css/make_board.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/slide_image_main.css">
    <!-- <link rel="stylesheet" href="./css/common.css"> -->
    <link rel="stylesheet" href="./css/greet.css">
    <script type="text/javascript" src="./js/member_form.js"></script>
    <title></title>
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
      Q&A 내용
    </h3>


    <div id="wrap">
      <div id="content" style="font-size:12px;">
       <div id="col2">
         <form name="board_form" action="dml_board.php?mode=<?=$mode?>" method="post">
          <input type="hidden" name="num" value="<?=$num?>">
          <input type="hidden" name="hit" value="<?=$hit?>">
          <div id="write_form" style="font-size:12px">
              <div class="write_line"></div>
              <div id="write_row1">
                <div class="col1">아이디</div>
                <div class="col2"><?=$id?></div>
                <div class="col3"><input type="checkbox" id="is_html_ok" name="is_html" value="y" <?=$checked?> <?=$disabled?> >HTML 쓰기</div>
              </div><!--end of write_row1  -->
              <div class="write_line"></div>
              <div id="write_row2">
                <div class="col1">제&nbsp;&nbsp;목</div>
                <div class="col2"><input type="text" name="subject" value=<?=$subject?>></div>
              </div><!--end of write_row2  -->
              <div class="write_line"></div>

              <div id="write_row3">
                <div class="col1">내&nbsp;&nbsp;용</div>
                <div class="col2"><textarea name="content" rows="15" cols="79"><?=$content?></textarea>  </div>
              </div><!--end of write_row3  -->
              <div class="write_line"></div>
            </div><!--end of write_form  -->

            <div id="write_button">
              <!-- 완료버튼 및 목록버튼 -->
              <button onclick="document.getElementById("is_html_ok").disabled=false">완료</button>
              <!-- <input type="image" onclick="document.getElementById("is_html_ok").disabled=false">&nbsp; -->
              <a href="./qna_list.php"><button>목록</button></a>

            </div><!--end of write_button-->
         </form>
      </div><!--end of col2  -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
      </div> <!-- board_box -->
        </section>
        <footer>
            <?php include "footer.php";?>
        </footer>
  </body>
</html>
