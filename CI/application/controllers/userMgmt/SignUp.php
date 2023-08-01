<?php
class SignUp extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->database();
    $this->load->model('userMgmt/SignUp_model');
  }

  public function index()
  {
    // * 회원가입 기능 구현
    $profile_picture_path = $this->input->post('profile_picture_path');
    $username = $this->input->post('username');
    $password = $this->input->post('password_hash');
    $email = $this->input->post('email');
    $security_question_id = $this->input->post('security_question_id');
    $security_answer = $this->input->post('security_answer');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $this->form_validation->set_rules('username', '아이디', 'required');
    $this->form_validation->set_rules('password_hash', '비밀번호', 'required');

    // security_questions DB에서 질문들을 data라는 변수에 questions 키에 담는다.
    $data['questions'] = $this->SignUp_model->getQuestions();

    // 폼 유효성 검사 실행
    if ($this->form_validation->run() === FALSE) {
      // 폼 유효성 검사 실패 시
      $this->load->view('userMgmt/signUp_view', $data);
    } else {
      // 폼 유효성 검사 성공 시
      
      $dbData = array(
        'username' => $username,
        'password_hash' => $hashedPassword,
        'email' => $email,
        'security_question_id' => $security_question_id,
        'security_answer' => $security_answer,
        'profile_picture_path' => $profile_picture_path
      );
      $query = $this->SignUp_model->getWhere($username);
      if ($query->num_rows() > 0) {
        echo "<script>alert('이미 존재하는 아이디입니다.')</script>";
        // 폼 유효성 검사 실패 시
        $this->load->view('userMgmt/signUp_view', $data);
      } else {
        $this->db->insert('users', $dbData);
        redirect('userMgmt/Login');
      }
    }
  }

  public function checkUsername() {
    $username = $this->input->post('username');

    $query = $this->SignUp_model->getWhere('username', $username);
    $response = array('exists' => $query->num_rows() > 0);
    echo json_encode($response);
  }

  public function checkUserEmail() {
    $email = $this->input->post('email');

    $query = $this->SignUp_model->getWhere('email', $email);
    $response = array('exists' => $query->num_rows() > 0);
    echo json_encode($response);
  }
}
?>