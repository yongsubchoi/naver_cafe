<!DOCTYPE html>
<html>

<head>
  <title>title</title>
  <link rel="stylesheet" href="<?php echo base_url('public/views/layouts/css/styles.css'); ?>">
</head>

<body>
  <header>
    <!-- 로그인, 회원가입 부분 -->
    <div class="login_signUp_style">
      <div></div>
      <div>
        <a href="userMgmt/Login">로그인</a>
        <a href="userMgmt/SignUp">회원가입</a>
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
  <main class="main_section">
    <!-- 사이드바 부분 -->
    <div class="side_bar_section">
      <!-- 사이드바 -->
      <div class="side_bar">
        <div class="cafe_info">카페정보/나의활동</div>
        <div class="write_btn">게시글작성</div>
        <div class="board_category">게시판분류</div>
        <div class="lastest_posts">최근댓닷글</div>
      </div>
    </div>
    
    <?= $content ?>
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

</html>