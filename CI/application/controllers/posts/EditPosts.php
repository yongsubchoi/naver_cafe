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
  }

  public function index()
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
     */
  }
}
?>