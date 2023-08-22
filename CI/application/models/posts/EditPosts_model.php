<?php
class EditPosts_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // posts테이블의 id를 이용하여 해당 id의 row를 반환하는 함수
  public function getPostsByUserId($id)
  {
    // posts테이블에서 id 값이 $id인 값을 조회
    $query = $this->db->get_where('posts', array('id' => $id));
    // 쿼리 결과를 배열로 담아 반환
    return $query->row_array();
  }

  // post_id를 이용하여 files테이블의 file_name을 가져오는 함수
  public function getFileNameByPostId($id)
  {
    $this->db->select('files.file_name');
    $this->db->from('files');
    $this->db->join('posts', 'posts.id = files.post_id');
    $this->db->where('posts.id', $id);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $rows = $query->result(); // 여러 행을 가져옴
      return $rows;
    } else {
      return false;
    }
  }

  public function getFileByPostId($id)
  {
    $this->db->select('files.file_name');
    $this->db->from('files');
    $this->db->join('posts', 'posts.id = files.post_id');
    $this->db->where('posts.id', $id);

    $query = $this->db->get();

    return $query->row();
  }

  public function updatePost($id, $title, $content, $visibility, $board_category)
  {
    $data = array(
      'title' => $title,
      'content' => $content,
      'visibility' => $visibility,
      'board_category' => $board_category,
      // 'created_at' => date('Y-m-d H:i:s'),
    );

    $this->db->where('id', $id);
    $this->db->update('posts', $data);
  }

  public function insertOrUpdateFile($post_id, $file_name)
  {
    $data = array(
      'file_name' => $file_name,
      'file_path' => 'uploads/post_files/' . $file_name,
      // 파일 경로 수정 필요
      'file_size' => filesize('C:/workspace/naver_cafe/CI/uploads/post_files/' . $file_name),
      // 파일 크기 가져오기
      'file_type' => pathinfo('C:/workspace/naver_cafe/CI/uploads/post_files/' . $file_name, PATHINFO_EXTENSION),
      // 파일 확장자 가져오기
      'created_at' => date('Y-m-d H:i:s'),
      'user_id' => $this->session->userdata('user_id'),
      'post_id' => $post_id,
    );

    // 파일이 이미 존재하는 경우에는 업데이트, 그렇지 않은 경우에는 새로운 파일로 insert
    $existing_file = $this->getFileByPostId($post_id);
    if ($existing_file) {
      $this->db->where('post_id', $post_id);
      $this->db->update('files', $data);
    } else {
      $this->db->insert('files', $data);
    }
  }
}
?>