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
          // 사용자 인증 성공 시 비밀번호 입력 폼 활성화
          document.getElementById("password_hash").removeAttribute("disabled");
          document.getElementById("password_hash_check").removeAttribute("disabled");
          document.getElementsByClassName("change_pwd_btn")[0].removeAttribute("disabled");
        } else {
          // 일치하지 않는 경우
          document.getElementById("question_status").style.display = "block";
          // 사용자 인증 실패 시 비밀번호 입력 폼 비활성화
          document.getElementById("password_hash").setAttribute("disabled", true);
          document.getElementById("password_hash_check").setAttribute("disabled", true);
          document.getElementsByClassName("change_pwd_btn")[0].setAttribute("disabled", true);
        }
      } else {
        console.error("Error:", xhr.status);
      }
    }
  };

  var serverURL = "http://localhost/index.php/userMgmt/PwdSearch/check_answer";
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

// 페이지 로드 시 비밀번호 입력 폼 비활성화
window.onload = function () {
  // 새로운 비밀번호 입력 폼 비활성화
  document.getElementById("password_hash").setAttribute("disabled", true);
  // 새로운 비밀번호 확이 입력 폼 비활성화
  document.getElementById("password_hash_check").setAttribute("disabled", true);
  // 비밀번호 변경 버튼 비활성화
  document.getElementsByClassName("change_pwd_btn")[0].setAttribute("disabled", true);
};

//* pwd 확인 시 일치, 불일치 텍스트 표출 로직
/**
 * todo 필요한 추가 로직
 * ? 비밀번호 이중 체크 만족 시 다음 절차를 진행하게끔(이중 체크 만족 시 비밀번호 변경 가능)
 */
const passwordInput = document.getElementById("password_hash");
const confirmPwdInput = document.getElementById("password_hash_check");
const passwordStatusDiv = document.getElementById("password_status");

function checkPasswords() {
  const password = passwordInput.value;
  const confirmPassword = confirmPwdInput.value;

  if (confirmPassword === "") {
    // 비어있을 경우 아무런 텍스트가 없도록 설정
    passwordStatusDiv.textContent = ""; 
    // 비밀번호 변경 버튼 비활성화
    document.getElementsByClassName("change_pwd_btn")[0].setAttribute("disabled", true);
  } else if (password === confirmPassword) {
    passwordStatusDiv.textContent = "비밀번호가 일치합니다.";
    // 일치할 경우 초록색 텍스트로 설정
    passwordStatusDiv.style.color = "green"; 
    // 비밀번호 변경 버튼 활성화
    document.getElementsByClassName("change_pwd_btn")[0].removeAttribute("disabled");
  } else {
    passwordStatusDiv.textContent = "비밀번호가 일치하지 않습니다.";
    // 불일치할 경우 빨간색 텍스트로 설정
    passwordStatusDiv.style.color = "red"; 
    // 비밀번호 변경 버튼 비활성화
    document.getElementsByClassName("change_pwd_btn")[0].setAttribute("disabled", true);
  }
}

// 비밀번호 확인 입력란에 입력이 발생할 때마다 함수 호출
confirmPwdInput.addEventListener("input", checkPasswords);