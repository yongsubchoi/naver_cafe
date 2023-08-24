// 댓글 및 답글쓰기 버튼의 이벤트 처리
document.addEventListener("DOMContentLoaded", function () {
	const commentForms = document.querySelectorAll(".comment_form");

	if (commentForms) {
		commentForms.forEach(function (commentForm) {
			const coCommentButton = commentForm.querySelector(".write_co_comment");
			const coCommentForm = commentForm.querySelector(".co_comment_form");
			const cancelButton = coCommentForm.querySelector(".coco_cancel_button");

			if (coCommentButton && coCommentForm) {
				coCommentButton.addEventListener("click", function () {
					coCommentForm.style.display = "block";
				});

				cancelButton.addEventListener("click", function () {
					coCommentForm.style.display = "none";
				});
			}
		});
	}
});
