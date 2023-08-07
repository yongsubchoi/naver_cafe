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
      $is_notice = ($this->input->post('is_notice') === 'on') ? true : false;
      $is_notice_value = $is_notice ? 1 : 0;

      $data = array(
        'user_id' => $user_id,
        'board_category' => $this->input->post('board_category'),
        'title' => $this->input->post('title'),
        'content' => $this->input->post('content'),
        'is_notice' => $is_notice_value,
        'created_at' => date('Y-m-d H:i:s'),
        'visibility' => $this->input->post('visibility'),
      );
      // $data를 posts 테이블에 삽입
      $this->CreatePosts_model->createPost($data);
      // 완료 후 메인으로 리디렉션
      // ! 게시글 상세조회 페이지 구현 후 리디렉션 바꿔주기
      redirect('');
    }
  }
}
?>