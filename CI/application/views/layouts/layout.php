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
    <div>
      <input type="text" name="search_input" id="search_input" placeholder="게시글 검색" class="search_posts">
      <button type="button" id="search_posts_btn">검색</button>
    </div>
  </div>

  <!-- 메인 부분 -->
  <main class="main_section">
    <!-- 사이드바 부분 -->
    <div class="side_bar_section">
      <!-- 사이드바 -->
      <div class="side_bar">
        <!-- 카페 정보 / 나의 활동 부분 -->
        <div class="cafe_info">
          <div class="cafe_info_h">카페정보 나의활동</div>
          
          <div class="cafe_info_m">
            <div class="cafe_info_m_style">
              <div class="cafe_info_pic"></div>
              <div class="cafe_info_info">
                <span>이름: nowkwon97</span>
                <span>가입일: 23.07.14</span>
              </div>
            </div>
            <div class="cafe_info_pr">
              <div>내가 쓴 글 보기 1개</div>
              <div>내가 쓴 댓글 보기 2개</div>
            </div>
          </div>
          
          <div class="cafe_info_f">
            <button type="button" class="logOut_btn">로그아웃</button>
          </div>
        </div>
        <!-- 게시글 작성 부분 -->
        <a href="posts/CreatePosts" class="write_btn">게시글작성</a>
        <!-- 게시글 분류 부분 -->
        <div class="board_category">게시판분류</div>
        <!-- 최신댓닷글 부분 -->
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