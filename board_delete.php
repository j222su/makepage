<!--
원래 이거 다 php 구문 안 속 php 지운거임
  $num = $_GET["num"];
  $page = $_GET["page"];
  $mode = "delete";
  $con = mysqli_connect("localhost", "root", "123456", "sample");

  function board_delete($num, $page) {
    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $copied_name = $row["file_copied"];

    if ($copied_name)
    {
      $file_path = "./data/".$copied_name;
      unlink($file_path);
      }

      $sql = "delete from board where num = $num";
      mysqli_query($con, $sql);
      mysqli_close($con);
  }

  switch ($mode) {
    case 'delete':
      board_delete($num, $page);
      echo "
  	     <script>
  	         location.href = 'board_list.php?page=$page';
  	     </script>
  	   ";
      break;

    default:
      break;
  }
 -->
 <?php

     $num   = $_GET["num"];
     $page   = $_GET["page"];

     $con = mysqli_connect("localhost", "root", "123456", "sample");
     $sql = "select * from board where num = $num";
     $result = mysqli_query($con, $sql);
     $row = mysqli_fetch_array($result);

     $copied_name = $row["file_copied"];

 	if ($copied_name)
 	{
 		$file_path = "./data/".$copied_name;
 		unlink($file_path);
     }

     $sql = "delete from board where num = $num";
     mysqli_query($con, $sql);
     mysqli_close($con);

     echo "
 	     <script>
 	         location.href = 'board_list.php?page=$page';
 	     </script>
 	   ";
 ?>
