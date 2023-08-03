document.getElementById("check_email_btn").addEventListener("click", function () {
  var email = document.getElementById("email").value;

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.exists) {
          document.getElementById("searched_id").textContent = "가입 아이디: " + response.username;
          document.getElementById("email_status").style.display = "none";
        } else {
          document.getElementById("searched_id").textContent = "";
          document.getElementById("email_status").textContent = "등록된 email이 아닙니다.";
          document.getElementById("email_status").style.display = "block";
        }
      } else {
        console.error("Error:", xhr.status);
      }
    }
  };

  var serverURL = "http://localhost/index.php/userMgmt/IdSearch/check_email";
  xhr.open("POST", serverURL, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("email=" + encodeURIComponent(email));
});
