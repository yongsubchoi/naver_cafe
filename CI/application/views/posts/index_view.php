<!-- 메인 게시판 부분 -->
<div class="main_posts">

  <div class="t_hr_line"></div>
  <!-- <?php print_r($posts); ?> -->
  <!-- 공지 게시글 -->
  <div class="notice_area">
    <?php foreach ($notice_posts as $post): ?>
      <div class="anmt_area">
        <?php if ($post['is_notice'] == TRUE): ?>
          <!-- 공지 사항 -->
          <div class="notice_style">
            공지
          </div>

          <!-- 게시글 id -->
          <?php if (!$post['is_notice']) { ?>
            <div>
              <?php echo $post['id']; ?>
            </div>
          <?php } ?>

          <!-- 게시글 제목 -->
          <div class="notice_title_style">
            <a href="/posts/ReadPostsDetails/index/<?php echo $post['id'] ?>/">
              <?php echo $post['title']; ?>
            </a>
          </div>

          <!-- 게시글 작성자 -->
          <div class="notice_username_style">
            <?php echo $post['username']; ?>
          </div>

          <!-- 게시글 작성시간 -->
          <div class="notice_created_at_style">
            <?php // 날짜 변환 로직 적용
                $timestamp_created_at = strtotime($post['created_at']);
                $current_time = time();
                // 오늘 날짜라면 H:i 형식
                if (date('Y-m-d', $timestamp_created_at) === date('Y-m-d', $current_time)) {
                  $formatted_date = date('H:i', $timestamp_created_at);
                  // 오늘 날짜가 아니라면 Y.m.d형식
                } else {
                  $formatted_date = date('Y. m. d', $timestamp_created_at);
                }
                echo $formatted_date; ?>
          </div>

          <!-- 게시글 조회수 -->
          <div class="notice_view_count_style">
            <?php echo $post['view_count']; ?>
          </div>

        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- 일반 게시글 -->
  <?php foreach ($posts as $post): ?>
    <div class="posts_style">

      <!-- 게시글 id -->
      <div class="id_style">
        <?php echo $post['id']; ?>
      </div>

      <!-- 게시글 제목 -->
      <div class="title_style">
        <?php
        $timestamp_created_at = strtotime($post['created_at']);
        $current_time = time();
        // 게시글 작성일과 현재 날짜 비교
        if (date('Y-m-d', $timestamp_created_at) === date('Y-m-d', $current_time)) {
          echo '<span class="new_label">new </span>'; // 오늘 게시글이면 "New" 레이블 출력
        }
        ?>
        <a href="/posts/ReadPostsDetails/index/<?php echo $post['id'] ?>/">
          <?php
          echo $post['title']; ?>
        </a>
      </div>

      <!-- 게시글 작성자 -->
      <div class="username_style">
        <?php echo $post['username']; ?>
      </div>

      <!-- 게시글 작성시간 -->
      <div class="created_at_style">
        <?php // 날짜 변환 로직 적용
          $timestamp_created_at = strtotime($post['created_at']);
          $current_time = time();
          // 오늘 날짜라면 H:i 형식
          if (date('Y-m-d', $timestamp_created_at) === date('Y-m-d', $current_time)) {
            $formatted_date = date('H:i', $timestamp_created_at);
            // 오늘 날짜가 아니라면 Y.m.d형식
          } else {
            $formatted_date = date('Y. m. d', $timestamp_created_at);
          }
          echo $formatted_date; ?>
      </div>

      <!-- 게시글 조회수 -->
      <div class="view_count_style">
        <?php echo $post['view_count']; ?>
      </div>

    </div>
    <div class="hr_line"></div>
  <?php endforeach; ?>
  <!-- 페이지네이션 할 부분 -->
  <div class="pagination_style">
    <div class="pagination_links">
      <?php echo $this->pagination->create_links(); ?>
    </div>
  </div>
</div>