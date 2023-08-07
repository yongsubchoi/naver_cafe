<?php
class CreatePosts_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  // username으로 user_id를 반환하는 함수
  public function getUserIdByUsername($username)
  {
    $query = $this->db->select('id')->from('users')->where('username', $username)->get();
    // 쿼리 결과가 존재 할 시
    if ($query->num_rows() > 0) {
      // 쿼리 결과의 row를 담는 변수
      $row = $query->row();
      // 직접 접근하여 결과값의 id를 반환
      return $row->id;
    }
  }
  // 테이블에 $data를 삽입하는 함수
  public function createPost($data)
  {
    // $data를  posts테이블에 삽입
    $this->db->insert('posts', $data);
  }
}
?>