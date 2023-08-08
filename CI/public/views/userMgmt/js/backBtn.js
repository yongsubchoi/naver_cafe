// 뒤로가기 버튼 누를 시 브라우저의 이전 페이지로 돌아가는 기능
document.getElementById("goBackBtn").addEventListener("click", function() {
  var confirmBtn = confirm("취소하시겠습니까?");

  if (confirmBtn) {
    history.back();
  }
});