// $(document).ready(function() {
//   $('.like_button').on('click', function() {
//     var postId = <?php echo $posts['id']; ?>;
//     $.ajax({
//       type: 'POST',
//       url: '<?php echo base_url('posts/ReadPostsDetails/toggleLike'); ?>',
//       data: {
//         post_id: postId
//       },
//       success: function(response) {
//         if (response === 'liked') {
//           $('.like_button').html('<span class="liked_icon">&#x2764;</span>');
//         } else if (response === 'unliked') {
//           $('.like_button').html('<span class="like_icon">&#x2661;</span>');
//         }
//       }
//     });
//   });
// });
