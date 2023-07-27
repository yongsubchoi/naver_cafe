<?php
  class Index extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->library('layouts');
    }

    public function index() {
      $data['content'] = 'main sector';
      // $this->load->view('posts/index_view', $data);
      $this->layouts->view('posts/index_view', $data);
    }
  }
?>