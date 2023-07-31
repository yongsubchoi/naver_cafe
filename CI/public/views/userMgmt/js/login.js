//* 프로필 사진 선택 시 미리보기 처리 과정
// profile_picture라는 아이디에 change시 콜백 함수 실행
document.getElementById("profile_picture").addEventListener("change", function() {
  var reader = new FileReader();
  reader.onload = function(e) {
    document.getElementById("preview_image").style.display = "block";
    document.getElementById("preview_image").setAttribute("src", e.target.result);
    document.getElementById("plus_icon").style.display = "none"; // '+' 아이콘 숨기기
  };
  reader.readAsDataURL(this.files[0]);
});


//* pwd 확인 시 일치, 불일치 텍스트 표출 로직
const passwordInput = document.getElementById("password_hash");
const confirmPwdInput = document.getElementById("password_check");
const passwordStatusDiv = document.getElementById("password_status");

function checkPasswords() {
  const password = passwordInput.value;
  const confirmPassword = confirmPwdInput.value;

  if (confirmPassword === "") {
    passwordStatusDiv.textContent = ""; // 아무런 텍스트가 없도록 설정
  } else if (password === confirmPassword) {
    passwordStatusDiv.textContent = "비밀번호가 일치합니다.";
    passwordStatusDiv.style.color = "green"; // 일치할 경우 초록색 텍스트로 설정
  } else {
    passwordStatusDiv.textContent = "비밀번호가 일치하지 않습니다.";
    passwordStatusDiv.style.color = "red"; // 불일치할 경우 빨간색 텍스트로 설정
  }
}

// 비밀번호 확인 입력란에 입력이 발생할 때마다 함수 호출
confirmPwdInput.addEventListener("input", checkPasswords);
