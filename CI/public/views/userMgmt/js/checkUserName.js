document.addEventListener('DOMContentLoaded', function () {
  const usernameInput = document.getElementById('username');
  const checkUsernameBtn = document.getElementById('check_username_btn');
  const usernameStatus = document.getElementById('username_status');

  checkUsernameBtn.addEventListener('click', function () {
    const username = usernameInput.value.trim();
    if (username === '') {
      // 아무런 아이디가 입력되지 않았을 때는 아무 메시지도 보여주지 않는다.
      usernameStatus.textContent = '';
      return;
    }

    // Ajax를 사용하여 서버에 아이디가 존재하는지 확인
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.exists) {
          // 이미 존재하는 아이디일 경우
          usernameStatus.textContent = '이미 존재하는 아이디입니다.';
          usernameStatus.style.color = 'red';
        } else {
          // 사용 가능한 아이디일 경우
          usernameStatus.textContent = '사용 가능한 아이디입니다.';
          usernameStatus.style.color = 'green';
          // 회원가입 버튼 활성화
          document.getElementsByClassName("signUp_btn")[0].removeAttribute("disabled");
          // 비밀번호 입력 활성화
          document.getElementById("password_hash").removeAttribute("disabled");
          // 비밀번호 확인 입력 활성화
          document.getElementById("password_check").removeAttribute("disabled");
        }
      }
    };
    xhr.open('POST', '/userMgmt/SignUp/checkUsername', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('username=' + encodeURIComponent(username));
  });
});
