<?php
class ReadPostsDetails_model extends CI_Model
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

  // post테이블의 id를 이용하여 users테이블의 정보를 반환하는 함수
  public function getUserInfoByPostId($id)
  {
    $this->db->select('users.username, users.profile_picture_path');
    $this->db->from('posts');
    $this->db->join('users', 'posts.user_id = users.id');
    $this->db->where('posts.id', $id);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row;
    } else {
      return false;
    }
  }

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

  public function increaseViewCount($id)
  {
    $this->db->where('id', $id);
    $this->db->set('view_count', 'view_count+1', FALSE); // view_count 컬럼 증가
    $this->db->update('posts');
  }

  // public function isPostLiked($post_id, $user_id)
  // {
  //   $query = $this->db->get_where('likes', array(
  //     'post_id' => $post_id,
  //     'user_id' => $user_id
  //   )
  //   );

  //   return $query->num_rows() > 0;
  // }

  // public function toggleLike($post_id, $user_id)
  // {
  //   if ($this->isPostLiked($post_id, $user_id)) {
  //     $this->db->where('post_id', $post_id);
  //     $this->db->where('user_id', $user_id);
  //     $this->db->delete('likes');
  //     return 'unliked';
  //   } else {
  //     $data = array(
  //       'post_id' => $post_id,
  //       'user_id' => $user_id,
  //       'created_at' => date('Y-m-d H:i:s') // 현재 시간 저장
  //     );
  //     $this->db->insert('likes', $data);
  //     return 'liked';
  //   }
  // }
}
?>