/**
 * 게시글 상세조회 상단 버튼 관련 js
 * 삭제, 이전글, 다음글, 목록
 */
const deleteBtn = document.getElementById("post_delete_btn");

if (deleteBtn) {
	deleteBtn.addEventListener("click", function (event) {
		event.preventDefault(); // 링크의 기본 동작을 막습니다.

		var confirmbtn = confirm("삭제하시겠습니까?");

		if (confirmbtn) {
			window.location.href = deletePostUrl;
			history.back();
		} else {
		}
	});
}
// 목록으로 가기 버튼
document.getElementById("post_list_btn").addEventListener("click", function() {
  window.location.href = "/";
})