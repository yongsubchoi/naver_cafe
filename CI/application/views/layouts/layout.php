<!DOCTYPE html>
<html>

<head>
  <title>title</title>
  <link rel="stylesheet" href="<?php echo base_url('public/css/styles.css'); ?>">
</head>

<body>
  <header>
    <!-- 로그인, 회원가입 부분 -->
    <div class="login_signUp_style">
      <div></div>
      <div>
        <span>로그인</span>
        <span>회원가입</span>
      </div>
    </div>
    <!-- 카페 대문 부분 -->
    <div class="cafe_door">
      카페대문
    </div>

  </header>

  <!-- 검색 창 부분 -->
  <div class="search_section">
    <div></div>
    <!-- 검색 창 -->
    <div class="search_bar">
      <div></div>
      <div class="search_btn">
        <p>검색</p>
      </div>
    </div>
  </div>

  <!-- 메인 부분 -->
  <div class="main_section">
    <!-- 사이드바 부분 -->
    <div class="side_bar_section">
      <!-- 사이드바 -->
      <div class="side_bar">
        사이드바 부분
      </div>
    </div>
    
    <?= $content ?>
  </div>

  <footer>
    <div></div>
    <!-- 푸터 부분 -->
    <div class="footer_logo">
      <div style="margin-left: 20px">재권의 개발 카페</div>
      <div style="margin-left: 10px">http://localhost/cafe</div>
    </div>
  </footer>
</body>

</html>