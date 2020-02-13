$(document).ready(function(){

var $userID=$("#userID"), $btnIdCheck=$("#btnIdCheck"), $pwpw=$("#pwpw"),
 $pwChk=$("#pwChk"), $userName=$("#userName"),
$btnNext=$("#btnNext"), $cPFirst=$("#cPFirst"),
$cPSecond=$("#cPSecond"), $cPThird=$("#cPThird"),
$inputEmail=$("#inputEmail"), $btnNext=$("#btnNext");

  $pwpw.keyup(function() {
    var str = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*])(?=.*[0-9]).{8,16}$/;
    var pwpw=document.getElementById("pwpw");
    var pwSpan=document.getElementById("pwSpan");
    if(pwpw.value.match(str)) {
      pwSpan.innerHTML="사용가능한 비밀번호입니다.";
    } else if(pwpw.value===""){
      pwSpan.innerHTML="";
      } else {
      pwSpan.innerHTML="조건에 맞게 비밀번호를 입력해주세요.";
      pw.focus();
    }
  });

  $pwChk.keyup(function (){
    var pwpw=document.getElementById("pwpw");
    var pwChk=document.getElementById("pwChk");
    var pwChkSpan=document.getElementById("pwChkSpan");
    if(pwpw.value===pwChk.value) {
      pwChkSpan.innerHTML="비밀번호가 일치합니다.";
    } else {
      pwChkSpan.innerHTML="비밀번호가 불일치합니다.";
      pwChk.focus();
    }
  });

  $userName.keyup(function () {
    var str = /^[가-힣]+$/;
    var userName=document.getElementById("userName");
    var userNameSpan=document.getElementById("userNameSpan");
    if(userName.value.match(str) || userName.value==="") {
      userNameSpan.innerHTML="";
    } else {
      userNameSpan.innerHTML="한글로 입력해주세요.";
      userName.focus();
    }
  });


  $inputEmail.keyup(function() {
    var str =/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    var inputEmail=document.getElementById("inputEmail");
    var emailSpan=document.getElementById("emailSpan");
    if(inputEmail.value.match(str) || inputEmail.value==="") {
      emailSpan.innerHTML="";
    } else {
      emailSpan.innerHTML="정확한 e-mail 주소를 기입해주세요";
      inputEmail.focus();
    }
  });

  $cPFirst.keyup(function() {
    var cPFirst=document.getElementById("cPFirst");
    var cellPhoneSpan=document.getElementById("cellPhoneSpan");
    if(cPFirst.value==="") {
      cellPhoneSpan.innerHTML="번호를 입력해주세요";
    } else if (cPFirst.value.length >3) {
      cPFirst.value=cPFirst.value.slice(0, 3);
    } else {
      cellPhoneSpan.innerHTML="";
    }
  });

  $cPSecond.keyup(function() {
    var cPSecond=document.getElementById("cPSecond");
    var cellPhoneSpan=document.getElementById("cellPhoneSpan");
    if(cPSecond.value==="") {
      cellPhoneSpan.innerHTML="번호를 입력해주세요";
    } else if (cPSecond.value.length >4) {
      cPSecond.value=cPSecond.value.slice(0, 4);
    } else {
      cellPhoneSpan.innerHTML="";
    }
  });

  $cPThird.keyup(function() {
    var cPThird=document.getElementById("cPThird");
    var cellPhoneSpan=document.getElementById("cellPhoneSpan");
    if(cPThird.value==="") {
      cellPhoneSpan.innerHTML="번호를 입력해주세요";
    } else if (cPThird.value.length >4) {
      cPThird.value=cPThird.value.slice(0, 4);
    } else {
      cellPhoneSpan.innerHTML="";
    }
  });

  $btnNext.click(function(){
    if (pwpw.value === "") {
      alert("비밀번호를 입력해주세요");
    } else if (pwChk.value === ""){
      alert("비밀번호 확인란에 비밀번호를 입력해주세요");
    } else if (userName.value === "") {
      alert("이름을 입력해주세요");
    } else if (inputEmail.value === ""){
      alert("이메일을 입력해주세요");
    } else if (pwChk.value === ""){
      alert("비밀번호 확인란에 비밀번호를 입력해주세요");
    } else if (cPFirst.value==="" || cPSecond.value==="" || cPThird.value==="") {
        alert("휴대폰번호를 입력해주세요");
    } else {
      alert("회원수정이 완료되었습니다.");
      document.member_assign.submit();
    }
  });


// 여기는 css
  var $table=$("table"), $tr=$("tr"), $td=$("td"),
  $tdFirst=$(".tdFirst"), $spanInfo=$(".spanInfo"),
  $insertInput=$("input"), $divInfo=$("#divInfo"),
  $h3=$("h3"), $h4=$("h4"), $divMain=$("#divMain"), $btnNext=$("#btnNext");

  $table.css({
    "border" : "1px solid black",
    "borderCollapse" : "collapse"
  });

  $tr.css({
    "border" : "1px solid lightgray"
  });

  $td.css({
    "padding" : "3px",
    "padding-left" : "10px",
    "padding-right" : "30px"
  });

  $tdFirst.css({
    "background-color" : "#f7f7f7",
    "font-weight" : "bold",
    "color" : "#7e7e7e"
  });

  $spanInfo.css({
    "color" : "red"
  });

  $insertInput.css({
    "margin" : "7px"
  });

  $divInfo.css({
    "border-top" : "1px solid lightgray",
    "border-bottom" : "1px solid lightgray",
    "padding" : "15px",
    "margin" : "0 auto",
    "width" : "50%"
  });

  $h3.css({
    "text-align" : "center",
    "margin-bottom" : "50px"
  });

  $h4.css({
    "margin" : "0px",
    "margin-bottom" : "10px",
    "margin" : "0 auto",
    "width" : "50%"
  });

  $divMain.css({
    "margin" : "0 auto",
    "width" : "50%",
    "margin-top" : "15px",
    "position" : "relative"
  });

  $btnNext.css({
    "position" : "absolute",
    "margin-top" : "10px",
    "margin-bottom" : "50px"
  });

});
