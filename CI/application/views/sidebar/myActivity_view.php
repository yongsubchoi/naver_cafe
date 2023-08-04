<!-- 나의 활동 부분 -->
<!-- <div class="cafe_info"> -->
  <!-- <div class="cafe_info_h">카페정보 나의활동</div> -->

  <div class="cafe_info_m">
    <div class="cafe_info_m_style">
      <div class="cafe_info_pic">
        <img src="<?php echo base_url('uploads/profile_pictures/' . $profile_picture_path); ?>" alt="프로필 사진">
      </div>
      <div class="cafe_info_info">
        <span>이름: <?php echo $username; ?></span>
        <span>가입일: <?php echo $created_at; ?></span>
      </div>
    </div>
    <div class="cafe_info_pr">
      <div>내가 쓴 글 보기 1개</div>
      <div>내가 쓴 댓글 보기 2개</div>
    </div>
  </div>

  <div class="cafe_info_f">
    <button type="button" id="logout_btn" class="logOut_btn">로그아웃</button>
  </div>
<!-- </div> -->