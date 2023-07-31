<!DOCTYPE html>
<html>

<head>
  <title>title</title>
  <link rel="stylesheet" href="<?php echo base_url('public/views/userMgmt/css/signUp.css'); ?>">
</head>

<body>
  <div class="container">
    <div class="back_btn">
      <button id="goBackBtn">
        <img src="/public/img/arrow.jpg">
      </button>
    </div>

    <div class="signUp_form">
      <div class="signUp_logo">회원가입</div>

      <?php echo validation_errors(); ?>
      <?php echo form_open('userMgmt/SignUp/index') ?>
      <div class="signUp_upload_pic_style">
        <div class="signUp_upload_pic">
          <label for="profile_picture">+</label>
          <input type="file" id="profile_picture" name="profile_picture_path" accept="img/*" style="display:none">
          <!-- <span id="upload_icon">+</span> -->
          <img id="preview_image" src="#" alt="프로필 사진 미리보기" style="display:none">
        </div>
      </div>

      <div>
        <div id="username_status"></div>
        <div>
          <input type="text" name="username" id="username" placeholder="아이디" class="signUp_input_id" required>
          <button type="button" id="check_username_btn">중복확인</button>
        </div>

      </div>
      <div>
        <input type="password" name="password_hash" id="password_hash" placeholder="비밀번호" class="signUp_input_pwd"
          required>
      </div>
      <div>
        <input type="password" name="password_check" id="password_check" placeholder="비밀번호 확인"
          class="signUp_input_pwd_check" required>
        <div id="password_status"></div>
      </div>
      <div>
        <input type="email" name="email" placeholder="e-mail" class="signUp_input_email" required>
      </div>
      <div>
        <select name="security_question_id" class="signUp_input_question" required>
          <option value="">분실 시 본인 확인 질문</option>
          <?php foreach ($questions as $question): ?>
            <option value="<?php echo $question['question_id']; ?>"><?php echo $question['question_text']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <input type="text" name="security_answer" placeholder="질문 답변" class="signUp_input_answer" required>
      </div>
      <div class="signUp_btn_style">
        <button type="submit" class="signUp_btn">회원가입</button>
      </div>
      </form>
    </div>
  </div>
</body>

<script src="<?php echo base_url('public/views/userMgmt/js/signUp.js'); ?>"></script>
<script src="<?php echo base_url('public/views/userMgmt/js/checkUsername.js'); ?>"></script>

</html>