<?php
class ReadPostsDetails extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('layouts');
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->library('form_validation');
    $this->load->model('posts/ReadPostsDetails_model');
  }

  public function index($id)
  {
    $data['username'] = $this->session->userdata('username');
    
    $data['posts'] = $this->ReadPostsDetails_model->getPostsByUserId($id);
    $data['user_info'] = $this->ReadPostsDetails_model->getUserInfoByPostId($id);
    $data['file_name'] = $this->ReadPostsDetails_model->getFileNameByPostId($id);

    $this->layouts->view('posts/readPostsDetails_view', $data);
  }

  public function load_cafeInfo()
  {
    $this->load->view('sidebar/cafeInfo_view');
  }
  // 사이드바>나의활동 불러오는 함수
  public function load_myActivity()
  {
    $data['username'] = $this->session->userdata('username');
    $data['created_at'] = $this->session->userdata('created_at');
    $data['profile_picture_path'] = $this->session->userdata('profile_picture_path');
    $this->load->view('sidebar/myActivity_view', $data);
  }
  // 로그아웃 함수
  public function logout()
  {
    // 세션을 종료합니다.
    $this->session->sess_destroy();

    // 로그아웃 처리 완료 후, 홈페이지 또는 로그인 페이지로 이동합니다.
    redirect(''); // 홈페이지 또는 로그인 페이지 URL을 입력하세요.
  }

  public function download_file($file_name) {
    $file_path = '/uploads/files/' . $file_name;

    if (file_exists($file_path)) {
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . $file_name . '"');
      readfile($file_path);
    } else {
      echo "파일을 찾을 수 없습니다.";
    }
  }
}
?>