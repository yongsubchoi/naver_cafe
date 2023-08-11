<?php
  class ReadPostsDetails_model extends CI_Model {
    public function __construct() {
      parent::__construct();
    }

    public function getPostsByUserId($id) {
      // posts테이블에서 id 값이 $id인 값을 조회
      $query = $this->db->get_where('posts', array('id'=>$id));
      // 쿼리 결과를 배열로 담아 반환
      return $query->row_array();
    }
  }
?>