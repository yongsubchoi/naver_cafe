$(document).ready(function() {
  $('.like_button').on('click', function() {
      console.log("click");
      var $button = $(this); // 현재 클릭한 버튼
      var postId = $button.data('post_id');
      $.ajax({
          type: 'POST',
          url: '/posts/ReadPostsDetails/toggle_like',
          data: {
              post_id: postId
          },
          success: function(response) {
              console.log(response);
              if (response === 'liked') {
                  $button.html('<span class="liked_icon">&#x2764;</span>');
              } else if (response === 'unliked') {
                  $button.html('<span class="like_icon">&#x2661;</span>');
              }
          }
      });
  });
});