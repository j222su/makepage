<?php
// session_start();
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
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
    <script type="text/javascript" src="./js/member_form.js?ver=1"></script>
    <title></title>
  </head>
  <body>
    <header>
      <?php include "header.php";?>
    </header>
    <?php
    //*****************************************************
    $num=$id=$subject=$content=$day=$hit="";
    //*****************************************************

    if(empty($_GET['page'])){
      $page=1;
    }else{
      $page=$_GET['page'];
    }

    if(isset($_GET["num"])&&!empty($_GET["num"])){
        $num = test_input($_GET["num"]);
        $hit = test_input($_GET["hit"]);
        $q_num = mysqli_real_escape_string($conn, $num);

        $sql="UPDATE `qna` SET `hit`=$hit WHERE `num`=$q_num;";
        $result = mysqli_query($conn,$sql);
        if (!$result) {
          die('Error: ' . mysqli_error($conn));
        }

        $sql="SELECT * from `qna` where num ='$q_num';";
        $result = mysqli_query($conn,$sql);
        if (!$result) {
          die('Error: ' . mysqli_error($conn));
        }
        $row=mysqli_fetch_array($result);
        $id=$row['id'];
        $subject= htmlspecialchars($row['subject']);
        $content= htmlspecialchars($row['content']);
        // $subject=str_replace("\n", "<br>",$subject);
        // $content=str_replace("\n", "<br>",$content);
        // $subject=str_replace(" ", "&nbsp;",$subject);
        // $content=str_replace(" ", "&nbsp;",$content);
        $day=$row['regist_day'];
        $hit=$row['hit'];
        mysqli_close($conn);
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
  	    <h3 class="title">
  			Q&A > 내용보기
  		</h3>



    <div id="wrap">

      <div id="content" style="font-size:12px">

       <div id="col2">
         <div id="write_form_title">내용</div>
         <div class="clear"></div>
            <div id="write_form">
              <div id="write_row1">
                <div class="col1">아이디</div>
                <div class="col2"><?=$id?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  조회 : <?=$hit?> &nbsp;&nbsp;&nbsp; 입력날짜: <?=$day?>
                </div>

              </div><!--end of write_row1  -->
              <div class="write_line"></div>
              <div id="write_row2">
                <div class="col1">제&nbsp;&nbsp;목</div>
                <div class="col2"> <input type="text" name="subject" value="<?=$subject?>" readonly></div>
              </div><!--end of write_row2  -->
              <div class="write_line"></div>

              <div id="write_row3" style="font-size:12px">
                <div class="col1">내&nbsp;&nbsp;용</div>
                <div class="col2"> <textarea name="content" rows="15" cols="79" readonly><?=$content?>
                </textarea></div>
              </div><!--end of write_row3  -->
              <div class="write_line"></div>
            </div><!--end of write_form  -->

            <div id="write_button">
              <!--목록보기 -->
                <a href="./qna_list.php?page=<?=$page?>"><button>목록</button></a>
            <?php
              //세션값이 존재하면 수정기능과 삭제기능부여하기
              if(isset($_SESSION['userid'])){
                if($_SESSION['userid']=="superadmin" || $_SESSION['userid']==$id){
                  echo('<a href="./qna_write_edit_form.php?mode=update&num='.$num.'"><button>수정</button></a>&nbsp;');
                    echo('<button onclick="check_delete('.$num.')">삭제</button> &nbsp;');
                }
              }
              // 세션값이 존재하면 답변기능과 글쓰기 기능부여하기
              if(!empty($_SESSION['userid'])){
                echo '<a href="qna_write_edit_form.php?mode=response&num='.$num.'"><button>답변쓰기</button></a>&nbsp';
                echo '<a href="qna_write_edit_form.php"><button>글쓰기</button></a>';
              }
            ?>

            </div><!--end of write_button-->
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
