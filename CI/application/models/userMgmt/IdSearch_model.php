<?php
class IdSearch_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function checkEmail($email)
  {
    $query = $this->db->get_where('users', array('email' => $email));
    $user = $query->row_array();

    if ($user) {
      return $user['username'];
    } else {
      return false;
    }
  }

}
?>