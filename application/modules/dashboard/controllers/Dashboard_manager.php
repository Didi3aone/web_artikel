<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_manager extends CI_Controller
{
    private $_header;
    protected $_currentUser;

	public function __construct()
	{
        parent::__construct();
         //save current user if he is already logged in.
        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }

     
        $this->load->model(array(
            'article/Article_model',
            'user/User_model'
        ));
        $this->load->helper('url');
	}


    /**
     * [index description]
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
	public function index($slug = null)
	{
        $this->_header = array("title" => "Dashboard");
		$data = array(
            "title"      => "Dashboard",
            "title_page" => "Dashboard",
            "breadcrumb" => "<li> Dashboard </li>",
            "main"    =>  "admin/dashboard/dashboard"
        );

		$this->load->view(HEADER_MANAGER,$this->_header);
        $this->load->view('admin/dashboard/dashboard',$data);
        $this->load->view(FOOTER_MANAGER);
	} 
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */
