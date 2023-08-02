// '확인' 버튼 클릭 시 이벤트 처리
document.getElementById("check_answer_btn").addEventListener("click", function () {
  var username = document.getElementById("username").value;
  var security_question_id = document.getElementById("security_question_id").value;
  var security_answer = document.getElementById("security_answer").value;

  // AJAX를 통해 서버로 데이터를 전송하여 일치하는지 확인
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.match) {
          // 일치하는 경우
          document.getElementById("question_status").style.display = "none";
          document.getElementById("password_hash").removeAttribute("disabled");
          document.getElementById("password_hash_check").removeAttribute("disabled");
          document.getElementsByClassName("change_pwd_btn")[0].removeAttribute("disabled");
        } else {
          // 일치하지 않는 경우
          document.getElementById("question_status").style.display = "block";
          document.getElementById("password_hash").setAttribute("disabled", "disabled");
          document.getElementById("password_hash_check").setAttribute("disabled", "disabled");
          document.getElementsByClassName("change_pwd_btn")[0].setAttribute("disabled", "disabled");
        }
      } else {
        console.error("Error:", xhr.status);
      }
    }
  };

  // 이 부분에서 서버 주소를 직접 설정해야 합니다.
  // 예를 들어, localhost의 경우 아래와 같이 설정할 수 있습니다.
  var serverURL = "http://localhost/userMgmt/PwdSearch/check_answer";
  xhr.open("POST", serverURL, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(
    "username=" +
    encodeURIComponent(username) +
    "&security_question_id=" +
    encodeURIComponent(security_question_id) +
    "&security_answer=" +
    encodeURIComponent(security_answer)
  );
});
