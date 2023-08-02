<?php
class PwdSearch_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getQuestions()
  {
    $query = $this->db->query("SELECT * FROM security_questions");

    return $query->result_array();
  }

  public function getUserByUsernameAndSecurityInfo($username, $security_question_id, $security_answer)
  {
    $this->db->where('username', $username);
    $this->db->where('security_question_id', $security_question_id);
    $this->db->where('security_answer', $security_answer);
    $query = $this->db->get('users');

    return $query->row_array();
  }

  public function updatePassword($username, $hashedPassword)
  {
    $this->db->where('username', $username);
    $this->db->update('users', array('password_hash' => $hashedPassword));
  }

  public function checkAnswer($username, $security_question_id, $security_answer) {
    $query = $this->db->get_where('users', array(
      'username' => $username,
      'security_question_id' => $security_question_id,
      'security_answer' => $security_answer
    ));
  
    return $query->num_rows() > 0;
  }
  
}
?>