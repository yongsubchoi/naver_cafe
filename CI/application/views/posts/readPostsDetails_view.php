<!-- 공개범위 조건문 -->
<?php if ($is_visible): ?>
  <?php if ($is_deleted): ?>
  <div class="detail_style">
    <div class="detail_section">
      <!-- 버튼 부분 -->
      <div class="detail_button_section">
        <div class="btn_left">
          <!-- 세션의 username이 게시글의 username과 같을 시 or 관리자 권한 계정일 시-->
          <?php if ($username == $user_info->username || $is_admin == TRUE): ?>
            <!-- a태그 경로 마지막에 해당 게시글의 id 값을 넣어줘야한다. -->
            <div><a href="<?php echo base_url('posts/EditPosts/index/' . $post_id); ?>">수정</a></div>
            <div id="post_delete_btn"><a
                href="<?php echo base_url('posts/ReadPostsDetails/deletePosts/' . $post_id); ?>">삭제</a></div>
          <?php endif; ?>
          <script>
            // js파일에서 $post_id값을 받기위해 변수 초기화
            var deletePostUrl = "<?php echo base_url('posts/ReadPostsDetails/deletePosts/' . $post_id); ?>";
          </script>
          <div><a href="">답글</a></div>
        </div>
        <div class="btn_right">
          <!-- 이전글이 있는 경우  -->
          <?php if ($prev_post !== null): ?>
          <div id="prev_post_btn">
            <a href="/posts/ReadPostsDetails/index/<?php echo $prev_post; ?>/" class="prev_btn_style">이전글</a>
          </div>
          <?php endif; ?>
          <!-- 다음글이 있는 경우 -->
          <?php if ($next_post !== null): ?>
          <div id="next_post_btn">
            <a href="/posts/ReadPostsDetails/index/<?php echo $next_post; ?>/" class="next_btn_style">다음글</a>
          </div>
          <?php endif; ?>
          <div id="post_list_btn">목록</div>
        </div>
      </div>
      <!-- 상세 게시글 조회 및 댓글 작성 부분 -->
      <div class="detail_main_section_style">
        <div class="detail_main_section">
          <div class="detail_main">
            <div class="detail_main_top">
              <div class="detail_main_top_title">
                <span>
                  <?php if (isset($posts['title'])): ?>
                    <?php echo $posts['title']; ?>
                  <?php endif; ?>
                </span>
              </div>
              <div class="detail_main_top_info_style">
                <div class="detail_main_top_info">
                  <div class="detail_main_top_info_picture">
                    <img src="<?php echo base_url('uploads/profile_pictures/' . $user_info->profile_picture_path); ?>"
                      alt="프로필 사진">
                  </div>
                  <div class="detail_main_top_info_right">
                    <div class="flex_column_style">
                      <div>
                        <strong>
                          <?php echo $user_info->username; ?>
                        </strong>
                      </div>
                      <div class="flex_row_style">
                        <div class="created_at_style">
                          <?php if (isset($posts['created_at'])): ?>
                            <?php echo $posts['created_at']; ?>
                          <?php endif; ?>
                        </div>
                        <div class="view_count_style">
                          <?php if (isset($posts['view_count'])): ?>
                            <?php echo '조회수: ' . $posts['view_count']; ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="detail_main_line_style">
              <div class="detail_main_line"></div>
            </div>
            <div class="detail_main_content">
              <div class="flex_justify_center">
                <div class="detail_main_content_top">
                  <?php if (isset($posts['content'])): ?>
                    <?php echo $posts['content']; ?>
                  <?php endif; ?>
                </div>
              </div>
              <div class="flex_justify_center">
                <div class="detail_main_content_bottom">
                  <div class="flex_direction_row">
                    <div class="like_button" data-post_id="<?php echo $posts['id']; ?>">
                      <?php if ($user_liked_post): ?>
                        <span class="liked_icon">&#x2764;</span> <strong>좋아요</strong>
                      <?php else: ?>
                        <span class="like_icon">&#x2661;</span> <strong>좋아요</strong>
                      <?php endif; ?>
                    </div>
                    <!-- 비로그인 시 좋아요 못누르게 처리 -->
                    <script>
                      document.addEventListener("DOMContentLoaded", function () {
                        const likeButton = document.querySelector(".like_button");

                        if (likeButton) {
                          likeButton.addEventListener("click", function () {
                            <?php if (!$logged_in): ?>
                              alert("로그인을 해주세요.");
                              window.location.href = "<?php echo base_url('userMgmt/Login'); ?>";
                              return;
                            <?php endif; ?>
                          });
                        }
                      });
                    </script>
                    <div class="like_count" data-post_id="<?php echo $posts['id']; ?>">
                      <?php echo $like_count; ?>
                    </div>
                    <div>
                      <strong>댓글</strong>
                      <?php echo $comment_count ?>
                    </div>
                  </div>
                  <div class="file_style">
                    <?php if (isset($file_name[0]->file_name)): ?>
                      <img src="<?php echo base_url('public/img/save.png'); ?>" />
                      <a href="<?php echo base_url('uploads/post_files/' . $file_name[0]->file_name); ?>" download>
                        <?php echo $file_name[0]->file_name; ?>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 댓글 목록 부분 -->
          <div class="detail_comments_section_style">
            <div class="detail_comments_section">
              <div class="comments_tab"><span><strong>댓글</strong></span></div>
              <div class="flex_justify_center">
                <?php foreach ($comments as $comment): ?>
                  <?php if (!$comment['is_deleted']==1): ?>
                  <div class="comment_form">
                    <div class="comment_picture">
                      <?php if ($comment['profile_picture_path']) { ?>
                        <img src="<?php echo "/uploads/profile_pictures/" . $comment['profile_picture_path'] ?>">
                      <?php } ?>
                    </div>
                    <div>
                      <div class="comment_user_created_at">
                        <div>
                          <strong>
                            <?php echo $comment['username']; ?>
                          </strong>
                          <!-- 로그인한 세션의 이름과 댓글의 이름이 같을 시 작성자 표시하기 -->
                          <?php if ($user_info->username == $comment['username']) { ?>
                            <span class="post_writer"><strong>작성자</strong></span>
                          <?php } ?>
                        </div>
                        <div class="comment_font_style">
                          <?php echo $comment['created_at']; ?>
                        </div>
                      </div>
                      <div class="comment_content">
                        <div class="comment_comtent_main">
                          <?php echo $comment['content']; ?>
                        </div>
                        <div class="co_comment">
                          답글쓰기
                        </div>
                      </div>
                    </div>
                    <div class="comment_kebab">
                      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="36" viewBox="-4 -4 22 36" x="203">
                        <path
                          d="M7.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3M6 7.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zM7.5 23a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"
                          fill="#D9D9D9" fill-rule="evenodd" />
                      </svg>
                      <!-- 본인 댓글만 수정, 삭제가 가능하도록 설정 -->
                      <?php if ($comment['username'] == $username || $is_admin == TRUE): ?>
                        <div class="options">
                          <div class="edit_option">
                            <a href="#" class="editCommentButton" data-comment-id="<?php echo $comment['id']; ?>">수정</a>
                          </div>
                          <div class="delete_option">
                            <a href="#" class="deleteCommentButton" data-comment-id="<?php echo $comment['id']; ?>">삭제</a>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <!-- 댓글 수정 폼 -->
                  <div class="comment_input_area" id="edit-comment-form-<?php echo $comment['id']; ?>"
                    style="display: none;">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('posts/ReadPostsDetails/edit_comment/' . $comment['id']); ?>
                    <?php if ($logged_in): ?>
                      <div class="logged_in_username">
                        <div class="commenter_picture">
                          <?php if ($logged_in_user_picture_path) { ?>
                            <img src="<?php echo "/uploads/profile_pictures/" . $logged_in_user_picture_path ?>">
                          <?php } ?>
                        </div>
                        <strong>
                          <?php echo $username; ?>
                        </strong>
                      </div>
                      <div class="comment_textarea">
                        <textarea name="edited_content" class="text_area_comment" required
                          placeholder="<?php echo $comment['content']; ?>"></textarea>
                      </div>
                      <div class="submit_btn">
                        <button type="submit" class="submit_button">수정 완료</button>
                        <button type="button" class="cancel_button">취소</button>
                      </div>
                      </form>
                    <?php endif; ?>
                  </div>

                  <div class="comment_line"></div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <!-- 댓글 작성 부분 -->
              <div class="flex_justify_center">
                <div class="comment_input_area">
                  <?php echo validation_errors(); ?>
                  <?php echo form_open('posts/ReadPostsDetails/comment_form/' . $posts['id']); ?>
                  <?php if ($logged_in): ?>
                    <div class="logged_in_username">
                      <div class="commenter_picture">
                        <?php if ($logged_in_user_picture_path) { ?>
                          <img src="<?php echo "/uploads/profile_pictures/" . $logged_in_user_picture_path ?>">
                        <?php } ?>
                      </div>
                      <strong>
                        <?php echo $username; ?>
                      </strong>
                    </div>
                    <div class="comment_textarea">
                      <textarea name="content" class="text_area_comment" placeholder="댓글을 남겨보세요." required></textarea>
                    </div>
                    <div class="submit_btn">
                      <button type="submit" class="submit_button">등록</button>
                    </div>
                    </form>
                  <?php else: ?>
                    <div class="none_logged_in_comment">
                      댓글을 작성하려면 로그인을 해주세요.
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- 게시글 리스트 부분 -->
    <div class="posts_list">
      <h2>전체글</h2>
      <div class="small_posts_line_style">
        <div class="small_posts_line"></div>
      </div>
      <?php foreach ($posts_list as $post): ?>
        <div class="small_posts_list">
          <!-- 게시글 제목 -->
          <div class="small_posts_title">
            <a href="/posts/ReadPostsDetails/index/<?php echo $post['id'] ?>/">
              <span>
                <?php
                echo $post['title']; ?>
              </span>
            </a>
            <!-- 댓글 개수 표시 -->
            <?php if ($post['comment_count'] > 0) { ?>
              <span class="comment_count">
                <strong>[<?php echo $post['comment_count']; ?>]
                </strong>
              </span>
            <?php } ?>
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
          </div>
          <!-- 게시글 작성자 -->
          <div class="small_posts_writer">
            <?php echo $post['username']; ?>
          </div>
          <!-- 게시글 작성시간 -->
          <div class="small_posts_created_at">
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
        </div>
        <div class="small_posts_line_style">
          <div class="small_posts_line"></div>
        </div>
      <?php endforeach; ?>
      <div class="small_posts_pagination_style">
        <div class="small_posts_pagination_links">
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </div>
  <?php else: ?>
    <script>
      // alert('삭제된 게시글입니다.');
      // 예외 처리를 어떤식으로 할 것인가?
      // alert를 나오게 하지 않고 바로 db의 다음 post_id로 넘어가게 하는 로직이 필요하다.
      // 위와같이 이전글, 다음글을 눌렀을 때 삭제된 게시글인 경우 $post_id에 +1, -1 처리를 해주는 로직이 필요하다.
    </script>
  <?php endif; ?>
<?php else: ?>
  <script>
    alert('멤버공개 게시글입니다.');
    window.location.href = "<?php echo base_url('userMgmt/Login'); ?>";
  </script>
<?php endif; ?>