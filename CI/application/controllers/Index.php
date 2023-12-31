<?php
class Index extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('layouts');
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->model('posts/Index_model');
  }

  public function index()
  {
    $config['base_url'] = base_url();
    
    // 토탈 게시글의 개수 설정
    $config['total_rows'] = $this->Index_model->getPostsCount();

    // 페이지에 보여질 게시글의 개수 설정
    // view에서 select로 선택한 값으로 바뀔 예정
    $config['per_page'] = 25;
    // 페이지 번호 좌우로 몇개의 숫자 링크를 보여줄지 설정
    $config['num_links'] = 2;
    // 페이지네이션 링크의 '처음으로' 링크 설정
    $config['first_link'] = "처음";
    // 페이지네이션 링크의 '마지막으로' 링크 설정
    $config['last_link'] = "마지막";
    // 쿼리스트링을 사용하기 위한 설정
    $config['enable_query_strings'] = true;
    $config['page_query_string'] = true;
    // page number를 사용하여 url에 표현
    $config['use_page_numbers'] = true;
    $config['query_string_segment'] = "page";

    $this->pagination->initialize($config);

    // 개발 확인용
    // print_r($this->session->userdata());
    $data['username'] = $this->session->userdata('username');
    echo "<strong>현재 접속한 계정: " . $data['username'] . "</strong>";

    $data['notice_posts'] = $this->Index_model->getNoticePosts();
    // $this->uri->segment(2)를 통해 현재 페이지 번호를 가져옴
    $page_number = $this->input->get('page') ? $this->input->get('page') : 1;


    $data['posts'] = $this->Index_model->getPostsPaginated($config['per_page'], ($page_number - 1) * $config['per_page']);

    // $post 앞에 &를 붙여 참조할당을 통해 $data['notice_posts']배열의 해당 항목 변경
    foreach ($data['notice_posts'] as &$post) {
      $post_id = $post['id'];
      $post['notice_comment_count'] = $this->Index_model->countComment($post_id);
    }
    // $post 앞에 &를 붙여 참조할당을 통해 $data['posts']배열의 해당 항목 변경
    foreach ($data['posts'] as &$post) {
      $post_id = $post['id'];
      $post['comment_count'] = $this->Index_model->countComment($post_id);
    }

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

  // 검색 함수
  //! 페이지네이션을 통해 링크 클릭 시 검색 결과가 아닌 전체 데이터가 나오고있다..
  public function search() {
    // 페이지네이션 설정
    $config['base_url'] = base_url();
    
    // 토탈 게시글의 개수 설정
    //! 해당 부분을 검색결과에 따른 토탈 게시글로 바꿔줘야 함
    $config['total_rows'] = $this->Index_model->getPostsCount();

    // 페이지에 보여질 게시글의 개수 설정
    // view에서 select로 선택한 값으로 바뀔 예정
    $config['per_page'] = 25;
    // 페이지 번호 좌우로 몇개의 숫자 링크를 보여줄지 설정
    $config['num_links'] = 2;
    // 페이지네이션 링크의 '처음으로' 링크 설정
    $config['first_link'] = "처음";
    // 페이지네이션 링크의 '마지막으로' 링크 설정
    $config['last_link'] = "마지막";
    // 쿼리스트링을 사용하기 위한 설정
    $config['enable_query_strings'] = true;
    $config['page_query_string'] = true;
    // page number를 사용하여 url에 표현
    $config['use_page_numbers'] = true;
    $config['query_string_segment'] = "page";

    $this->pagination->initialize($config);

    // $this->uri->segment(2)를 통해 현재 페이지 번호를 가져옴
    $page_number = $this->input->get('page') ? $this->input->get('page') : 1;

    // 검색 폼으로부터 받아오는 데이터들
    $search_period = $this->input->post('search_period');
    $search_type = $this->input->post('search_type');
    $search_input = $this->input->post('search_input');

    $data['posts'] = $this->Index_model->getSearchPostsPaginated($search_period, $search_type, $search_input, $config['per_page'], ($page_number - 1) * $config['per_page']);

    // $post 앞에 &를 붙여 참조할당을 통해 $data['posts']배열의 해당 항목 변경
    foreach ($data['posts'] as &$post) {
      $post_id = $post['id'];
      $post['comment_count'] = $this->Index_model->countComment($post_id);
    }

    $this->layouts->view('posts/index_view', $data);
  }
}
?>