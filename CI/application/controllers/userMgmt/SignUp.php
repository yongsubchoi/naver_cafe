<?php
class SignUp extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->database();
    $this->load->model('userMgmt/SignUp_model');
  }

  public function index()
  {
    // * 회원가입 기능 구현
    // $profile_picture_path = $this->input->post('profile_picture_path');
    $username = $this->input->post('username');
    $password = $this->input->post('password_hash');
    $email = $this->input->post('email');
    $security_question_id = $this->input->post('security_question_id');
    $security_answer = $this->input->post('security_answer');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $this->form_validation->set_rules('username', '아이디', 'required');
    $this->form_validation->set_rules('password_hash', '비밀번호', 'required');
    $this->form_validation->set_rules('profile_picture_path', '프로필 사진', 'callback_check_profile_picture');

    // security_questions DB에서 질문들을 data라는 변수에 questions 키에 담는다.
    $data['questions'] = $this->SignUp_model->getQuestions();

    // 폼 유효성 검사 실행
    if ($this->form_validation->run() === FALSE) {
      // 폼 유효성 검사 실패 시
      $this->load->view('userMgmt/signUp_view', $data);
    } else {
      // 폼 유효성 검사 성공 시
      
      $profile_picture_path = $this->saveProfilePicture();

      $dbData = array(
        'username' => $username,
        'password_hash' => $hashedPassword,
        'email' => $email,
        'security_question_id' => $security_question_id,
        'security_answer' => $security_answer,
        'profile_picture_path' => $profile_picture_path,
        'created_at' => date('Y-m-d H:i:s')
      );
      $query = $this->SignUp_model->getWhere('username', $username);
      if ($query->num_rows() > 0) {
        echo "<script>alert('이미 존재하는 아이디입니다.')</script>";
        // 폼 유효성 검사 실패 시
        $this->load->view('userMgmt/signUp_view', $data);
      } else {
        $this->db->insert('users', $dbData);
        // 회원가입 성공 시 login 페이지로 이동
        redirect('userMgmt/Login');
      }
    }
  }

  private function saveProfilePicture() {
    $profile_picture_path = NULL;
    
    if (!empty($_FILES['profile_picture_path']['name'])) {
      $path = 'C:/workspace/naver_cafe/CI/uploads/profile_pictures';
      $filename = $this->input->post('profile_picture_path');

      $this->load->library('upload');
      //* 업로드 경로 설정
      $this->upload->set_upload_path($path);
      //* 업로드 파일 허용 타입
      $this->upload->set_allowed_types(['jpg', 'png']);
      //* 업로드 파일 최대 용량 설정
      $this->upload->set_max_filesize(2048);
      //* 경로에 중복된 이름이 있을 시 파일 명 뒤에 숫자 1을 증가시켜 고유성 확보
      $this->upload->set_filename($path, $filename);
      
      if ($this->upload->do_upload('profile_picture_path')) {
        // 업로드에 성공하면 파일명을 변수에 저장한다.
        $profile_picture_path = $this->upload->data('file_name');
      } else {
        // 업로드에 실패하면 에러 표시
        echo $this->upload->display_errors();
        exit();
      }
    }

    return $profile_picture_path;
  }

  // username 중복 체크를 위한 함수
  public function checkUsername() {
    $username = $this->input->post('username');

    $query = $this->SignUp_model->getWhere('username', $username);
    $response = array('exists' => $query->num_rows() > 0);
    echo json_encode($response);
  }

  // email 중복 체크를 위한 함수
  public function checkUserEmail() {
    $email = $this->input->post('email');

    $query = $this->SignUp_model->getWhere('email', $email);
    $response = array('exists' => $query->num_rows() > 0);
    echo json_encode($response);
  }

  public function check_profile_picture($str) {
    if (!empty($_FILES['profile_picture_path']['name'])) {
      return TRUE;
    } else {
      return TRUE;
    }
  }
}
?>