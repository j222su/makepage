<?php
//session_start();
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/ansisung/lib/create_table.php";
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
    <link rel="stylesheet" type="text/css" href="./css/make_common.css">
    <link rel="stylesheet" type="text/css" href="./css/make_board.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/slide_image_main.css">
    <link rel="stylesheet" href="./css/greet.css">
    <!-- <link rel="stylesheet" href="./css/common.css"> -->
    <title></title>
  </head>
  <body>
    <header>
        <?php include "header.php";?>
    </header>

    <?php
    if (!$userid )
    {
      echo("<script>
          alert('로그인 후 이용해주세요!');
          history.go(-1);
          </script>
        ");
    // exit; php명령어이다.
    }
    create_table($conn,'qna');//가입인사게시판테이블생성

    define('SCALE', 10);
    //*****************************************************
    $sql=$result=$total_record=$total_page=$start="";
    $row="";
    $memo_id=$memo_num=$memo_date=$memo_nick=$memo_content="";
    $total_record=0;
    //*****************************************************

    if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
      //제목, 내용, 아이디
      $find = test_input($_POST["find"]);
      $search = test_input($_POST["search"]);
      $q_search = mysqli_real_escape_string($conn, $search);
      $sql="SELECT * from `qna` where $find like '%$q_search%' order by num desc;";
    }else{
      $sql="SELECT * from `qna` order by group_num desc, ord asc;";
    }

    $result=mysqli_query($conn,$sql);
    $total_record=mysqli_num_rows($result);
    $total_page=($total_record % SCALE == 0 )?
    ($total_record/SCALE):(ceil($total_record/SCALE));

    //2.페이지가 없으면 디폴트 페이지 1페이지
    if(empty($_GET['page'])){
      $page=1;
    }else{
      $page=$_GET['page'];
    }

    //3.현재페이지 시작번호계산함.
    $start=($page -1) * SCALE;
    //4. 리스트에 보여줄 번호를 최근순으로 부여함.
    $number = $total_record - $start;
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
        <h3>
          Q&A > 목록보기
      </h3>
    <div id="wrap">
      <div id="content" style="font-size:12px">
         <form name="board_form" action="qna_list.php?mode=search" method="post">
           <div id="list_search">
             <div id="list_search1">총 <?=$total_record?>개의 게시물이 있습니다.</div>
             <div id="list_search2"></div>
             <div id="list_search3">
               <select  name="find">
                 <option value="subject">제목</option>
                 <option value="content">내용</option>
                 <option value="id">아이디</option>
               </select>
             </div><!--end of list_search3  -->
             <div id="list_search4"><input type="text" name="search"></div>
             <div id="list_search5"><button>검색하기</button></div>
           </div><!--end of list_search  -->
         </form>
         <div id="clear"></div>
         <div id="list_top_title">
           <ul>
             <li id="list_title1">번호</li>
             <li id="list_title2">제목</li>
             <li id="list_title3">글쓴이</li>
             <li id="list_title4">등록일</li>
             <li id="list_title5">조회</li>
           </ul>
         </div><!--end of list_top_title  -->

         <div id="list_content" style="font-size:12px">

         <?php
          for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $num=$row['num'];
            $id=$row['id'];
            $name=$row['name'];
            $nick=$row['nick'];
            $hit=$row['hit'];
            $date= substr($row['regist_day'],0,10);
            $subject=$row['subject'];
            $subject=str_replace("\n", "<br>",$subject);
            $subject=str_replace(" ", "&nbsp;",$subject);
            $depth=(int)$row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
            $space="";
            for($j=0;$j<$depth;$j++){
              $space="&nbsp;&nbsp;".$space;
            }
        ?>
            <div id="list_item">
              <div id="list_item1"><?=$number?></div>
              <div id="list_item2">
                  <a href="./qna_view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$space.$subject?></a>
              </div>
              <div id="list_item3"><?=$id?></div>
              <div id="list_item4"><?=$date?></div>
              <div id="list_item5"><?=$hit?></div>
            </div><!--end of list_item -->
            <div id="memo_content"><?=$memo_content?></div>
        <?php
            $number--;
         }//end of for
        ?>


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

      <div id="button">
        <!--목록 버튼  -->
      <button onclick="./qna_list.php?page=<?=$page?>">목록</button>
        <!-- <a href="./list.php?page=<?=$page?>">목록</a> -->
        <?php
          //세션아디가 있으면 글쓰기 버튼을 보여줌.
          if(!empty($_SESSION['userid'])){
          echo '<a href="qna_write_edit_form.php"><button>글쓰기</button></a>';
          }
        ?>
      </div><!--end of button -->
      </div><!--end of list content -->
    </div><!--end of wrap  -->
  </div> <!-- board_box -->
        </section>
        <footer>
            <?php include "footer.php";?>
        </footer>
  </body>
</html>
