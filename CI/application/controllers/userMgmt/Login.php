<?php
  class Login extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('userMgmt/Login_model');
    }

    public function index() {
      

      
      $this->load->view('userMgmt/login_view');
    }
  }
?>