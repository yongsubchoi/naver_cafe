<!DOCTYPE html>
<html>

<head>
  <title>title</title>
  <link rel="stylesheet" href="<?php echo base_url('public/views/userMgmt/css/idSearch.css'); ?>">
</head>

<body>
  <div class="container">

    <div class="back_btn">
      <button id="goBackBtn">
        <img src="/public/img/arrow.jpg">
      </button>
    </div>

    <div class="idSearch_form">
      <div class="idSearch_logo">아이디 찾기</div>
      <div></div>
      <?php echo validation_errors(); ?>
      <?php echo form_open('userMgmt/IdSearch/index'); ?>

      <div class="input_form">
        <div>
          <div>
            <input type="email" name="email" id="email" placeholder="회원 가입 시 사용한 email" class="signUp_input_email"
              required>
            <button type="button" id="check_email_btn">확인</button>
          </div>
          <div id="email_status"></div>
        </div>

        <div>
          <!-- <input type="text" name="username" id="username" placeholder="가입 아이디" class="login_input_id" required> -->
          <div id="searched_id"></div>
        </div>
      </div>


      <div class="change_pwd_btn_style">
        <button type="submit" class="change_pwd_btn">로그인으로 이동</button>
      </div>

      </form>
    </div>

  </div>
</body>

<script src="<?php echo base_url('public/views/userMgmt/js/backBtn.js'); ?>"></script>

</html>