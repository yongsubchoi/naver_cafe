jQuery(document).ready(function () {
  // 현재 경로를 저장할 변수
  var currentPath = window.location.pathname;  

  // #cafe_info_link와 #my_activity_link에 대한 click 이벤트 핸들러 제거
  jQuery('#cafe_info_link, #my_activity_link').off('click');

  // #cafe_info_link에 click 이벤트 핸들러 추가
  jQuery('#cafe_info_link').click(function () {
    if (currentPath === '/') {
      loadContent('cafeInfo');
    } else {
      detailLoadContent('cafeInfo');
    }
  });

  // #my_activity_link에 click 이벤트 핸들러 추가
  jQuery('#my_activity_link').click(function () {
    if (currentPath === '/') {
      loadContent('myActivity');
    } else {
      detailLoadContent('myActivity');
    }
  });
});

//* Index(메인화면) 처리
function loadContent(view) {
  jQuery.ajax({
    url: 'Index/load_' + view,
    type: 'GET',
    success: function (data) {
      jQuery('#content_div').html(data);
    },
    error: function () {
      console.error('내용을 로드하는 도중 오류가 발생했습니다.');
    }
  });
}

//* 게시글 상세 조회
// readPostsDetails 처리
function detailLoadContent(view) {
  jQuery.ajax({
    url: '/posts/ReadPostsDetails/load_' + view,
    type: 'GET',
    success: function (data) {
      jQuery('#content_div').html(data);
    },
    error: function () {
      console.error('내용을 로드하는 도중 오류가 발생했습니다.');
    }
  });
}

// 로그아웃 버튼 클릭 이벤트를 처리하는 함수 (Event Delegation)
jQuery(document).on('click', '#logout_btn', function () {
  var currentPath = window.location.pathname;

  // 현재 경로에 따라 로그아웃을 처리하는 URL을 설정
  var logoutUrl = currentPath === '/' ? 'Index/logout' : 'posts/ReadPostsDetails/logout';
  
  // AJAX 요청을 보냄
  jQuery.ajax({
    url: logoutUrl, // 로그아웃을 처리하는 서버 메서드의 URL
    type: 'POST',
    success: function (data) {
      // 로그아웃이 성공하면 홈페이지로 이동
      alert('로그아웃 되었습니다.');
      window.location.href = 'http://localhost'; // 홈페이지 URL
    },
    error: function () {
      console.error('로그아웃 중 오류가 발생했습니다.');
    }
  });
});