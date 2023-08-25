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

  //! getPostsPaginated 함수를 참고하여 페이지네이션 기능을 고려해야한다.
  // 게시글 검색 함수
  public function searchPosts($search_period, $search_type, $search_input) {
    /**
     * todo 필요한 로직
     * 검색기간, 검색타입, 검색어를 이용하여 해당 조건에 맞는 게시글들을 반환해주어야 한다.
     * ? 검색 기간
     * 전체기간, 1주, 1달, 6달, 1년
     * ? 검색 타입
     * 게시글+댓글, 제목, 글작성자, 댓글내용, 댓글작성자
     * 
     */
  }
}
?>