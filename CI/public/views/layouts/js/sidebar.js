//* Index(메인화면) 처리
function loadContent(view) {
  $.ajax({
      url: 'Index/load_' + view,
      type: 'GET',
      success: function (data) {
          $('#content_div').html(data);
      },
      error: function () {
          console.error('내용을 로드하는 도중 오류가 발생했습니다.');
      }
  });
}
$(document).ready(function () {
  // 페이지가 로드될 때 기본적으로 '카페정보'를 보여주도록 한다.
  loadContent('cafeinfo');

  $('#cafe_info_link').click(function () {
      loadContent('cafeInfo');
  });

  $('#my_activity_link').click(function () {
      loadContent('myActivity');
  });
});
// 로그아웃 버튼 클릭 이벤트를 처리하는 함수 (Event Delegation)
$(document).on('click', '#logout_btn', function () {
  // AJAX 요청을 보냄
  $.ajax({
    url: 'Index/logout', // 로그아웃을 처리하는 서버 메서드의 URL
    type: 'POST',
    success: function (data) {
      // 로그아웃이 성공하면 홈페이지로 이동
      window.location.href = 'http://localhost'; // 홈페이지 URL
    },
    error: function () {
      console.error('로그아웃 중 오류가 발생했습니다.');
    }
  });
});



//* 게시글 상세 조회
// readPostsDetails 처리
function detailLoadContent(view) {
  $.ajax({
      url: 'ReadPostsDetails/load_' + view,
      type: 'GET',
      success: function (data) {
          $('#content_div').html(data);
      },
      error: function () {
          console.error('내용을 로드하는 도중 오류가 발생했습니다.');
      }
  });
}
$(document).ready(function () {
  // 페이지가 로드될 때 기본적으로 '카페정보'를 보여주도록 한다.
  detailLoadContent('cafeinfo');

  $('#cafe_info_link').click(function () {
    detailLoadContent('cafeInfo');
  });

  $('#my_activity_link').click(function () {
    detailLoadContent('myActivity');
  });
});
// 로그아웃 버튼 클릭 이벤트를 처리하는 함수 (Event Delegation)
$(document).on('click', '#logout_btn', function () {
  // AJAX 요청을 보냄
  $.ajax({
    url: 'ReadPostsDetails/logout', // 로그아웃을 처리하는 서버 메서드의 URL
    type: 'POST',
    success: function (data) {
      // 로그아웃이 성공하면 홈페이지로 이동
      window.location.href = 'http://localhost'; // 홈페이지 URL
    },
    error: function () {
      console.error('로그아웃 중 오류가 발생했습니다.');
    }
  });
});