<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_manager extends CI_Controller
{
    private $_dm;
    private $_currentAdmin;
    private $_table = "tbl_tag";
    private $_table_aliases = "tt";
    private $_pk_field      = "tag_id";

	public function __construct()
	{
		parent::__construct();
		if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/admin/auth");
        }

        $this->load->model('Dynamic_model');
        $this->_dm = new Dynamic_model;
	}

	function index()
	{	
        $header  = array(
            "title"      => "Tag",
            "breadcrumb" => "<li> List Tag </li>",
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "asset/js/pages/tag/list.js"
            ),
        );
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view('tag/index');
        $this->load->view(FOOTER_MANAGER, $footer);
	}

	public function list_all_data()
    {
        //MUst AJAX AND GET mungkin lu hacker ya cuk
        if(!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        //declare variable here
        $sort_col = $this->input->get("iSortCol_0");
        $sort_dir = $this->input->get("sSortDir_0");
        $limit    = $this->input->get("iDisplayLength");
        $start    = $this->input->get("iDisplayStart");
        $search   = $this->input->get("sSearch");

        //modification query selected
        $select = array("*");
        $conditions = array('status' => STATUS_ACTIVE);

        $params = array(
            'select'            => $select,
            'conditions'        => $conditions,
            'count_all_first'   => true,
            'limit'             => $limit,
            'keywords'          => $search,
        );

        $result = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk_field)->get_all_data($params);
        // pr($result);exit;
        $output = array(
            "aaData"                => $result['datas'],
            "sEcho"                 => intval($this->input->get("sEcho")),
            "iTotalRecords"         => $result['total'],
            "iTotalDisplayRecords"  => $result['total'],
        );

        //output json encoding
        $this->output->set_content_type('application/json');
        echo json_encode($output);
        exit;
    }
    
    /**
     * function delete tag 
     */
    public function delete()
    {
        //MUst AJAX AND GET mungkin lu hacker ya cuk
        if(!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error'] = true;

        $id = $this->input->post('id');

        if(!empty($id)) {
            $conditions = array("tag_id" => $id);
            $delete = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk_field)->delete(array("tag_id" => $id));

            $message['is_error'] = false;
            $message['notif_title'] = "tag has been deleted";
            $message['redirect_to'] = "";
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }
}

/* End of file tag.php */
/* Location: ./application/controllers/admin/tag.php */
