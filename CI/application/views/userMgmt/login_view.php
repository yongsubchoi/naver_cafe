<!DOCTYPE html>
<html>

<head>
  <title>title</title>
  <link rel="stylesheet" href="<?php echo base_url('public/views/userMgmt/css/login.css'); ?>">
</head>

<body>
  <div class="container">
    <div class="back_btn">
      <button id="goBackBtn">
        <img src="/public/img/arrow.jpg">
      </button>
    </div>

    <div class="login_form">
      <div class="login_logo">로그인</div>
      <div></div>
      <?php echo validation_errors(); ?>
      <?php echo form_open('userMgmt/Login/index'); ?>

      <div class="id_pwd_input">
        <div>
          <input type="text" name="username" id="username" placeholder="아이디" class="login_input_id" required>
        </div>
        <div>
          <input type="password" name="password_hash" id="password_hash" placeholder="비밀번호" class="login_input_pwd"
            required>
        </div>
        <div class="login_signUp_style">
          <a href="IdSearch">아이디 찾기</a>
          <span>/</span>
          <a href="PwdSearch">비밀번호 찾기</a>
        </div>
      </div>

      <div class="login_btn_style">
        <button type="submit" class="login_btn">로그인</button>
      </div>

      </form>
    </div>

  </div>
</body>

<script src="<?php echo base_url('public/views/userMgmt/js/login.js'); ?>"></script>

</html>