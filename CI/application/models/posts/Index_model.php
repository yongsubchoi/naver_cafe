<?php
class Index_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  // 공지글 불러오는 함수
  public function getNoticePosts()
  {
    $query = $this->db->query("SELECT p.*, u.username 
    FROM posts p
    INNER JOIN users u ON p.user_id = u.id
    WHERE p.is_notice = TRUE
    ORDER BY p.created_at DESC");

    return $query->result_array();
  }
  public function getPostsCount()
  {
    return $this->db->count_all('posts'); // 'posts' 테이블의 전체 레코드 수 반환
  }

  // 페이지네이션될 게시글들을 불러오는 함수
  public function getPostsPaginated($limit, $offset)
  {
    $this->db->select('p.*, u.username');
    $this->db->from('posts p');
    $this->db->join('users u', 'p.user_id = u.id');
    $this->db->order_by('p.created_at', 'DESC');
    $this->db->limit($limit, $offset);

    $query = $this->db->get();
    return $query->result_array();
  }

  // 댓글의 개수를 카운트하는 함수
  public function countComment($post_id)
  {
    $this->db->where('post_id', $post_id);
    $this->db->where('is_deleted', 0);
    $query = $this->db->get('comments');
    return $query->num_rows();
  }

  // 게시글 검색 함수
  //! 게시글 + 댓글 로직 추가 필요
  public function getSearchPostsPaginated($search_period, $search_type, $search_input, $limit, $offset)
  {
    $this->db->select('p.*, u.username');
    $this->db->from('posts p');
    $this->db->join('users u', 'p.user_id = u.id');
    $this->db->order_by('p.created_at', 'DESC');

    if ($search_period === '1week') {
      $this->db->where('p.created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK)');
    } elseif ($search_period === '1month') {
      $this->db->where('p.created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)');
    } elseif ($search_period === '6month') {
      $this->db->where('p.created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)');
    } elseif ($search_period === '1year') {
      $this->db->where('p.created_at >= DATE_SUB(NOW(), INTERVAL 1 YEAR)');
    }

    // 중복된 게시글은 나오지 않게하기 위해 설정
    $this->db->distinct();

    if ($search_type === 'title') {
      $this->db->like('p.title', $search_input);
    } elseif ($search_type === 'post_username') {
      $this->db->like('u.username', $search_input);
    } elseif ($search_type === 'comment_content') {
      $this->db->join('comments c', 'p.id = c.post_id', 'left');
      $this->db->like('c.content', $search_input);
    } elseif ($search_type === 'comment_username') {
      $this->db->join('comments c', 'p.id = c.post_id', 'left');
      $this->db->join('users', 'c.user_id = users.id', 'left'); // 댓글 작성자 정보 조인
      $this->db->like('users.username', $search_input); // username으로 검색
    } elseif ($search_type === 'all') {
      // '게시글+댓글' 검색 로직 추가
      $this->db->join('comments c', 'p.id = c.post_id', 'left');
      $this->db->join('users', 'p.user_id = users.id', 'left'); // 사용자 정보 조인
      $this->db->like('p.title', $search_input);
      $this->db->or_like('users.username', $search_input);
      $this->db->or_like('c.content', $search_input);
    }

    $this->db->limit($limit, $offset);

    $query = $this->db->get();
    return $query->result_array();
  }
}
?>