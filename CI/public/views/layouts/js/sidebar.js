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
  // 페이지가 로드될 때 기본적으로 '카페정보'를 보여주도록 g한다.
  loadContent('cafeinfo');

  $('#cafe_info_link').click(function () {
      loadContent('cafeInfo');
  });

  $('#my_activity_link').click(function () {
      loadContent('myActivity');
  });
});
