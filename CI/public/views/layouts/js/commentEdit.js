/**
 * 게시글 상세조회 페이지 댓글 수정, 삭제 js
 */
$(document).ready(function () {
	$(".editCommentButton").click(function (event) {
		event.preventDefault(); // 기본 동작 막기
		const commentId = $(this).data("comment-id");
		const editForm = $(`#edit-comment-form-${commentId}`);

		// 토글하여 수정 폼 보이게/숨기게 처리
		editForm.toggle();
	});

	// 취소 버튼 클릭 시 수정 폼 숨기기
	$(".cancel_button").click(function () {
		const commentId = $(this)
			.closest(".comment_input_area")
			.attr("id")
			.split("-")[3];
		$(`#edit-comment-form-${commentId}`).hide();
	});

	// 삭제 버튼 클릭 시 동작
	$(".deleteCommentButton").click(function (event) {
		event.preventDefault(); // 기본 동작 막기
		const commentId = $(this).data("comment-id");

		var deleteComment = confirm("댓글을 삭제하시겠습니까?");

		if (deleteComment) {
			// 서버로 삭제 요청 보내기
			$.post(
				`/posts/ReadPostsDetails/delete_comment/${commentId}`,
				function (response) {
					console.log("댓글이 삭제되었습니다.");
					window.location.reload();
				}
			);
		} else {

		}
	});
});
