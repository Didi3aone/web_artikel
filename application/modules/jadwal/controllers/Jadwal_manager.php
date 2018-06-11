<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_manager extends CI_Controller {

	private $_dm;

	private $_title       = "Jadwal";
    private $_title_page  = 'Jadwal ';
    private $_breadcrumb  = "<li><a href='/jadwal/manager/dashboard'>Home</a></li>";
    private $_active_page = "jadwal";
    private $_view        = "jadwal/";
    private $_folder_js   = "asset/js/pages/jadwal/";
    private $_table       = "tbl_jadwal";
    private $_table_alias = "tj";
    private $_pk_field    = "jadwal_id";

	public function __construct() {
		parent::__construct();
		$this->load->model('Dynamic_model');
		$this->load->helper('base');

		 //check user login
        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }

		$this->_dm = new Dynamic_model();
	}
    
    /**
     * get list jadwal
     */
	public function index()
	{
		$header = array(
            "title"      => $this->_title,
            "title_page" => $this->_title_page,
            "breadcrumb" => $this->_breadcrumb ."<li>Jadwal</li>",
            "active_page"=> $this->_active_page ."-list",
            "css" => array(
                "asset/js/plugins/lightbox/css/lightbox.css"
            )
        );

        // pr($this->_header);exit;

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                // "asset/js/plugins/datatables/dataTables.colVis.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "asset/js/plugins/lightbox/js/lightbox.js",
                $this->_folder_js ."list.js",
            ),
        );

       $this->load->view(HEADER_MANAGER, $header);
       $this->load->view($this->_view.'index');
       $this->load->view(FOOTER_MANAGER, $footer);
	}

	/**
     * create new jadwal
     */
    public function create()
    {

        $header = array(
            "title"         => $this->_title ."-create",
            "title_page"    => $this->_title_page."-create",
            "breadcrumb"    => $this->_breadcrumb. "<li> Buat jadwal </li>",
            "active_page"   => $this->_active_page ."-create",
                "css" => array(
                    "asset/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                $this->_folder_js."create.js",
                "asset/js/plugins/tinymce/tinymce.min.js",
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
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'create');
        $this->load->view(FOOTER_MANAGER, $footer);
    }
    

    public function edit($id = null)
    {
        
        $data = array();
        $data['jadwal'] = $this->_dm->set_model($this->_table, $this->_table_alias, $this->_pk_field)->get_all_data(array(
        	"select" => "*",
        	"left_joined" => array("tbl_jadwal_kategori tjk" => array("tjk.jadwal_kategori_id" => $this->_table_alias.".jadwal_kategori_id")),
        	"conditions" => array("jadwal_id" => $id),
        	"status"  => -1,
        	"row_array" => true
        ))['datas'];

        $header = array(
            "title"         => $this->_title ."-create",
            "title_page"    => $this->_title_page."-create",
            "breadcrumb"    => $this->_breadcrumb. "<li> Buat jadwal </li>",
            "active_page"   => $this->_active_page ."-create",
                "css" => array(
                    "asset/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                $this->_folder_js."create.js",
                "asset/js/plugins/tinymce/tinymce.min.js",
                "asset/js/plugins/cropper/cropper.min.js",
                "asset/js/crop-master.js",
                "asset/js/plugins/select2/select2.full.min.js",
                "asset/js/plugins/bootstrap-daterangepicker-master/daterangepicker.js"
            ),
            "css"   => array(
                "asset/js/plugins/cropper/crop.css",
                "asset/js/plugins/cropper/cropper.css",
                "asset/js/plugins/bootstrap-daterangepicker-master/daterangepicker.css"
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'create', $data);
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
        $select = array("jadwal_id", "jadwal_name", "jadwal_location", "jadwal_photo");

        $conditions = array("jadwal_status" => "1");

        $params = array(
            'select'            => $select,
            'conditions'        => $conditions,
            'order_by'          => array($select[$sort_col] => $sort_dir),
            'count_all_first'   => true,
            'limit'             => $limit,
            'keywords'          => $search,
            'status'			=> -1,
            'debug'				=> false
        );

        $result = $this->_dm->set_model($this->_table, $this->_table_alias, $this->_pk_field)->get_all_data($params);

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

    private function _set_rule_validation() {

	    $this->load->library('form_validation' );
	    $this->form_validation->set_error_delimiters(" ", "");
    	$this->form_validation->set_rules("jadwal_name","trim|required");
        $this->form_validation->set_rules("jadwal_location","trim|required");
        $this->form_validation->set_rules("jadwal_start_date","trim|required");
        $this->form_validation->set_rules("jadwal_end_date","trim|required");
    }

     /**
     * ajax form
     */
    public function process_form()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error'] = true;
        $message['error_msg'] = '';

        $id                 = $this->input->post('jadwal_id');
        $jadwal_name        = $this->input->post('jadwal_name');
        $jadwal_lokasi      = $this->input->post('jadwal_location');
        $jadwal_start       = $this->input->post('jadwal_start_date');
        $jadwal_end         = $this->input->post('jadwal_end_date');
        $jadwal_desc        = $this->input->post('jadwal_description');
        $jadwal_kategori    = $this->input->post('jadwal_kategori_id');
        $jadwal_create      = date('Y-m-d H:i:s');
        $data_image         = $this->input->post('data-image');
        //date('Y-m-d H:i:s',strtotime('2014-12-12 12:34 AM'));
        $jadwal_starts       = DateTime::createFromFormat('Y-m-d H:i A', $jadwal_start);
        $jadwal_ends       = DateTime::createFromFormat('Y-m-d H:i A', $jadwal_end);
        // $jadwal_ends         = date('Y-m-d H:i:s', strtotime($jadwal_end));
         
         //pr($this->input->post());exit;

        // validation
        $this->_set_rule_validation();

        // pr($this->input->post());exit;
        if($this->form_validation->run($this) == true)
        {
            $message['error_msg'] = validation_errors();
        } else {
            $this->db->trans_begin();
            $this->load->library('Uploader');
            $image = $this->upload_image("jadwal", "upload/jadwal", "image-file", $data_image, 640, 640, $id );
            
	        //jika input end nya lebih kecil dari start
	        if($jadwal_end < $jadwal_start) {
	        	$message['error_msg'] = "jadwal end tidak boleh lebih kecil dari start";
	        	$this->output->set_content_type('application/json');
	            echo json_encode($message);
	            exit();
	        }
            //begin transaction
            
            //prepare save to DB
            $arrayToDb = array(
                'jadwal_name'         => $jadwal_name,
                'jadwal_location'     => $jadwal_lokasi,
                'jadwal_start'        => $jadwal_starts,
                'jadwal_end'          => $jadwal_ends,
                'jadwal_description'  => $jadwal_desc,
                'jadwal_kategori_id'  => $jadwal_kategori,
                'jadwal_created_date' => $jadwal_create,
            );

            if(!empty($image)) {
                $arrayToDb['jadwal_photo'] = $image;
            }

            //insert or update
            if($id == "") {
                //insert to DB
                $result = $this -> _dm -> set_model($this->_table, $this->_table_alias, $this->_pk_field) ->insert($arrayToDb);
                //end transaction
                if($this->db->trans_status() == false ) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error'] = false;
                    $message['notif_title'] = 'Good!';
                    $message['notif_message'] = 'jadwal has been added';
                    $message['redirect_to'] = site_url('manager/jadwal');
                }
            } else {

                //first get data
                $get_data = $this -> _dm -> set_model($this->_table, $this->_table_alias, $this->_pk_field) ->get_all_data(array(
                    "conditions" => array("jadwal_id" => $id),
                    "row_array"  => true,
                    "status" => -1
                ))['datas'];

                //update
                $condition = array('jadwal_id' => $id);

                if(!empty($image) && isset($get_data['jadwal_photo']) && !empty($jadwal_photo)) {
                    unlink( FCPATH .$get_data['jadwal_photo']);
                }
                $arrayToDb['jadwal_updated_date'] = date("Y-m-d H:i:s");

                $result = $this -> _dm -> set_model($this->_table, $this->_table_alias, $this->_pk_field) ->update($arrayToDb, $condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Update failed! Please try again.';
                } else {
                    $this->db->trans_commit();
                    //growler.
                    $message['is_error'] = false;
                    $message['notif_title'] = "Excellent!";
                    $message['notif_message'] = "Jadwal has been updated.";

                    //on update, redirect.
                    $message['redirect_to'] = site_url('manager/jadwal');
                }
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     *  delete
     */
    public function delete($id = null) {
    	// Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error'] = true;

        $id = $this->input->post('id');

        if(empty($id)) {
        	$message['error_msg'] = "Tidak ada sesuatu yang di hapus";
        	$this->output->set_content_type('application/json');
        	echo json_encode($data);
        	exit;
        } else {
        	$this->db->trans_begin();

            $result = $this -> _dm -> set_model($this->_table, $this->_table_alias, $this->_pk_field)->update(array(
            	"jadwal_status"   => STATUS_DELETED),
	            array("jadwal_id" => $id)
	        );
            
            if($this->db->trans_status() == false) {
            	$message['error_msg'] = "Database operation error";
            	$this->db->trans_rollback();
            } else {
            	$this->db->trans_commit();
            	$message['is_error'] = false;
            	$message['redirect_to'] = "";
            }

	        $this->output->set_content_type('application/json');
	    	echo json_encode($message);
	    	exit;
        }
    }

    /**
     *  list kategori
     */
    public function list_kategori() {
	    if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();

        if($select_q != "") {
            $filters['kategori_name'] = $select_q;
        }

        $conditions = array();

        $params = $this->_dm->set_model("tbl_jadwal_kategori","tjk","jadwal_kategori_id")->get_all_data(array(
            "select"          => "jadwal_kategori_id, kategori_name",
            "count_all_first" => true,
            "filter_or"       => $filters,
            "conditions"      => $conditions,
            "limit"      	  => $limit,
            "start"           => $start,
            "status"		  => -1
        ));

        //prepare returns.
        $message["page"] = $select_page;
        $message["total_data"] = $params['total'];
        $message["paging_size"] = $limit;
        $message["datas"] = $params['datas'];

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    protected function upload_image ($file_name, $saving_path, $key, $data_image, $width, $height, $id, $preset2 = array()) {
        $message['is_error'] = true;
        $message['error_msg'] = "";
        $message['redirect_to'] = "";

        //after successfull image upload and cropping, this var will contain the path to the file.
        $final_upload_path = "";

        if ($data_image != "") {
            //validation success.
            //prepare upload config.
            $config = array(
                "allowed_types"         =>  FILE_TYPE_UPLOAD,
                "file_ext_tolower"      =>  true,
                "overwrite"             =>  false,
                "max_size"              =>  MAX_UPLOAD_IMAGE_SIZE_IN_KB,
                "upload_path"           =>  "upload/temp",
            );

            if (!empty($file_name)) {
                $config['filename_overwrite'] = $file_name;
            }

            //load the uploader library.
            $this->load->library('Uploader');

            //try to upload the image.
            $upload_result = $this->uploader->upload_files($key, false, $config);

            if ($upload_result['is_error']) {
                if (($id == "" && $upload_result['result'][0]['error_code'] == 0) || $upload_result['result'][0]['error_code'] != 0) {
                    //file upload error of something.
                    //show the error.
                    $message['error_msg'] = $upload_result['result'][0]['error_msg'];

                    //encoding and returning.
                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                }

            }

            //get first index because it's not multiple files.
            $uploaded = $upload_result['result'];

            //file upload success.
            if (!$upload_result['is_error']) {

                //creating config for image resizing.
                $config = array(
                    "image_targets"     =>  array(
                        "preset1"   =>  array(
                            "target_path"   =>  $saving_path,
                            "target_width"  =>  $width,
                            "target_height" =>  $height,
                            "crop_data"     =>  $data_image,
                        ),
                    )
                );

                if (!empty($preset2)) {
                    $config['image_targets']['preset2'] = $preset2;
                }

                $image_result = $this->uploader->crop_images($uploaded['uploaded_path'], true, $config);

                //if there is somekind of error, write it to log.
                if ($image_result['is_error'] ) {
                    foreach ($image_result['result'] as $key => $value) {
                        $message['error_msg'] .= $image_result['error_msg'];
                    }

                    //encoding and returning.
                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                } else {
                    //success cropping.

                    if (!empty($preset2)) {
                        $final_upload_path = array(
                            "/".$image_result['result'][0]['uploaded_path'],
                            "/".$image_result['result'][1]['uploaded_path'],
                        );
                    } else {
                        $final_upload_path = "/".$image_result['result'][0]['uploaded_path'];
                    }


                }

            } else if ($upload_result['is_error'] && $uploaded[0]['error_code'] == 0) {
                //if file upload error, but the error is because there is no new file.

            }
        }
        return $final_upload_path;
    }

}

/* End of file Jadwal_manager.php */
/* Location: ./application/modules/jadwal/controllers/Jadwal_manager.php */