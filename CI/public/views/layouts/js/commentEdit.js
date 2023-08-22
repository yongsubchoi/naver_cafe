$(document).ready(function() {
  $(".editCommentButton").click(function(event) {
    event.preventDefault(); // 기본 동작 막기
    const commentId = $(this).data("comment-id");
    const editForm = $(`#edit-comment-form-${commentId}`);

    // 토글하여 수정 폼 보이게/숨기게 처리
    editForm.toggle();

    // 수정 버튼 클릭 시 해당 댓글의 내용으로 폼 필드를 채움
    if (editForm.is(":visible")) {
      const commentContent = $(`p[data-comment-id="${commentId}"]`).text();
      editForm.find("textarea[name='edited_content']").val(commentContent);
    }
  });

  // 취소 버튼 클릭 시 수정 폼 숨기기
  $(".cancel_button").click(function() {
    const commentId = $(this).closest(".comment_input_area").attr("id").split("-")[3];
    $(`#edit-comment-form-${commentId}`).hide();
  });
});
