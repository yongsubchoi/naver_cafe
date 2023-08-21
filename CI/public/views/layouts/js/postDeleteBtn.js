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

document.getElementById("post_list_btn").addEventListener("click", function() {
  window.location.href = "/";
})
