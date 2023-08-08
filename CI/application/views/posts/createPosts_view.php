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
      카페대문
    </div>

  </header>

  <!-- 메인 부분 -->
  <main class="main_section">
    <!-- 게시글 작성 폼 -->
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('posts/createPosts/index') ?>
    <div class="form_style">
      <div class="create_posts">
        <!-- 게시판 선택 드롭다운 -->
        <div>
          <select name="board_category" class="board_category" required>
            <option value="">게시판을 선택해 주세요.</option>
            <option value="freeBoard">자유게시판</option>
            <option value="allBoard">전체게시판</option>
          </select>
        </div>

        <!-- 제목 입력 칸 -->
        <div>
          <input type="text" name="title" class="post_title" placeholder="제목을 입력해 주세요." required>
        </div>
        <!-- 첨푸 파일 칸 -->
        <div class="add_file">
          <div>첨부 파일: </div>
          <input type="file" class="add_file_input" name="file_name">
        </div>
        <!-- 게시글 content 입력 칸 -->
        <div class="posts_textarea">
          <textarea name="content" id="post_content" placeholder="내용을 입력하세요."></textarea>
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
          <div class="sb_set_anmt">
            <label>
              <input type="checkbox" name="is_notice" id="notice_on" value="on">
              공지로 등록
            </label>
          </div>
          <div class="sb_set_scope_disclosure">
            <label>
              <input type="radio" name="visibility" id="forAll" value="forAll" checked>
              전체공개
            </label>
            <label>
              <input type="radio" name="visibility" id="forMember" value="forMember">
              멤버공개
            </label>
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