document.addEventListener('DOMContentLoaded', function () {
  const userEmailInput = document.getElementById('email');
  const checkUserEmailBtn = document.getElementById('check_userEmail_btn');
  const userEmailStatus = document.getElementById('userEmail_status');

  checkUserEmailBtn.addEventListener('click', function () {
    const userEmail = userEmailInput.value.trim();
    if (userEmail === '') {
      // 아무런 이메일이 입력되지 않았을 때는 아무 메시지도 보여주지 않습니다.
      userEmailStatus.textContent = '';
      return;
    }

    // Ajax를 사용하여 서버에 이메일이 존재하는지 확인합니다.
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.exists) {
          // 이미 존재하는 이메일일 경우
          userEmailStatus.textContent = '이미 존재하는 이메일입니다.';
          userEmailStatus.style.color = 'red';
          // 회원가입 버튼 비활성화
          document.getElementsByClassName("signUp_btn")[0].setAttribute("disabled", true);
        } else {
          // 사용 가능한 이메일일 경우
          userEmailStatus.textContent = '사용 가능한 이메일입니다.';
          userEmailStatus.style.color = 'green';
          // 회원가입 버튼 활성화
          document.getElementsByClassName("signUp_btn")[0].removeAttribute("disabled");
          // 질문 답변 활성화
          document.getElementById('security_answer').removeAttribute("disabled");
        }
      }
    };
    xhr.open('POST', '/userMgmt/SignUp/checkUserEmail', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('email=' + encodeURIComponent(userEmail));
  });
});
