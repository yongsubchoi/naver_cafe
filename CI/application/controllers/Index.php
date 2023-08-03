<?php
class Index extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('layouts');
    $this->load->library('session');
  }

  public function index()
  {
    //* 현재 접속한 계정 -> 추후 나의 활동으로 정보 이동 예정
    $username = $this->session->userdata('username');
    echo "<strong>현재 접속한 계정: " . $username . "</strong>";

    $data['content'] = 'main sector';
    // $this->load->view('posts/index_view', $data);
    $this->layouts->view('posts/index_view', $data);
  }

  public function load_cafeinfo()
  {
    $this->load->view('sidebar/cafeInfo_view');
  }

  public function load_myActivity()
  {
    $this->load->view('sidebar/myActivity_view');
  }
}
?>