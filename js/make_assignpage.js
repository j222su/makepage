$(document).ready(function(){

var $userID=$("#userID"), $btnIdCheck=$("#btnIdCheck"), $pwpw=$("#pwpw"),
 $pwChk=$("#pwChk"), $userName=$("#userName"),
$btnNext=$("#btnNext"), $cPFirst=$("#cPFirst"),
$cPSecond=$("#cPSecond"), $cPThird=$("#cPThird"),
$inputEmail=$("#inputEmail"), $btnNext=$("#btnNext");

  $userID.keyup(function(){
    var str = /^[A-Za-z]{1}[A-Za-z0-9]{4,11}$/;
    var userID=document.getElementById("userID");
    var idSpan=document.getElementById("idSpan");
    if(userID.value.match(str)) {
      idSpan.innerHTML="사용가능한 아이디입니다. 중복확인을 진행해주세요";
    }  else {
      idSpan.innerHTML="띄어쓰기 없이 영어,숫자 혼합 12자리로 만들어주세요.";
      userID.focus();
    }
  });


  $btnIdCheck.click(function() {
    var idSpan=document.getElementById("idSpan");
           if($userID.val()=="") {
             alert("아이디를 입력해주세요");
             userID.focus();
           } else {
             $.ajax({
               url : 'make_member_check_id.php',
               type :'POST',
               data: {userID: $userID.val()}, //key값과 value값
               success : function(data){
                 // var message = data;
                 console.log(data);

                 if(data==="1") {

                   idSpan.innerHTML="중복된 아이디입니다.";

                 } else if (data==="0") {
                    idSpan.innerHTML="사용가능한 아이디입니다.";
                 } else {
                    alert(data+"error입니다.");
                 }
               }
             })
             .done(function(){
               console.log("success");
             })
             .fail(function(){
               console.log("error");
             })
             .always(function(){
               console.log("complete");
             });
           }
  });

  $pwpw.keyup(function() {
    var str = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*])(?=.*[0-9]).{8,16}$/;
    // var str = /^[가-힣]+$/;
    var pwpw=document.getElementById("pwpw");
    var pwSpan=document.getElementById("pwSpan");
    if(pwpw.value.match(str)) {
      pwSpan.innerHTML="사용가능한 비밀번호입니다.";
    } else if(pwpw.value===""){
      pwSpan.innerHTML="";
      } else {
      pwSpan.innerHTML="조건에 맞게 비밀번호를 입력해주세요.";
      // pw.focus();
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
    if(userID.value === "") {
      alert("아이디를 입력해주세요");
    } else if (pwpw.value === "") {
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
      alert("회원가입이 완료되었습니다.");
      document.member_assign.submit();
    }
  });

});
