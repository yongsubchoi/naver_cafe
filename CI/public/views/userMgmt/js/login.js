// 뒤로가기 버튼 누를 시 브라우저의 이전 페이지로 돌아가는 기능
document.getElementById("goBackBtn").addEventListener("click", function() {
  history.back();
});