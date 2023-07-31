<?php
  class SignUp_model extends CI_Model {
    public function __construct() {
      parent::__construct();
      $this->load->database();
    }

    public function getQuestions() {
      $query = $this->db->query("SELECT * FROM security_questions");
      
      return $query->result_array();
    }
  }
?>