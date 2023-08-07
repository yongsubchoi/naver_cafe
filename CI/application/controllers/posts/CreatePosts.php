<?php
class CreatePosts extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('posts/CreatePosts_model');
  }

  public function index()
  {
    /**
     * todo 게시글 작성 시 필요한 로직
     * 폼 유효성 검사
     * form으로부터 받은 데이터를 DB에 넣어야 한다.
     * posts DB에 들어갈 값들
     * user_id // 글 작성자(users테이블의 id) 세션값을 통해?
     *  users 테이블에서 세션의 username인 id값
     * board_category // 게시글 카테고리(freeBoard, allBoard)
     * title // 게시글 제목
     * content // 게시글 내용
     * is_notice // 게시글 공지 여부
     * visibility // 공개 범위(forAll, forMember)
     * created_at // 게시글 작성 시간
     ** parent_posts_id // 게시글의 부모 글 id
     *?  parent_posts_id는 답글 버튼 누를 때의 로직?
     ** level // 게시글의 계층 level
     *?  level은 답글 버튼 누를 때의 로직?
     ** display_order // 부모글아래의 자식 글들의 순서 표시
     *?  display_order는 답글 버튼 누를 때의 로직?
     ** path // 게시글의 계층 구조
     *?  path는 답글 버튼 누를 때의 로직?
     */

    // 폼 유효성 검사
    $this->form_validation->set_rules('title', '', 'required');
    $this->form_validation->set_rules('content', '', 'required');
    $this->form_validation->set_rules('board_category', '', 'required');

    // 폼 유효성 검사 결과에 따라 결과 처리
    if ($this->form_validation->run() === FALSE) {
      // 유효성 검사 실패 시
      $this->load->view('posts/createPosts_view');
    } else {
      // 유효성 검사 성공 시
      $username = $this->session->userdata('username');
      $user_id = $this->CreatePosts_model->getUserIdByUsername($username);
      // is_notice컬럼의 값을 0 or 1 로 설정하기 위해
      $is_notice = ($this->input->post('is_notice') === 'on') ? true : false;
      $is_notice_value = $is_notice ? 1 : 0;
      // 시간대를 한국으로 설정
      date_default_timezone_set('Asia/Seoul');

      $data = array(
        'user_id' => $user_id,
        'board_category' => $this->input->post('board_category'),
        'title' => $this->input->post('title'),
        'content' => $this->input->post('content'),
        'is_notice' => $is_notice_value,
        'created_at' => date('Y-m-d H:i:s'),
        'visibility' => $this->input->post('visibility'),
      );
      // $data를 posts 테이블에 삽입하고 생성된 post_id를 반환
      $post_id = $this->CreatePosts_model->createPost($data);
      // 이미지 업로드 메서드 호출
      $this->uploadImage($post_id);

      // 완료 후 메인으로 리디렉션
      // ! 게시글 상세조회 페이지 구현 후 리디렉션 바꿔주기
      // redirect('');
    }
  }

  public function uploadImage($post_id)
  {
    echo "uploadImage 함수 호출";
    echo "<br>";

    // $path = 'C:/workspace/naver_cafe/CI/uploads/post_files';
    // $filename = 'test';
    // $allowedTypes = ['jpg', 'png'];
    // $maxFileSize = 2048;

    // $this->load->library('upload');
    // // 업로드 경로 설정
    // $this->upload->set_upload_path($path);
    // // 업로드 파일 허용 타입
    // $this->upload->set_allowed_types($allowedTypes);
    // // 업로드 파일 최대 용량 설정
    // $this->upload->set_max_filesize($maxFileSize);
    // // 경로에 중복된 이름이 있을 시 파일 명 뒤에 숫자 1을 증가시켜 고유성 확보
    // $this->upload->set_filename($path, $filename);


    $config['upload_path'] = 'C:/workspace/naver_cafe/CI/uploads/post_files';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 2048;
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);

    // $image_url = null;
    // $upload_data = null;

    if (!$this->upload->do_upload('file')) {
      // 업로드 실패 처리
      // !현재 이부분
      echo "업로드 실패 처리" . "<br>";
      $error = array('error' => $this->upload->display_errors());
      echo json_encode(($error));
    } else {
      // 업로드 성공 처리
      echo "업로드 성공 처리";
      $upload_data = $this->upload->data();
      $image_url = base_url('uploads/post_files/' . $upload_data['file_name']);

      // 업로드된 이미지 정보를 반환
      $response = array(
        'location' => $image_url, // 업로드된 이미지의 URL
      );

      echo json_encode($response);

      date_default_timezone_set('Asia/Seoul');
      $username = $this->session->userdata('username');
      $user_id = $this->CreatePosts_model->getUserIdByUsername($username);

      if ($upload_data) {
        $file_data = array(
          'file_name' => $upload_data['file_name'],
          'file_path' => 'uploads/post_files/' . $upload_data['file_name'],
          'file_size' => $upload_data['file_size'],
          'file_type' => $upload_data['file_type'],
          'created_at' => date('Y-m-d H:i:s'),
          'user_id' => $user_id,
          'post_id' => $post_id,
        );
        // 파일 정보를 files 테이블에 삽입
        $this->CreatePosts_model->insertFileData($file_data);
      }
    }
  }
}
?>