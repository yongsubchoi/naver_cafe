<!DOCTYPE html>
<html>

<head>
  <title>title</title>
  <link rel="stylesheet" href="<?php echo base_url('public/views/posts/css/styles.css'); ?>">
</head>

<body>
  <header>
    <!-- 로그인, 회원가입 부분 -->
    <div class="login_signUp_style">

    </div>
    <!-- 카페 대문 부분 -->
    <div class="cafe_door">
      카페대문
    </div>

  </header>

  <!-- 메인 부분 -->
  <main class="main_section">
    <!-- 사이드바 부분 -->
    <div class="side_bar_section">
      <!-- 사이드바 -->
      <div class="side_bar">
        <div class="sb_set_anmt">
          <label>
            <input type="checkbox" name="is_notice" id="notice_on" value="on">
            공지로 등록
          </label>
        </div>
        <div class="sb_set_scope_disclosure">
          <label>
            <input type="radio" name="board_category" id="category_all" value="all" checked>
            전체공개
          </label>
          <label>
            <input type="radio" name="board_category" id="category_member" value="member">
            멤버공개
          </label>
        </div>
      </div>
    </div>


  </main>

  <footer>
    <div></div>
    <!-- 푸터 부분 -->
    <div class="footer_logo">
      <div style="margin-left: 20px">재권의 개발 카페</div>
      <div style="margin-left: 10px">http://localhost/cafe</div>
    </div>
  </footer>
</body>

<script src="<?php echo base_url('public/views/posts/js/createPosts.js'); ?>"></script>

</html>