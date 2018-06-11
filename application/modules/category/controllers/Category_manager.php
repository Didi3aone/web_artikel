<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_manager extends CI_Controller
{

    private $_dm;
    private $_currentAdmin;
    private $_table = "tbl_kategori";
    private $_table_alias = "tk";
    private $_pk_field    = "kategori_id";

	public function __construct()
	{
       parent::__construct();
        
        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }
        
        $this->_footer = array(
            "script"    => array(),
            "css"       => array(),
        );
        
        //load model
        $this->load->model('Dynamic_model');

        $this->_dm = new Dynamic_model();
	}
    /*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"       => "Category",
            "breadcrumb"  => "<li><a href='/artikel/admin/dashboard'>Home</a></li><li> List Kategori </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "asset/js/pages/kategori/list.js",
            ),
        );
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view('category/index');
        $this->load->view(FOOTER_MANAGER, $footer);
    } 

    public function create()
    {
        $header = array(
            "title"       => "Data Artikel",
            "title_page"  => "Create Category",
            "breadcrumb"  => "<li><a href='/artikel/admin/dashboard'>Home</a></li><li> List Kategori </li>",
            "active_page" => "category",
            "css" => array(
                    "asset/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                "asset/js/pages/kategori/create.js",
                "asset/js/plugins/select2/select2.full.min.js",
            ),
        );

        $data['category'] = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->get_all_data(array("conditions" => array("parent_id" => "0")
        ));
        pr($data['category']);exit;
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view('category/create', $data);
        $this->load->view(FOOTER_MANAGER, $footer);
    } 

    /**
     * ajax get data
    */
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
        $select = array("kategori_id", "name", "created_date");
        $conditions = array('status' => STATUS_ACTIVE);

        $params = array(
            'select'            => $select,
            'conditions'        => $conditions,
            'count_all_first'   => true,
            'limit'             => $limit,
            'filter'            => array("name" => $search),
            'order_by'          => array($select[$sort_col] => $sort_dir),
        );

        $result = $this->_dm->set_model($this->_table, $this->_table_alias, $this->_pk_field)->get_all_data($params);
        // pr($result);exit;

        $output = array(
            "aaData" => $result['datas'],
            "sEcho"  => intval($this->input->get("sEcho")),
            "iTotalRecords" => $result['total'],
            "iTotalDisplayRecords" => $result['total'],
        );

        //output json encoding
        echo json_encode($output);
    }

    /**
     * ajax form
     */
    public function procces_form()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $this->load->model('Category_model');
        //initial error
        $message['is_error'] = true;

        $id = $this->input->post('id');
        $name = $this->input->post('nama_kategori');
        $desc = $this->input->post('desc');
        $parent = $this->input->post('parent');

        //check parent ID
        $parent = strtolower($parent);

        if($parent == "root") {
            $parent_id = "0";
        } else {
            $parent_id = $this->Category_model->get_category_id($parent_id);
        }
        
        $this->load->library('form_validation');

        if($id) {
            //check name is exist
            $params['conditions'] = array("kategori_id" => $id, "nama_kategori" => $name);
            $result = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->get_all_data($params);

            if(!$result) {
                $this->form_validation->set_rules("name", "Category Name", "is_unique[tbl_kategori.nama_kategori]", array("is_unique" => "This category is already exists!"));
            }
        }  
        else {
            //create
            $this->form_validation->set_rules("name", "Category Name" , "is_unique[tbl_kategori.nama_kategori]", array("is_unique" => "This category already exists !"));
        }    

        if($this->form_validation->run() == false) {
            //validations failed
            $message['error_msg'] = validation_errors();
        } else {
            //validation usccess
            $this->db->trans_begin();

            //prepare insert data
            $arrayToDB = array(
                "nama_kategori" => $name,
                "parent_id"     => $parent_id
            );
            
            //insert or update
            if($id == "") {
                $result = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->insert($arrayToDB);

                if ($this->db->trans_status() === FALSE || !$result) {
                    // Update failed, rollback
                    $this->db->trans_rollback();

                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "New category has been added.";
                    $message['redirect_to']     = "/artikel/manager/category";
                }
            } 
            else {
                //conditions for update
                $conditions = array("kategori_id" => $id);

                $result = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->update($arrayToDB, $conditions);

                if ($this->db->trans_status() === FALSE || !$result) {
                    // Update failed, rollback
                    $this->db->trans_rollback();

                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "Category has been updated.";
                    $message['redirect_to']     = "/artikel/manager/category";
                }
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function delete()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');
        // $is_active = $this->input->post('active');

        if(!empty($id)) {
            
            $data = array(
                "find_by_pk" => array($id),
                "count_all_first" => true,
                "status"          => STATUS_ACTIVE,
                "row_array"       => true,
            );
            $this->_category_model->get_all_data($data); 
        
        if($data['total'] == '') {
                show_404();
            } else {
                $this->db->trans_begin();

                $conditions = array('kategori_id' => $id);

                $result  = $this->_category_model->delete($conditions);

                //end transaction.
                if ($this->db->trans_status() === false) {
                    //failed.
                    $this->db->trans_rollback();

                    //failed.
                    $message['error_msg'] = 'database operation failed';

                } else {
                    //success.
                    $this->db->trans_commit();

                    $message['is_error'] = false;
                    $message['error_msg'] = '';

                    //smallbox.
                    $message['notif_title'] = "Done!";
                    $message['notif_message'] = "Category has been deleted.";
                    $message['redirect_to'] = "";
                }
                }
        } else {
            //id is not passed.
            $message['error_msg'] = 'Invalid ID.';
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

    
    public function list_select()
    {
    	//must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $select_q    = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();
        if($select_q != "") {
            $filters['nama_kategori'] = $select_q;

        }

        $conditions = array();
        $from = "tbl_kategori";
        //get data.
        $params = $this->_category_model->get_all_data(array(
            "select" => array("kategori_id", "nama_kategori"),
            "from"   => $from,
            "conditions" => $conditions,
            "filter_or" => $filters,
            "count_all_first" => true,
            "limit" => $limit,
            "start" => $start,
            "status" => STATUS_ACTIVE
        ));
        // pr($params);exit;

        //prepare returns.
        $message["page"] = $select_page;
        $message["total_data"] = $params['total'];
        $message["paging_size"] = $limit;
        $message["datas"] = $params['datas'];

        echo json_encode($message);
        exit;
    }
}

/* End of file category.php */
/* Location: ./application/controllers/admin/category.php */
