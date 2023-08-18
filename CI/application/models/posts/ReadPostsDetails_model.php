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

  // user_id에 해당하는 프로필 사진 경로를 반환하는 함수
  public function getProfilePicturePath($user_id)
  {
    $this->db->select('profile_picture_path');
    $this->db->from('users');
    $this->db->where('id', $user_id);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->profile_picture_path;
    } else {
      return null; // 사용자 ID에 해당하는 프로필 사진이 없는 경우
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

  //* 조회수 기능 관련 함수
  // id가 $id인 view_count컬럼을 1증가시킨다.
  public function increaseViewCount($id)
  {
    $this->db->where('id', $id);
    $this->db->set('view_count', 'view_count+1', FALSE); // view_count 컬럼 증가
    $this->db->update('posts');
  }

  //* 좋아요 기능 관련 함수들
  public function isPostLiked($post_id, $user_id)
  {
    $query = $this->db->get_where(
      'likes',
      array(
        'post_id' => $post_id,
        'user_id' => $user_id
      )
    );

    return $query->num_rows() > 0;
  }

  public function toggleLike($post_id, $user_id)
  {
    if ($this->isPostLiked($post_id, $user_id)) {
      $this->db->where('post_id', $post_id);
      $this->db->where('user_id', $user_id);
      $this->db->delete('likes');
      return 'unliked';
    } else {
      $data = array(
        'post_id' => $post_id,
        'user_id' => $user_id,
        'created_at' => date('Y-m-d H:i:s') // 현재 시간 저장
      );
      $this->db->insert('likes', $data);
      return 'liked';
    }
  }

  public function isPostLikedByUser($post_id, $user_id)
  {
    $query = $this->db->get_where('likes', array('post_id' => $post_id, 'user_id' => $user_id));
    return $query->num_rows() > 0;
  }

  public function countLike($post_id)
  {
    // likes테이블에서 해당 post_id의 row수를 반환하는 로직
    $this->db->where('post_id', $post_id);
    $query = $this->db->get('likes');
    return $query->num_rows();
  }

  public function countComment($post_id)
  {
    $this->db->where('post_id', $post_id);
    $query = $this->db->get('comments');
    return $query->num_rows();
  }

  // 테이블에 $data를 삽입하는 함수
  public function createComment($data)
  {
    // $data를  posts테이블에 삽입
    $this->db->insert('comments', $data);

    // 삽입된 댓글의 id를 반환
    return $this->db->insert_id();
  }

  // post_id를 이용하여 comments 데이터를 반환하는 함수
  public function getCommentsByPostId($post_id)
  {
    $this->db->select('comments.*, users.username, users.profile_picture_path');
    $this->db->from('comments');
    $this->db->join('users', 'comments.user_id = users.id');
    $this->db->where('comments.post_id', $post_id);
    $this->db->order_by('comments.created_at', 'asc'); // 댓글 작성 시간 순으로 정렬

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return array(); // 댓글이 없는 경우 빈 배열 반환
    }
  }

  // posts테이블의 전체 레코드 수를 반환하는 함수
  public function getTotalPostsCount() {
    return $this->db->count_all('posts');
  }

  public function getPostsPaginated($limit, $offset) {
    $this->db->select('p.*, u.username');
    $this->db->from('posts p');
    $this->db->join('users u', 'p.user_id = u.id');
    $this->db->order_by('p.created_at', 'DESC');
    $this->db->limit($limit, $offset);

    $query = $this->db->get();
    return $query->result_array();
  }
}
?>