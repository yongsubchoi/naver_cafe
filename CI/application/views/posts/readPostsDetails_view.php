<!-- 공개범위 조건문 -->
<?php if ($is_visible): ?>
  <div class="detail_style">
    <div class="detail_section">
      <!-- 버튼 부분 -->
      <div class="detail_button_section">
        <div class="btn_left">
          <div><a href="">수정</a></div>
          <div>삭제</div>
          <div><a href="">답글</a></div>
        </div>
        <div class="btn_right">
          <div>이전글</div>
          <div>다음글</div>
          <!-- history.back? -->
          <div>목록</div>
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
                        <?php echo $user_info->username; ?>
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
                        <span class="liked_icon">&#x2764;</span> 좋아요
                      <?php else: ?>
                        <span class="like_icon">&#x2661;</span> 좋아요
                      <?php endif; ?>
                    </div>
                    <div class="like_count" data-post_id="<?php echo $posts['id']; ?>">
                      <?php echo $like_count; ?>
                    </div>
                    <div>
                      댓글
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
              <div class="comments_tab"><span>댓글</span></div>
              <div class="flex_justify_center">
                <?php foreach ($comments as $comment): ?>
                  <div class="comment_form">
                    <div class="comment_picture">
                      <?php if ($comment['profile_picture_path']) { ?>
                        <img src="<?php echo "/uploads/profile_pictures/" . $comment['profile_picture_path'] ?>">
                      <?php } ?>
                    </div>
                    <div>
                      <div class="comment_user_created_at">
                        <div>
                          <?php echo $comment['username']; ?>
                          <!-- 로그인한 세션의 이름과 댓글의 이름이 같을 시 작성자 표시하기 -->
                          <?php if ($user_info->username == $comment['username']) { ?>
                            <span class="post_writer"><strong>작성자</strong></span>
                          <?php } ?>
                        </div>
                        <div>
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
                    <div>케밥</div>
                  </div>
                  <div class="comment_line"></div>
                <?php endforeach; ?>
              </div>
              <!-- 댓글 작성 부분 -->
              <div class="flex_justify_center">
                <div class="comment_input_area">
                  <?php echo validation_errors(); ?>
                  <?php echo form_open('posts/ReadPostsDetails/comment_form/' . $posts['id']); ?>
                  <div class="logged_in_username">
                    <div class="commenter_picture">
                      <?php if ($logged_in_user_picture_path) { ?>
                        <img src="<?php echo "/uploads/profile_pictures/" . $logged_in_user_picture_path ?>">
                      <?php } ?>
                    </div>
                    <?php echo $username; ?>
                  </div>
                  <div class="comment_textarea">
                    <textarea name="content" class="text_area_comment" placeholder="댓글을 남겨보세요." required></textarea>
                  </div>
                  <div class="submit_btn">
                    <button type="submit" class="submit_button">등록</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- 게시글 리스트 부분 -->
    <div class="posts_list">
      게시글 리스트 부분
    </div>
  </div>
<?php else: ?>
  <script>
    alert('멤버공개 게시글입니다.');
    window.location.href = "<?php echo base_url('userMgmt/Login'); ?>";
  </script>
<?php endif; ?>