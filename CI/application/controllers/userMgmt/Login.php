<?php
  class Login extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->model('userMgmt/Login_model');
    }

    public function index() {
      /**
       * 폼으로부터 input 데이터를 가져온다.
       * 폼으로 부터 가져온 데이터를 검증한다.
       * 인증 성공 시 세션을 만든다.
       * 로그인 후 메인으로 리디렉션
       */
      $this->form_validation->set_rules('username', '아이디', 'required');
      $this->form_validation->set_rules('password_hash', '비밀번호', 'required');

      if ($this->form_validation->run()===FALSE) {
        // 폼 유효성 검사 실패 시
        $this->load->view('userMgmt/login_view');
      } else {
        // 폼 유효성 검사 성공 시
        echo "폼 유효성 검사 성공";

        $username = $this->input->post('username');
        $password = $this->input->post('password_hash');
        $user = $this->Login_model->getUserByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
          // form의 input 데이터가 DB의 데이터와 일치할 시
          echo "폼 유효성 검사 성공 및 form의 input이 DB와 일치할 시";
          // 세션 발급 및 메인으로 리디렉션
          $userData = array(
            'username' => $user['username'],
            'logged_in' => TRUE
          );
          $this->session->set_userdata($userData);
          // localhost(메인)로 이동
          redirect('');
        } else {
          // form의 데이터가 DB의 데이터와 일치하지 않을 시 다시 로그인 페이지로
          echo "form의 데이터가 DB의 데이터와 일치하지 않을 시";
          redirect('userMgmt/Login');
        }
      }
    }
  }
?>