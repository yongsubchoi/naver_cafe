<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layouts {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function view($view, $data = array()) {
        
        $view_data = array(
            "content" => $this->CI->load->view($view, $data, true)
        );

        $this->CI->load->view("/layouts/layout", $view_data);

    }
}
?>
