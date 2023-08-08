<?php
class CreatePosts extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('upload');
    $this->load->model('posts/CreatePosts_model');
  }

  public function index()
  {
    // 폼 유효성 검사
    $this->form_validation->set_rules('title', '', 'required');
    $this->form_validation->set_rules('content', '', 'required');
    $this->form_validation->set_rules('board_category', '', 'required');
    $this->form_validation->set_rules('file_name', '', 'callback_check_add_file');

    // 폼 유효성 검사 결과에 따라 결과 처리
    if ($this->form_validation->run() === FALSE) {
      // 유효성 검사 실패 시
      $this->load->view('posts/createPosts_view');
    } else {
      echo "폼 유효성 검사 성공" . "<br>";
      // 유효성 검사 성공 시

      $username = $this->session->userdata('username');
      $user_id = $this->CreatePosts_model->getUserIdByUsername($username);

      // is_notice컬럼의 값을 0 or 1 로 설정하기 위해
      $is_notice = ($this->input->post('is_notice') === 'on') ? true : false;
      $is_notice_value = $is_notice ? 1 : 0;

      // 시간대를 한국으로 설정
      date_default_timezone_set('Asia/Seoul');

      // posts테이블에 insert할 data
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
      echo "post_id는" . $post_id . "<br>";

      if (!empty($_FILES['file_name']['name'])) {
        echo "파일의 filename의 name이 비어있지 않아.";
        $file_name = $this->uploadAttachment($post_id);
      }

      // 완료 후 메인으로 리디렉션
      // ! 게시글 상세조회 페이지 구현 후 리디렉션 바꿔주기
      redirect('');
    }
  }

  private function uploadAttachment($post_id)
  {
    echo "uploadAttachment 함수 호출" . "<br>";
    // 파일 업로드 처리 로직
    // 업로드 성공 시 파일 정보를 files 테이블에 저장하고, 사입된 파일의 id를 반환
    $imageFolder = "C:/workspace/naver_cafe/CI/uploads/post_files/";

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
      return null;
    }

    date_default_timezone_set('Asia/Seoul');
    $username = $this->session->userdata('username');
    $user_id = $this->CreatePosts_model->getUserIdByUsername($username);

    // 파일명 중복 방지를 위한 유니크 값 생성
    $unique_name = time() . '_' . $_FILES['file_name']['name'];

    if ($this->uploadImageFile($imageFolder, $unique_name)) {
      echo "file_data에 값 담기";
      $file_data = array(
        'file_name' => $unique_name,
        'file_path' => 'uploads/post_files/' . $_FILES['file_name']['name'],
        'file_size' => $_FILES['file_name']['size'],
        'file_type' => $_FILES['file_name']['type'],
        'created_at' => date('Y-m-d H:i:s'),
        'user_id' => $user_id,
        'post_id' => $post_id,
      );

      $this->CreatePosts_model->insertFileData($file_data);
    }
  }

  private function uploadImageFile($imageFolder, $unique_name)
  {
    echo "uploadImageFile함수 호출" . "<br>";

    // 업로드된 파일이 있는지, 유효한지 확인
    if (isset($_FILES['file_name']) && is_uploaded_file($_FILES['file_name']['tmp_name'])) {
      // 업로드된 파일 이름 유효성 검사
      if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $_FILES['file_name']['name'])) {
        echo "여기냐?";
        return false;
      }
      // 업로드된 파일의 확장자 유효성 검사
      if (!in_array(strtolower(pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        echo "아님 여기냐?";
        return false;
      }

      $fileToWrite = $imageFolder . $unique_name;
      // 업로드된 파일을 지정한 경로로 이동시킴
      if (move_uploaded_file($_FILES['file_name']['tmp_name'], $fileToWrite)) {
        // 파일 업로드 성공
        echo "파일 업로드 성공!" . "<br>";
        return true;
      } else {
        // 파일 업로드 실패
        echo "파일 업로드 실패!";
        return false;
      }
    }
    //! 파일이 업로드 되지않아 이부분에 걸리는중
    return false;
  }
  // 첨부파일 비어도 안비어도 TURE 반환
  public function check_add_file($str)
  {
    if (!empty($_FILES['file_name']['name'])) {
      return TRUE;
    } else {
      return TRUE;
    }
  }
}
?>