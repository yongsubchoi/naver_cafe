<?php
  class SignUp extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->database();
      $this->load->model('userMgmt/SignUp_model');
    }

    public function index() {
      $data['questions'] = $this->SignUp_model->getQuestions();

      $this->load->view('userMgmt/signUp_view', $data);
    }
  }
?>