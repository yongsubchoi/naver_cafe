<?php
  class Index_model extends CI_Model {
    public function __construct() {
      parent::__construct();
      $this->load->database();
    }
    public function getPosts() {
      $query = $this->db->query("SELECT p.*, u.username 
      FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      ORDER BY p.created_at DESC");

      return $query->result_array();
    }
  }
?>