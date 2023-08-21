// document.addEventListener("DOMContentLoaded", function () {
//   const editButtons = document.querySelectorAll(".editCommentButton");
//   const commentForm = document.querySelector(".comment_input_area"); // 폼을 감싸는 컨테이너 선택
//   const commentTextArea = commentForm.querySelector(".text_area_comment");
//   const formAction = commentForm.querySelector("form").action; // 폼의 action URL 가져오기

//   editButtons.forEach((button) => {
//     button.addEventListener("click", function (event) {
//       event.preventDefault();

//       // 데이터 속성에서 댓글 ID 가져오기
//       const commentId = button.getAttribute("data-comment-id");
//       const commentContent = getCommentContentById(commentId); // 이 함수를 구현합니다

//       // 폼의 action URL 변경하여 해당 댓글 ID 전달
//       commentForm.querySelector("form").action = formAction + '/' + commentId;

//       // 텍스트 영역에 기존 댓글 내용 채우기
//       commentTextArea.value = commentContent;

//       // 댓글 폼 표시
//       commentForm.style.display = "block";
//     });
//   });
// });
