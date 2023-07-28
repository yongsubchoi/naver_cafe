<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layouts {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function view($view, $data = array()) {
        $this->CI->load->view('layouts/header', $data);
        $this->CI->load->view('layouts/sideBar', $data);
        $this->CI->load->view($view, $data);
        $this->CI->load->view('layouts/footer', $data);
    }
}
?>
