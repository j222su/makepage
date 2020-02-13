$(document).ready(function() {
  $btnAssign=$("#btnAssign"), $btnLogin=$("#btnLogin");

  $btnAssign.click(function () {
    $(location).attr('href', 'member_form.php');
  });

  $btnLogin.click(function () {
    var inputId=document.getElementById("inputId");
    var inputPw=document.getElementById("inputPw");
    if(inputId.value ==="" || inputPw.value==="") {
      alert("아이디와 비밀번호를 입력해주세요");
    } else {
      document.make_login.submit();
    }
  });


});
