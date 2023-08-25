<!-- 메인 게시판 부분 -->
<div class="main_posts">

  <div class="t_hr_line"></div>
  <!-- <?php print_r($comment_count); ?> -->
  <!-- 공지 게시글 -->
  <div class="notice_area">
    <?php foreach ($notice_posts as $post): ?>
      <?php if (!$post['is_deleted']): ?>
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
              <?php if ($post['notice_comment_count'] > 0) { ?>
                <span class="comment_count">
                  <strong>[<?php echo $post['notice_comment_count']; ?>]
                  </strong>
                </span>
              <?php } ?>
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
      <?php endif; ?>
    <?php endforeach; ?>
  </div>

  <!-- 일반 게시글 -->
  <?php foreach ($posts as $post): ?>
    <?php if (!$post['is_deleted']): ?>
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
            echo '<span class="new_label">' ?><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
              viewBox="-4 -4 20 20" x="281" y="179">
              <g fill="none" fill-rule="evenodd">
                <rect width="12" height="12" fill="#FF4947" rx="6" />
                <path fill="#FFF" d="M4 8.479h.815V4.614h.022l2.25 3.865H8V3.35h-.815v3.619h-.022L5.032 3.35H4z" />
              </g>
            </svg>
            <?php '</span>'; // 오늘 게시글이면 "New" 레이블 출력
          }
          ?>
          <a href="/posts/ReadPostsDetails/index/<?php echo $post['id'] ?>/">
            <?php
            echo $post['title']; ?>
          </a>
          <!-- 댓글 개수 표시 -->
          <?php if ($post['comment_count'] > 0) { ?>
            <span class="comment_count">
              <strong>[<?php echo $post['comment_count']; ?>]
              </strong>
            </span>
          <?php } ?>
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
    <?php endif; ?>
  <?php endforeach; ?>
  <!-- 페이지네이션 할 부분 -->
  <div class="pagination_style">
    <div class="pagination_links">
      <?php echo $this->pagination->create_links(); ?>
    </div>
  </div>
  <!-- 검색 부분 -->
  <?php echo validation_errors(); ?>
  <?php echo form_open('posts/Index/search'); ?>
  <div class="index_search_section">
    <div class="index_search_period">
      <select class="search_period_select" name="search_period">
        <option>전체기간</option>
        <option>1주</option>
        <option>1달</option>
        <option>6달</option>
        <option>1년</option>
      </select>
    </div>
    <div class="index_serach_type">
      <select class="search_type_select" name="search_type">
        <option>게시글+댓글</option>
        <option>제목만</option>
        <option>글작성자</option>
        <option>댓글내용</option>
        <option>댓글작성자</option>
      </select>
    </div>
    <div class="index_search_section_style">
      <input type="text" name="search_input" id="search_input" placeholder="게시글 검색" class="index_search_posts">
      <button type="button" id="index_search_posts_btn">검색</button>
    </div>
  </div>
  </form>
</div>