<?php
class PwdSearch extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('userMgmt/PwdSearch_model');
  }

  public function index()
  {
    // $this->load->view('userMgmt/pwdSearch_view');

    $this->form_validation->set_rules('username', '아이디', 'required');
    $this->form_validation->set_rules('security_answer', '질문 답변', 'required');
    $this->form_validation->set_rules('password_hash', '새로운 비밀번호', 'required');

    $data['questions'] = $this->PwdSearch_model->getQuestions();

    if ($this->form_validation->run() === FALSE) {
      // 폼 유효성 검사 실패 시
      $this->load->view('userMgmt/pwdSearch_view', $data);
    } else {
      // 폼 유효성 검사 성공 시
      /**
       * users테이블에서 사용자가 입력한 username, security_question_id에 대한 security_answer가 일치하는지 확인하는 절차 필요 -> js파일에서 ajax처리를 해야하나? -> 비밀번호는 보안과 관련이 있으므로 클라이언트 측 js파일을 거치지 않고 서버측(컨트롤러)에서 처리하는 것이 좋다고 한다.
       * 해당 확인 후 새로운 비밀번호로 users테이블의 password_hash값을 수정해주는 작업 필요(해시화 필수)
       */
      // 해당 로직에 필요한 form에서 받아온 데이터들
      $username = $this->input->post('username');
      $security_question_id = $this->input->post('security_question_id');
      $security_answer = $this->input->post('security_answer');
      $newPassword = $this->input->post('password_hash');

      // users 테이블에서 입력된 정보와 일치하는 사용자를 찾는다.
      $user = $this->PwdSearch_model->getUserByUsernameAndSecurityInfo($username, $security_question_id, $security_answer);

      if ($user) {
        // 사용자 정보가 일치하는 경우, 비밀번호를 해시화하여 업데이트합니다.
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->PwdSearch_model->updatePassword($user['username'], $hashedPassword);

        // 비밀번호 변경 성공 시 처리
        redirect('userMgmt/Login');
      } else {
        // 사용자 정보가 일치하지 않는 경우

        redirect('userMgmt/PwdSearch');
      }

    }

  }
  public function check_answer()
  {
    $username = $this->input->post('username');
    $security_question_id = $this->input->post('security_question_id');
    $security_answer = $this->input->post('security_answer');

    // 해당 사용자 정보와 질문의 답을 DB에서 확인하여 일치하는지 검사
    $isMatch = $this->PwdSearch_model->checkAnswer($username, $security_question_id, $security_answer);

    // JSON 형태로 응답
    $response = array('match' => $isMatch);
    echo json_encode($response);
  }
}
?>