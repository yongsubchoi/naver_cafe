<?php
  class IdSearch extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->helper('url');
      $this->load->model('userMgmt/IdSearch_model');
    }

    public function index() {
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

      $this->load->view('userMgmt/idSearch_view');
    }
  }
?>