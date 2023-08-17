$(document).ready(function () {
	$(".like_button").on("click", function () {
		var $button = $(this); // 현재 클릭한 버튼
		var postId = $button.data("post_id");
		var likeCountElement = $(".like_count[data-post_id='" + postId + "']");

		$.ajax({
			type: "POST",
			url: "/posts/ReadPostsDetails/toggle_like",
			data: {
				post_id: postId,
			},
			success: function (response) {
				console.log(response);
				if (response === "liked" || response === "unliked") {
					$.ajax({
						type: "GET",
						url: "/posts/ReadPostsDetails/get_like_count/" + postId,
						success: function (likeCount) {
							likeCountElement.text(likeCount);
						},
					});
				}
				if (response === "liked") {
					$button.html('<span class="liked_icon">&#x2764;</span> 좋아요');
				} else if (response === "unliked") {
					$button.html('<span class="like_icon">&#x2661;</span> 좋아요');
				}
			},
		});
	});
});
