<!DOCTYPE html>
<html>

<head>
  <title>title</title>
  <link rel="stylesheet" href="<?php echo base_url('public/views/userMgmt/css/pwdSearch.css'); ?>">
</head>

<body>
  <div class="container">
    <div class="back_btn">
      <button id="goBackBtn">
        <img src="/public/img/arrow.jpg">
      </button>
    </div>

    <div class="pwdSearch_form">
      <div class="pwdSearch_logo">비밀번호 찾기</div>
      <div></div>
      <?php echo validation_errors(); ?>
      <?php echo form_open('userMgmt/PwdSearch/index'); ?>

      <div class="input_form">

        <div>
          <input type="text" name="username" id="username" placeholder="아이디" class="login_input_id" required>
        </div>

        <div>
          <select name="security_question_id" id="security_question_id" class="signUp_input_question" required>
            <option value="">분실 시 본인 확인 질문</option>
            <?php foreach ($questions as $question): ?>
              <option value="<?php echo $question['question_id']; ?>"><?php echo $question['question_text']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div>
          <div>
            <input type="text" name="security_answer" id="security_answer" placeholder="질문 답변" class="signUp_input_answer" required>
            <button type="button" id="check_answer_btn">확인</button>
          </div>
          <div id="question_status" style="color: red; display: none;">질문의 답이 일치하지 않습니다.</div>
        </div>

        <div>
          <!-- 확인 버튼을 눌러서 비교 통과 시 아래의 input에 접근할 수 있도록 해야함. -->
          <input type="password" name="password_hash" id="password_hash" placeholder="새로운 비밀번호" class="new_pwd_input"
            required>
        </div>

        <div>
          <input type="password" name="password_check" id="password_hash_check" placeholder="새로운 비밀번호 확인"
            class="new_pwd_input_check" required>
          <!-- 질문의 답이 일치하지 않습니다. 표시할 부분 -->
          
        </div>

      </div>

      <div class="change_pwd_btn_style">
        <button type="submit" class="change_pwd_btn">비밀번호 변경</button>
      </div>

      </form>
    </div>

  </div>
</body>

<script src="<?php echo base_url('public/views/userMgmt/js/backBtn.js'); ?>"></script>
<script src="<?php echo base_url('public/views/userMgmt/js/pwdSearch.js'); ?>"></script>

</html>