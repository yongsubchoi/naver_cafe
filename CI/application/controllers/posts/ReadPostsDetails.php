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
    // visibility 값을 가져옴
    $data['visibility'] = $data['posts']['visibility'];

    $data['user_info'] = $this->ReadPostsDetails_model->getUserInfoByPostId($id);
    $data['file_name'] = $this->ReadPostsDetails_model->getFileNameByPostId($id);

    $data['is_visible'] = $this->check_visibility($data['visibility']);

    $this->increase_view_count($id);

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

  public function download_file($file_name)
  {
    $file_path = '/uploads/files/' . $file_name;

    if (file_exists($file_path)) {
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . $file_name . '"');
      readfile($file_path);
    } else {
      echo "파일을 찾을 수 없습니다.";
    }
  }

  // $visibility를 체크하는 함수
  public function check_visibility($visibility)
  {
    $username = $this->session->userdata('username');

    // 전체공개 게시글인경우
    if ($visibility === 'forAll') {
      return true;
      // 멤버공개 및 로그인을 한 경우
    } elseif ($visibility === 'forMember' && $username) {
      return true;
    } else {
      return false;
    }
  }

  public function increase_view_count($id)
  {
    $this->load->library('user_agent');

    $username = $this->session->userdata('username');
    // 게시글을 조회한 사용자를 식별하기 위한 변수 선언
    $view_cookie_name = 'viewed_post_' . $id . '_' . $username;

    // 해당 게시글을 해당 사용자가 처음 조회하는 경우
    if (!$this->input->cookie($view_cookie_name)) {
      // 모델의 함수를 불러와 해당 게시글의 조회수를 증가시킴
      $this->ReadPostsDetails_model->increaseViewCount($id);
      // $view_cookie_name이라는 쿠키를 true로 설정하고 유효기간은 86400(하루)로 설정 -> 하루동안 중복 조회수 증가를 막기위해 설정
      $this->input->set_cookie($view_cookie_name, 'true', 86400);
    }
  }
}
?>