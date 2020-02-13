$(function () {
  var slideshow = $('.slideshow'),
  slideshowSlides = slideshow.find('.slideshow_slides'),
  slides=slideshowSlides.find('a'),
  slidesCount=slides.length,
  nav = slideshow.find('.slideshow_nav'),
  prev=nav.find('.prev'),
  next=nav.find('.next'),
  currentIndex = 0, //현재슬라이드를 첫번째 화면으로 세팅하는 것
  indicator = slideshow.find('.slideshow_indicator');
  interval = 3000, //자동슬라이드 시간
  timer="",
  incrementValue=1,
  //이벤트처리 >> 슬라이드를 가로로 배치시킨다.
  //슬0 왼쪽 0%, 슬1 100%, 슬2 200%, 슬3 300%
  slides.each(function(i){
    var newLeft = (i*100)+'%';
    $(this).css({left: newLeft});
  });

  prev.addClass('disabled'); //첫 번재 화면의 < 사라짐
  indicator.find('a').eq(0).addClass('active'); //첫 번째 화면의 검정색 동그라미

  //슬라이드 화면 이동하는 함수를 생성한다.
  function gotoSlide(index) {
    slideshowSlides.animate({left:(-100*index)+'%'}, 1000, 'easeInOutExpo');
    currentIndex=index;

    if(currentIndex===0) {
      prev.addClass('disabled');
    } else {
      prev.removeClass('disabled');
    }

    if(currentIndex===(slidesCount-1)) {
      next.addClass('disabled');
    } else {
      next.removeClass('disabled');
    }

    indicator.find('a').removeClass('active');
    indicator.find('a').eq(currentIndex).addClass('active');
    //인덱스를 사용하여 원하는 위치의 요소를 가져올 수 있다.
  }

  //이벤트처리 네비게이션 처리진행
  prev.click(function(event){
    event.preventDefault(); //a tag에서 기본기능막기
    if(currentIndex !==0) {
      currentIndex -=1;
    }
    gotoSlide(currentIndex);

  });

  next.click(function(event){
    event.preventDefault(); //a tag에서 기본기능막기
    if(currentIndex !== (slidesCount-1)) {
      currentIndex +=1;
    }
    gotoSlide(currentIndex);
  });


  indicator.find('a').click(function(event){
    event.preventDefault();
    var point=$(this).index();
    gotoSlide(point);
  });

  //자동슬라이드 함수
  //setInterval(일을 하는 함수 구현, 시간)
  function autoDisplayStart() {
    timer=setInterval(function(){
      // 0,1,2,3 -> 2, 1, 0 -> 1, 2, 3

      if(currentIndex ===3 ) {
        incrementValue = -1;
      } else if(currentIndex === 0) {
        incrementValue = 1;
      }
      //0,1,2,3 -> 0, 1, 2, 3 -> 0, 1, 2, 3
      var nextIndex=(currentIndex+1) % slidesCount;
      gotoSlide(nextIndex);
    },interval);
  };

  function autoDisplayStop() {
    clearInterval(timer);
  };

  slideshow.mouseenter(function(event) {
    autoDisplayStop();
  });

  slideshow.mouseleave(function(event) {
    autoDisplayStart();
  });

    autoDisplayStart();
});
