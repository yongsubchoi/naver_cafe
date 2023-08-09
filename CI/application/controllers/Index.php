<?php
class Index extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('layouts');
    $this->load->library('session');
    $this->load->model('posts/Index_model');
  }

  public function index()
  {
    //* 현재 접속한 계정 -> 추후 나의 활동으로 정보 이동 예정
    $data['username'] = $this->session->userdata('username');
    echo "<strong>현재 접속한 계정: " . $data['username'] . "</strong>";

    $data['posts'] = $this->Index_model->getPosts();
    // $data['username'] = $this->Index_model->getUsernameByUserId();
    // $this->load->view('posts/index_view', $data);
    $this->layouts->view('posts/index_view', $data);
  }
  // 사이드바>카페정보 불러오는 함수
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
}
?>