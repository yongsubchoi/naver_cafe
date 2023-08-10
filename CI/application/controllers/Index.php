<?php
class Index extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('layouts');
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->model('posts/Index_model');
  }

  public function index()
  {
    // $config['base_url'] = base_url() . "index/index"; // localhost
    $config['base_url'] = base_url()."/Index";
    // echo "config['base_url'] is " . $config['base_url'] . "<br>";

    // 토탈 게시글의 개수 설정
    $config['total_rows'] = $this->Index_model->getPostsCount();
    // echo "config['total_rows'] is " . $config['total_rows'] . "<br>";
    
    // 페이지에 보여질 게시글의 개수 설정
    $config['per_page'] = 25;
    // 쿼리스트링을 사용하기 위한 설정
    $config['enable_query_strings'] = true;
    $config['page_query_string'] = true;
    // page number를 사용하여 url에 표현
    $config['use_page_numbers'] = true;
    $config['query_string_segment'] = "page";
    // $config['uri_segment'] = 3; // 페이지 번호가 위치한 URI 세그먼트 지정

    $this->pagination->initialize($config);


    $data['username'] = $this->session->userdata('username');
    echo "<strong>현재 접속한 계정: " . $data['username'] . "</strong>";

    $data['notice_posts'] = $this->Index_model->getNoticePosts();
    // $this->uri->segment(2)를 통해 현재 페이지 번호를 가져옴
    $page_number = $this->input->get('page') ? $this->input->get('page') : 1;


    $data['posts'] = $this->Index_model->getPostsPaginated($config['per_page'], ($page_number - 1) * $config['per_page']);

    // echo "this->uri->segment(3) is " . $this->uri->segment(3) . "<br>";
    // echo "page_number is " . $page_number . "<br>";
    // echo "config['uri_segment'] is " . $config['uri_segment'];
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