<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_manager extends CI_Controller {

    private $_user_model;
    private $_currentAdmin;

    private $_title       = "User";
    private $_title_page  = "User";
    private $_breadcrumb  = "<li><a href='/artikel/admin/dashboard'>Home</a></li>";
    private $_active_page = "User";
    private $_view        = 'user/';

	function __construct() {
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

		$this->load->helper(array('url','form','file'));
		$this->load->model('User_model');

        $this->_user_model = new User_model;
	}
   
    function index()
    {
        $header = array(
            "title"      => $this->_title,   
            "title_page" => $this->_title_page,
            "breadcrumb" => $this->_breadcrumb ."<li>User</li>",
            "active-page"=> $this->_active_page ."-list",
                "css" => array(
                    "asset/js/plugins/lightbox/css/lightbox.css"
            )
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "asset/js/plugins/lightbox/js/lightbox.js",
                "asset/js/pages/user/list.js"
            ),
        );
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view . 'index');
        $this->load->view(FOOTER_MANAGER, $footer);	
    }

     /**
     * create new article
     */
    public function create()
    {
        $this->_header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page."-create",
            "breadcrumb"    => $this->_breadcrumb. "<li> Buat Artikel </li>",
            "active-page"   => $this->_active_page ."-create",
                "css" => array(
                    "asset/css/select2.min.css",
                ),
        );

        $this->_footer = array(
            "script" => array(
                "asset/js/pages/user/create.js",
                "asset/js/plugins/cropper/cropper.min.js",
                "asset/js/crop-master.js",
                "asset/js/plugins/select2/select2.full.min.js",
            ),

            "css"   => array(
                "asset/js/plugins/cropper/crop.css",
                "asset/js/plugins/cropper/cropper.css"
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $this->_header);
        $this->load->view($this->_view .'create');
        $this->load->view(FOOTER_MANAGER,$this->_footer);
    }

    /**
     * create new article
    */
    public function edit($id = null)
    {
        $this->_header = array(
            "title"         => $this->_title ."Edit",
            "title_page"    => $this->_title_page. "-Edit",
            "breadcrumb"    => $this->_breadcrumb ."<li> Edit User</li>",
            "active-page"   => $this->_active_page ."-edit",
                "css" => array(
                    "asset/css/select2.min.css",
                    "asset/js/plugins/lightbox/css/lightbox.css",
                    "asset/js/plugins/cropper/crop.css",
                    "asset/js/plugins/cropper/cropper.css"
            ),
        );

        $this->_footer = array(
            "script" => array(
                "asset/js/pages/user/create.js",
                "asset/js/plugins/cropper/cropper.min.js",
                "asset/js/crop-master.js",
                "asset/js/plugins/select2/select2.full.min.js",
                "asset/js/plugins/lightbox/js/lightbox.js"
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $this->_header);
        $this->load->view('admin/user/add');
        $this->load->view(FOOTER_MANAGER,$this->_footer);
    }
    
    /**
     * Change Password
     */
    public function change_password () {
        //prepare header title.
        $this->_header = array(
            "title"         => 'Change Password',
            "title_page"    => '<i class="fa-fw fa fa-user"></i> Change Password',
            "active_page"   => '',
            "breadcrumb"    =>  $this->_breadcrumb . '<li>Change Password</li>',
        );

        $this->_footer = array(
            "script" => array("asset/js/pages/user/change-password.js"),
        );

        //load the view.
        $this->load->view(HEADER_MANAGER, $this->_header);
        $this->load->view($this->_view .'change-pass');
        $this->load->view(FOOTER_MANAGER, $this->_footer);
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
        $select      = array("user_id","name","username","ur.role_name");
        $left_joined = array('tbl_user_role ur' => array('ur.role_id' => 'us.role_id'));

        $params = array(
            'select'            => $select,
            'left_joined'       => $left_joined,
            'order_by'          => array($select[$sort_col] => $sort_dir),
            'count_all_first'   => true,
            'limit'             => $limit,
            'keywords'          => $search,
        );

        $result = $this->_user_model->get_all_data($params)['datas'];
        // pr($result);exit;

        //Get total rows
        $total_rows = $this->_user_model->count_all_data(null, $search);

        $output = array(
            "aaData" => $result,
            "sEcho"  => intval($this->input->get("sEcho")),
            "iTotalRecords" => $total_rows,
            "iTotalDisplayRecords" => $total_rows,
        );

        //output json encoding
        $this->output->set_content_type('application/json');
        echo json_encode($output);
        exit;
    }

    /**
     * set validation for admin  create and edit
     */
    private function _set_rule_validation($id) {
        
        //preparing to set delimiters
        $this->form_validation->set_error_delimiters();

        //validates
        $this->form_validation->set_rules('username','Username',"trim|required|callback_check_username[$id]");
        $this->form_validation->set_rules('email','Email',"trim|required|callback_check_email[$id]");

        //when insert only, check password and username
        if(!$id) {
            $this->form_validation->set_rules('password','Password',"trim|required|min_length[6]|max_length[20]");
            $this->form_validation->set_rules('conf_password','Password Confirmation','trim|required|min_length[6]|max_length[20]|matches[password]');
        } else {
            $this->form_validation->set_rules('new_password','New Password','trim|required|min_length[6]|max_length[20]');
            if($this->input->post('new_password') != "") $this->form_validation->set_rules('conf_new_password','Confirmation New Password','trim|required|min_length[6]|max_length[20]');
        }
    }
    
    /**
     * 
     * set rule validation edit profile
     */
    private function _set_rule_validation_profile($id) {
      
        $this->form_validation->set_error_delimiters('','');

        //validates
        $this->form_validation->set_rules("name",'Name','trim|required|min_length[6]|max_length[100]');

        //special validations for when editing
        $this->form_validation->set_rules('username','Username',"trim|required|callback_check_username[$id]");
        $this->form_validation->set_rules('email','Email',"trim|required|callback_check_email[$id]");
    }

    /**
     * set rule validation for change password
     */
    private function _set_rule_validation_pass () {
        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules("password", "Old Password", "required|min_length[5]|max_length[12]");
        $this->form_validation->set_rules("new_password", "New Password", "required|min_length[5]|max_length[12]|matches[confirm_password]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "required|min_length[5]|max_length[12]");
    }

    /**
     * this is a custom form validation rule to check that username is must unique
     */
    public function check_username($str, $id) {

        //flag
        $isValid = true;
        $params = array("row_array" => true);

        if($id == "") {
            //from create 
            $params['conditions'] = array("lower(username)" => strtolower($str));
        } else {
            $params['conditions'] = array("lower(username)" => strtolower($str), "user_id !=" => $id);
        }

        $datas = $this->User_model->get_all_data($params)['datas'];

        if($datas) {
            $isValid = false;
            $this->form_validation->set_message('check_username','{field} is already taken.');
        }

        return $isValid;
    } 

    /**
     * This is a custom form validation rule to check that email is must unique.
     */
    public function check_email($str, $id) {

        //flag.
        $isValid = true;
        $params = array("row_array" => true);

        if ($id == "") {
            //from create
            $params['conditions'] = array("lower(email)" => strtolower($str));
        } else {
            $params['conditions'] = array("lower(email)" => strtolower($str), "user_id !=" => $id);
        }

        $datas = $this->User_model->get_all_data($params)['datas'];
        if ($datas) {
            $isValid = false;
            $this->form_validation->set_message('check_email', '{field} is already taken.');
        }

        return $isValid;
    }

    // /**
    //  * check old password sane as inputed old password
    //  */
    // public function password_check($old_pass) {

    //     $pass = $this->session->userdata('password');

    //     //check password
    //     if(password_verify($old_pass, $pass)) {
    //         return TRUE;
    //     } else {
    //         $this->form_validation->set_message('password_check','{filed} does not match');
    //     }
    // }

    /**
     * ajax form 
     */
    public function process_form()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //load form validation
        $this->load->library('form_validation');
        
        $message['is_error'] = true;
        $message['redirect_to'] = '';

        $id             = $this->input->post('id');
        $name           = $this->input->post('name');
        $username       = $this->input->post('username');
        $email          = $this->input->post('email');
        $password       = sha1($this->input->post('password'));
        $new_password   = sha1($this->input->post('new_password'));
        $role_id        = $this->input->post('role_id');
        $date           = date('Y-m-d H:i:s');
        $create_by      = $this->session->userdata('user_id');
        // pr($this->input->post());exit;
        
        //set validation
        $this->_set_rule_validation($id);

        if($this->form_validation->run($this) == FALSE)
        {
            $message['error_msg'] = validation_errors();
        } 
        else {
             //begin transaction
            $this->db->trans_begin();
            
            //prepare save to DB
            $save = array(
               'name'           => $name,
               'username'       => $username,
               'password'       => $password, 
               'email'          => $email,
               'created_date'   => $date,
               'user_create_by' => $create_by,
               'role_id'        => $role_id,
            );

            //insert or update
            if($id == "") {
                
                if(!empty($_FILES['name']['photo'])) {
                    $save['photo'] = $this->do_upload();
                }

                //insert to DB
                $result = $this->_user_model->insert($save);

                //end transaction
                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']    = false;
                    $message['notif_title'] = 'Good!';
                    $message['notif_message'] = 'User has been added';
                    $message['redirect_to'] = site_url('admin/user');
                }

            } else {
                //update
                $condition = array('user_id' => $id);
                $upload_result = $this->upload(false);
                
                if($upload_result != null) 
                    $save['artikel_photo'] = $save['artikel_photo'] = "/".$upload_result['result'][1]['uploaded_path'];

                $result = $this->_article_model->update($save, $condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Insert failed! Please try again.';
                } else {
                    $this->db->trans_commit();
                    //growler.
                    $message['is_error']    = false;
                    $message['notif_title'] = "Excellent!";
                    $message['notif_message'] = "User has been updated.";

                    //on update, redirect.
                    $message['redirect_to'] = site_url('admin/user');
                }
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * process form user level
     */
    public function process_form_level() {
        if(!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }
        $this->load->model('User_level_model');
        $this->load->library('form_validation');

        //initial
        // $message['is_error'] = true;

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        // pr($this->input->post());exit;

        $this->form_validation->set_rules('name', 'Level Name','trim|required');
        if($this->form_validation->run() == false) {

            $message['error_msg'] = validation_errors();
        } else {

            $check_name = $this->User_level_model->name_exist($name);

            $save = array(
                'role_name' => $name,
                'description' => $desc
            );

            if(!$check_name) {
                $result = $this->User_level_model->insert($save);

                $message['is_error'] = false;
                $message['notif_title'] = 'success';
            } else {

                $condition = array('role_id' => $id);
                $result = $this->User_level_model->update($save, $condition);

                $message['is_error'] = false;
                $message['notif_title'] = 'success';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * change profile
     */
    public function change_profile()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $this->load->library('form_validation');

        //load the model
        $this->load->model('User_model');

        //initial.
        $message['is_error'] = true;
        $message['redirect_to'] = "";
        $message['error_msg'] = "";

        $id = $this->session->userdata('user_id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $email    = $this->input->post('email');

        $this->_set_rule_validation_profile($id);
        if($this->form_validation->run($this) == false) {

            //validation failed
            $message['error_msg'] = validation_errors();
        } else {
            //begin transactions
            $this->db->trans_begin();

            //validation success prepare save
            $save = array(
                'name' => $name,
                'username' => $username,
                'email'    => $email,
            );

            if(!empty($id)) {
                $condition = array('user_id' => $id);
                $insert = $this->User_model->update($save, $condition);
            }

            if($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Database operation failed';
            } else {
                $this->db->trans_commit();

                $message['notif_title'] = 'Good!';
                $message['notif_message'] = 'Change profile has been success';

                $message['redirect_to']   = site_url('admin/user');

                //reset session 
                $params = array("row_array" => true, "conditions" => array("user_id" => $id));
                $data_user = $this->User_model->get_all_data($params);
                $this->session->set_userdata($data_user['user_id']);
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * Change Password Process form
     */
    public function change_password_process(){
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //load form validation lib.
        $this->load->library('form_validation');

        //initial.
        $message['is_error'] = true;
        $message['redirect_to'] = "";
        $message['error_msg'] = "";

        $id = $this->session->userdata('user_id');
        $password= sha1($this->input->post('confirm_password'));
        // pr($id);exit;
        $pass = $this->session->userdata("password");
        // pr($pass);exit;
        // 
        $this->_set_rule_validation_pass();

        if ($this->form_validation->run($this) == FALSE) {
            //validation failed.
            $message['error_msg'] = validation_errors();
        } else {
            //begin transaction.
            $this->db->trans_begin();

            //validation success, prepare array to DB.
            $arrayToDB = array('password'   => $password);

            if (!empty($id)) {

                $condition = array("user_id" => $id);
                $insert = $this->_user_model->update($arrayToDB,$condition);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'database operation failed.';

            } else {
                $this->db->trans_commit();

                //set is error to false
                $message['is_error'] = false;

                //success.
                //growler.
                $message['notif_title'] = "Good!";
                $message['notif_message'] = "Password has been updated.";

                //on insert, not redirected.
                $message['redirect_to'] = site_url('admin/user');


                //re-set the session
                $params = array("row_array" => true,"conditions" => array("user_id" => $id));
                $data_user = $this->User_model->get_all_data($params)['datas'];
                $this->session->set_userdata("password", $data_user['password']);
                $this->session->set_userdata("username", $data_user['username']);
                $this->session->set_userdata("name", $data_user['name']);
                $this->session->set_userdata("photo", $data_user['photo']);
            }
        }

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;

    }

    /**
     * delete user
     */
    public function delete() {
         //must ajax and must post.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $this->load->model('User_model');
        //initial.
        $message['is_error'] = true;
        $message['redirect_to'] = "";
        $message['error_msg'] = "";

        $id = $this->input->post('id');

        if(!empty($id) && is_numeric($id)) {

            //check if admin id is the current login ?
            if($this->session->userdata('user_id') == $id) {

                $message['error_msg'] = 'cannot delete the user account you are currently logged in with.';
                //encoding
                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit;
            }

            $total = $this->User_model->get_all_data(array(
                "count_all_first" => true,
            ))['total'];

            //check if this is only the last in admin 
            if($total == 1) {
                $message['error_msg'] = 'Cannot delete the last user account. At least one admin account is needed to acces the management site.';
                //encoding and returning.
                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit;

            }

            //get data admin
            $data = $this->User_model->get_all_data(array(
                'find_by_pk' => array($id),
                'row_array'  => true,
            ))['datas'];

            if(empty($data)) {
                $message['error_msg'] = 'Invalid ID.';
            } else {
                //begin transaction
                $this->db->trans_begin();

                //delete the data 
                $condition = array('user_id' => $id);
                $delete = $this->User_model->delete($condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();

                    //failed.
                    $message['error_msg'] = 'database operation failed';
                } else {
                    $this->db->trans_commit();
                    //success.
                    $message['is_error'] = false;
                    $message['error_msg'] = '';

                    //growler.
                    $message['notif_title'] = "Done!";
                    $message['notif_message'] = "User has been delete.";
                    $message['redirect_to'] = "";
                }
            }
        } else {
            $message['error_msg'] = 'Invalid ID.';
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function list_select_role()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $this->load->model('User_level_model');

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();

        if($select_q != "") {
            $filters['role_name'] = $select_q;
        }

        $conditions = array();

        $params = $this->User_level_model->select_ajax($limit, $start, $conditions);

        // pr($params);exit;

        $message['page']        = $select_page;
        $message['get']         = $params;
        $message['paging_size'] = $limit;

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

    public function do_upload()
    {
        $this->load->library('upload');
        $config['upload_path'] = FCPATH . 'upload/user';
       
        if(!is_dir($config['upload_path'])){
          mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']  = '1024';
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('photo')) {
        	echo $config['upload_path'];
            $this->session->set_flashdata('success', $this->upload->display_errors(''));
            redirect(uri_string());

            $data = $this->upload->data();
            return $data['file_name'];
        }
    }
}