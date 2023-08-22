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
    date_default_timezone_set('Asia/Seoul');
  }

  /**
   * @param string $id // 게시글의 post_id이다.
   */
  public function index($id)
  {
    // 세션데이터
    $data['username'] = $this->session->userdata('username');
    $data['user_id'] = $this->session->userdata('user_id');
    $data['logged_in'] = $this->session->userdata('logged_in');
    $data['is_admin'] = $this->session->userdata('is_admin');

    // post_id 값
    $data['post_id'] = $id;
    // post_id값으로 posts테이블의 데이터 가져오기
    $data['posts'] = $this->ReadPostsDetails_model->getPostsByUserId($id);
    // visibility 값을 가져옴
    $data['visibility'] = $data['posts']['visibility'];

    // 사용자 정보
    $data['user_info'] = $this->ReadPostsDetails_model->getUserInfoByPostId($id);
    // 파일 이름
    $data['file_name'] = $this->ReadPostsDetails_model->getFileNameByPostId($id);

    // 로그인한 사용자의 user_id
    $user_id = $this->session->userdata('user_id');
    // 로그인한 사용자의 프로필 사진 경로
    $data['logged_in_user_picture_path'] = $this->ReadPostsDetails_model->getProfilePicturePath($user_id);

    // 공개범위
    $data['is_visible'] = $this->check_visibility($data['visibility']);

    // 사용자가 게시물을 좋아요 했는지 안했는지
    $data['user_liked_post'] = $this->ReadPostsDetails_model->isPostLikedByUser($id, $data['user_id']); // 로그인한 사용자의 좋아요 여부

    // 좋아요 수 조회
    $data['like_count'] = $this->ReadPostsDetails_model->countLike($id);

    // 댓글 수 조회
    $data['comment_count'] = $this->ReadPostsDetails_model->countComment($id);

    $this->increase_view_count($id);

    // post_id로 comments테이블 조회
    $data['comments'] = $this->ReadPostsDetails_model->getCommentsByPostId($id);

    // 게시글 리스트 부분(페이지네이션)
    $config['base_url'] = base_url('posts/ReadPostsDetails/index/' . $id);
    $config['total_rows'] = $this->ReadPostsDetails_model->getTotalPostsCount();
    $config['per_page'] = 5;
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

    $page_number = $this->input->get('page') ? $this->input->get('page') : 1;

    $data['posts_list'] = $this->ReadPostsDetails_model->getPostsPaginated($config['per_page'], ($page_number - 1) * $config['per_page']);

    foreach ($data['posts_list'] as &$post) {
      $post_id = $post['id'];
      $post['comment_count'] = $this->ReadPostsDetails_model->countComment($post_id);
    }

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

  public function toggle_like()
  {
    $post_id = $this->input->post('post_id');
    $user_id = $this->session->userdata('user_id'); // 현재 로그인한 사용자 ID

    $response = $this->ReadPostsDetails_model->toggleLike($post_id, $user_id);

    echo $response;
  }
  public function get_like_count($post_id)
  {
    $like_count = $this->ReadPostsDetails_model->countLike($post_id);
    echo $like_count;
  }

  /**
   * @param string $id // posts테이블의 id
   */
  public function comment_form($id)
  {
    /**
     * view의 username을 user_id로 바꿔서 comments 테이블로 전달하는 로직이 필요
     * username으로 폼 검증하고, username에 맞는 user_id를 찾는 로직? 그렇게 구한 user_id를 comments로 전달하는 data에 넣어주기?
     * textarea인 name=comtent를 comments테이블로 전달하는 로직이 필요
     * created_at, parent_comment_id, level, display_order, path를 comments테이블에 전달하는 로직이 필요
     * comments테이블에 보낼 $data 배열 만든 후에 ReadPostsDetails_model->createComment($data)로 보내주기
     * post_id는 어떻게 data배열에 넣어줄까?
     * 현재 post_id는 게시글 상세조회시 index 메서드의 파라메타를 통해 받고있다.
     * post_id를 받으려면 comment_form이라는 함수를 따로 파는게 아니라 index에서 로직을 작성해야하나?
     * => 뷰에서 현재 $posts['id']를 갖고있으므로 form_open경로에 붙여주어 comment_form의 파라메터로 이용하자.
     */

    // 폼 유효성 검사
    $this->form_validation->set_rules('content', '', 'required');

    if ($this->form_validation->run() === FALSE) {
      echo "유효성 검사 실패";
    } else {
      $user_id = $this->session->userdata('user_id');
      $post_id = $id;
      $content = $this->input->post('content');

      // 시간대를 한국으로 설정
      date_default_timezone_set('Asia/Seoul');

      $data = array(
        'user_id' => $user_id,
        'post_id' => $post_id,
        'content' => $content,
        'created_at' => date('Y-m-d H:i:s')
      );
      $this->ReadPostsDetails_model->createComment($data);
      redirect('/posts/ReadPostsDetails/index/' . $id);
    }
  }

  public function edit_comment($comment_id)
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('userMgmt/Login');
    }
    $edited_content = $this->input->post('edited_content');
    $user_id = $this->session->userdata('user_id');

    // 수정하려는 댓글의 작성자인지 확인
    $comment = $this->ReadPostsDetails_model->getCommentById($comment_id);
    // if ($comment['user_id']!= $user_id) {
    //   // 본인 댓글이 아닌 경우 처리
    //   // 이 부분은 알맞게 에러 처리 or 리디렉션 처리
    // }
    // 수정할 댓글 내용 업데이트
    $data = array('content' => $edited_content);
    $this->ReadPostsDetails_model->updateComment($comment_id, $data);

    // 댓글 수정 완료 후 해당 게시글로 리디렉션
    $post_id = $this->ReadPostsDetails_model->getPostIdByCommentId($comment_id);
    redirect('posts/ReadPostsDetails/index/' . $post_id);
  }

  public function deletePosts($id)
  {
    $this->ReadPostsDetails_model->deletePosts($id);
    redirect('');
  }

  // public function deleteComment($id) {
  //   // 함수의 파라메터인 post_id를 이용하여 comments테이블의 id 값을 반환하여
  //   // 해당 comments 테이블의 id값을 삭제하는 로직 필요
  //   $comment_id = $this->

  //   $this->ReadPostsDetails_model->deleteComment($comment_id);
  //   redirect('');
  // }
}
?>