<?php
class IdSearch extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('userMgmt/IdSearch_model');
  }

  public function index()
  {
    /**
     * todo 필요한 로직
     * form 태그의 email을 가져온다.
     * 확인 버튼을 누르면
     * 가져온 email을 db의 데이터와 비교한다.
     * ? 일치할 시
     * db의 email과 form 태그의 email이 일치 시 해당 row의 username을 반환한다.
     * 반환한 username은 id가 'searched_id'인 div의 내용으로 들어가게 한다.
     * ? 불일치 시
     * id가 'email_status'인 div에 빨간색으로
     * ! 등록된 email이 아닙니다.
     * 를 나타낸다.(평사시에는 안보이게)
     */
    $this->form_validation->set_rules('email', '회원 가입 시 사용한 email', 'required');

    if ($this->form_validation->run() === FALSE) {
      // 폼 유효성 검사 실패 시
      $this->load->view('userMgmt/idSearch_view');
    } else {
      // 폼 유효성 검사 성공 시
      // $this->check_email();
      redirect('userMgmt/Login');
    }
  }
  public function check_email()
  {
    $email = $this->input->post('email');

    $username = $this->IdSearch_model->checkEmail($email);

    // JSON 형태로 응답
    $response = array('exists' => ($username !== false), 'username' => $username);
    echo json_encode($response);
  }

}
?>