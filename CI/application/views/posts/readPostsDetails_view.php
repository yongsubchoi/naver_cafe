<div class="detail_style">
  <div class="detail_section">
    <!-- 버튼 부분 -->
    <div class="detail_button_section">
      <div class="btn_left">
        <div>수정</div>
        <div>삭제</div>
        <div>답글</div>
      </div>
      <div class="btn_right">
        <div>이전글</div>
        <div>다음글</div>
        <div>목록</div>
      </div>
    </div>
    <!-- 상세 게시글 조회 및 댓글 작성 부분 -->
    <div class="detail_main_section_style">
      <div class="detail_main_section">
        <div class="detail_main">
          <div class="detail_main_top">
            <div class="detail_main_top_title">
              <span>제목입니다.</span>
            </div>
            <div class="detail_main_top_info_style">
              <div class="detail_main_top_info">
                <div class="detail_main_top_info_picture">
                  프사
                </div>
                <div class="detail_main_top_info_right">
                  <div class="flex_column_style">
                    <div>nowkwon97</div>
                    <div class="flex_row_style">
                      <div class="created_at_style">날짜</div>
                      <div class="view_count_style">조회수</div>
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
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta earum magnam tempora nobis eos, culpa
                quis nostrum minus consectetur optio quam beatae asperiores quia in esse. Nobis velit laborum
                repudiandae.
              </div>
            </div>
            <div class="flex_justify_center">
              <div class="detail_main_content_bottom">
                <div>
                  좋아요, 댓글
                </div>
                <div>
                  첨부파일
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="detail_comments_section_style">
          <div class="detail_comments_section">
            <div class="comments_tab"><span>댓글</span></div>
            <div class="flex_justify_center">
              <div class="comment_form">
                <div class="comment_picture">사진</div>
                <div>
                  <div class="comment_user_created_at">
                    <div>작성자</div>
                    <div>작성시간</div>
                  </div>
                  <div class="comment_content">
                    <div class="comment_comtent_main">
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus voluptates fuga consectetur
                      quaerat saepe nemo eos sed itaque fugiat nam, accusamus facilis fugit porro error quibusdam
                      commodi
                      et, doloremque a!
                    </div>
                    <div class="co_comment">
                      답글쓰기
                    </div>
                  </div>
                </div>
                <div>케밥</div>
              </div>
            </div>
            <div class="flex_justify_center">
              <div class="comment_input_area">
                <?php echo validation_errors(); ?>
                <?php echo form_open('posts/ReadPostsDetails/index'); ?>
                <div class="logged_in_username">
                  로그인한 유저네임
                </div>
                <div class="comment_textarea">
                  <textarea name="content" class="text_area_comment" placeholder="댓글을 남겨보세요."></textarea>
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
    <?php
    echo $detail_view_list;
    ?>
  </div>
</div>