<?php class MY_Exceptions extends CI_Exceptions {

    public function __construct() {
        parent::__construct();
    }

    function show_404($page = '', $log_error = TRUE) {
        $CI = &get_instance();
        $CI->output->set_status_header('404');
        $CI->load->view('errors/error_404');
        echo $CI->output->get_output();
        exit;
    }

}