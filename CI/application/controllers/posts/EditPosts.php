<?php
class EditPosts extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('upload');
    $this->load->model('posts/EditPosts_model');
    date_default_timezone_set('Asia/Seoul');
  }

  /**
   * @param string $id // post_id
   */
  public function index($id)
  {
    /**
     * todo 필요한 로직
     * 기존 게시글의 데이터를 가져오는 모델의 함수
     * 기존 데이터를 담고있는 변수
     * 수정 페이지의 폼 검증
     * 수정 데이터를 담는 배열 변수
     * 해당 배열 변수를 모델의 함수를 이용하여 DB update
     * 마지막에 redirect('');
     * 
     * 그외 필요한 로직은 기존 게시글 작성과 동일
     * 뷰에서 form_open 경로에 게시글의 id가 들어가야 한다.
     */

    // 게시글 데이터 가져오기
    $data['posts'] = $this->EditPosts_model->getPostsByUserId($id);
    $data['file_info'] = $this->EditPosts_model->getFileNameByPostId($id);

    $this->load->view('posts/editPosts_view', $data);
  }

  public function update($id)
  {
    $this->form_validation->set_rules('title', '', 'required');
    $this->form_validation->set_rules('content', '', 'required');
    $this->form_validation->set_rules('visibility', '', 'required');
    $this->form_validation->set_rules('board_category', '', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('posts/editPosts_view');
    } else {
      // 게시글 업데이트 로직
      $this->EditPosts_model->updatePost(
        $id,
        $this->input->post('title'),
        $this->input->post('content'),
        $this->input->post('visibility'),
        $this->input->post('board_category')
      );

      // 파일 업로드 로직
      $file_name = $this->uploadAttachment($id);
      if (!empty($file_name)) {
        $this->EditPosts_model->insertOrUpdateFile($id, $file_name);
      }

      redirect('');
    }
  }


  private function uploadAttachment($post_id)
  {
    // 기존 파일 정보 가져오기
    $existing_file = $this->EditPosts_model->getFileByPostId($post_id);

    if (!empty($_FILES['file_name']['name'])) {
      $imageFolder = "C:/workspace/naver_cafe/CI/uploads/post_files/";
      $unique_name = time() . '_' . $_FILES['file_name']['name'];

      if ($this->uploadImageFile($imageFolder, $unique_name)) {
        return $unique_name;
      } else {
        return $existing_file ? $existing_file->file_name : null;
      }
    } elseif ($existing_file) {
      return $existing_file->file_name;
    }

    return null;
  }

  private function uploadImageFile($imageFolder, $unique_name)
  {
    // 업로드된 파일이 있는지, 유효한지 확인
    if (isset($_FILES['file_name']) && is_uploaded_file($_FILES['file_name']['tmp_name'])) {
      // 업로드된 파일 이름 유효성 검사
      if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $_FILES['file_name']['name'])) {
        return false;
      }
      // 업로드된 파일의 확장자 유효성 검사
      if (!in_array(strtolower(pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        return false;
      }

      // 업로드된 파일을 지정된 경로로 이동시킴
      $fileToWrite = $imageFolder . $unique_name;
      if (move_uploaded_file($_FILES['file_name']['tmp_name'], $fileToWrite)) {
        // 파일 업로드 성공
        return true;
      } else {
        // 파일 업로드 실패
        return false;
      }
    }
    return false; // 파일이 업로드되지 않은 경우
  }

}
?>