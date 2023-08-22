<!-- 기존의 게시글 정보를 불러온 상태를 보여줘야 한다. -->
<!-- 로그인한 유저만 접근이 가능하도록 설정 -->
<?php if ($this->session->userdata('logged_in')) { ?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>title</title>
    <link rel="stylesheet" href="<?php echo base_url('public/views/posts/css/styles.css'); ?>">
    <script src="https://cdn.tiny.cloud/1/ht73a10uxzbrth20go3bibcfmp0vwg6pqbzkt1beet30ptgm/tinymce/6/tinymce.min.js"
      referrerpolicy="origin"></script>
  </head>

  <body>
    <header>
      <!-- 로그인, 회원가입 부분 -->
      <div class="login_signUp_style">

      </div>
      <!-- 카페 대문 부분 -->
      <div class="cafe_door">
        <a href="/"><img src="<?php echo base_url('public/img/naver_cafe_logo.jpg') ?>"
            alt="카페사진"></a>
      </div>


    </header>

    <!-- 메인 부분 -->
    <main class="main_section">
      <!-- 게시글 작성 폼 -->
      <?php echo validation_errors(); ?>
      <?php echo form_open_multipart('posts/EditPosts/update/' . $posts['id']) ?>
      <div class="form_style">
        <div class="create_posts">
          <!-- 게시판 선택 드롭다운 -->
          <div>
            <select name="board_category" class="board_category" required>
              <option value="<?php echo $posts['board_category'] ?>">
                <?php if ($posts['board_category']==='freeBoard'): ?>
                  자유게시판
                <?php else: ?>
                  전체게시판
                <?php endif; ?>
              </option>
              <option value="freeBoard">자유게시판</option>
              <option value="allBoard">전체게시판</option>
            </select>
          </div>

          <!-- 제목 입력 칸 -->
          <div>
            <input type="text" name="title" class="post_title" placeholder="제목을 입력해 주세요." value="<?php echo $posts['title'] ?>" required>
          </div>
          <!-- 첨푸 파일 칸 -->
          <div class="add_file">
            <div>첨부 파일: </div>
            <input type="file" class="add_file_input" name="file_name">
          </div>
          <!-- 첨부된 파일이 있을 시 첨부한 파일명 표시 -->
          <?php if ($file_info): ?>
          <div class="add_file">
            기존 첨부 파일: <?php echo $file_info[0]->file_name; ?>
          </div>
          <?php endif; ?>
          <!-- 게시글 content 입력 칸 -->
          <div class="posts_textarea">
            <textarea name="content" id="post_content" placeholder="내용을 입력하세요.">
              <?php echo $posts['content']; ?>
            </textarea>
          </div>

          <!-- 취소, 등록 버튼 -->
          <div class="btn_style">
            <!-- 취소 버튼 -->
            <div>
              <button type="button" id="goBackBtn" class="cancle_btn">취소</button>
            </div>
            <!-- 등록 버튼 -->
            <div>
              <button type="submit" class="reg_btn">등록</button>
            </div>
          </div>



        </div>
        <!-- 사이드바 부분 -->
        <div class="side_bar_section">
          <!-- 사이드바 -->
          <div class="side_bar">
            <!-- 관리자만 공지등록이 보이도록 설정 -->
            <?php if ($this->session->userdata('is_admin')) { ?>
              <div class="sb_set_anmt">
                <label>
                  <input type="checkbox" name="is_notice" id="notice_on" value="on">
                  공지로 등록
                </label>
              </div>
            <?php } ?>

            <div class="sb_set_scope_disclosure">
              <!-- visibility에 따른 checked 부여 -->
              <?php if ($posts['visibility']=='forAll'): ?>
              <label>
                <input type="radio" name="visibility" id="forAll" value="forAll" checked>
                전체공개
              </label>
              <label>
                <input type="radio" name="visibility" id="forMember" value="forMember">
                멤버공개
              </label>
              <?php else: ?>
                <label>
                <input type="radio" name="visibility" id="forAll" value="forAll">
                전체공개
              </label>
              <label>
                <input type="radio" name="visibility" id="forMember" value="forMember" checked>
                멤버공개
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
      </form>


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
  <script>
    tinymce.init({
      selector: '#post_content',
      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat | image',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      // 이미지 자동 업로드 활성화
      automatic_uploads: true,
      // 이미지 업로드 처리를 위한 컨트롤러 메서드의 URL
      images_upload_url: 'http://localhost/posts/CreatePosts/uploadImage',
      // 파일이 저장될 경로
      images_upload_base_path: 'C:/workspace/naver_cafe/CI/uploads/post_files'

      // images_upload_credentials: true, // 크로스-도메인 인증 허용경로
      // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
    });
  </script>
  <script src="<?php echo base_url('public/views/userMgmt/js/backBtn.js'); ?>"></script>

  </html>
  <!-- 그렇지 않을 경우 로그인 페이지로 이동 -->
<?php } else { ?>
  <script>
    alert('로그인을 해주세요.');
    window.location.href = "/userMgmt/Login";
  </script>
<?php } ?>