<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_manager extends CI_Controller {

    private $_article_model;
    private $_tag_model;
    private $_dm;
    private $_currentAdmin;

    private $_title       = "Artikel";
    private $_title_page  = 'Artikel ';
    private $_breadcrumb  = "<li><a href='/artikel/admin/dashboard'>Home</a></li>";
    private $_active_page = "artikel";
    private $_view        = "article/";

    protected $_currentUser;

    function __construct() {
        parent::__construct();
        //check user login
        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }

        //load model
        $this->load->model(array(
            'article/Article_model',
            'Dynamic_model'
        ));
        //new class for model
        $this->_article_model  = new Article_model();
        $this->_dm             = new Dynamic_model();
    }

    /*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"      => $this->_title,
            "title_page" => $this->_title_page,
            "breadcrumb" => $this->_breadcrumb ."<li>Artikel</li>",
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
                "asset/js/plugins/datatables/dataTables.colVis.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "asset/js/plugins/lightbox/js/lightbox.js",
                "asset/js/pages/artikel/list.js"
            ),
        );

       $this->load->view(HEADER_MANAGER, $header);
       $this->load->view($this->_view.'index');
       $this->load->view(FOOTER_MANAGER, $footer);
    }

    /**
     * create new article
     */
    public function create()
    {

        $header = array(
            "title"         => $this->_title ."-create",
            "title_page"    => $this->_title_page."-create",
            "breadcrumb"    => $this->_breadcrumb. "<li> Buat Artikel </li>",
            "active_page"   => $this->_active_page ."-create",
                "css" => array(
                    "asset/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                "asset/js/pages/artikel/create.js",
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

    /**
     * create new article
     */
    public function edit($id = null)
    {
        if(empty($id) && !is_numeric($id) && $id == '') {
            show_404();
        }

        $data['artikel'] = $this->_article_model->get_all_data(array(
            "select"                  => "at.*, at.artikel_id, artd.artikel_id, k.name, k.kategori_id",
            "left_joined"             => array(
                "tbl_kategori k"          => array("k.kategori_id"  => "at.artikel_category_id"),
                "tbl_artikel_detail artd" => array("artd.artikel_id" => "at.artikel_id")
            ),
            "conditions"              => array("at.artikel_id" => $id),
            "row_array"               => true,
            "order_by"                => array("at.artikel_id" => "asc"),
        ))['datas'];

        $data['artikel_detail'] = $this->_dm->set_model("tbl_artikel_detail","tad","artikel_detail_id")->get_all_data(array(
            "select"         => "tad.tag_id, tad.*, t.name",
            "joined"         => array(
                "tbl_artikel ar" => array("ar.artikel_id" => "tad.artikel_id"),
                "tbl_tag t"      => array("t.tag_id" => "tad.tag_id")),
            "conditions"     => array("tad.artikel_id" => $id),
            "row_array"      => true,
            "status"         => -1
        ))['datas'];
        // pr($data['artikel_detail']);exit;

        $header = array(
            "title"         => $this->_title ."- Edit",
            "title_page"    => $this->_title_page. "- Edit",
            "breadcrumb"    => $this->_breadcrumb ."<li> Edit Artikel</li>",
            "active-page"   => $this->_active_page ."edit",
                "css" => array(
                    "asset/css/select2.min.css",
                    "asset/js/plugins/lightbox/css/lightbox.css",
                    "asset/js/plugins/cropper/crop.css",
                    "asset/js/plugins/cropper/cropper.css"
            ),
        );

        $footer = array(
            "script" => array(
                "asset/js/pages/artikel/create.js",
                "asset/js/plugins/tinymce/tinymce.min.js",
                "asset/js/plugins/cropper/cropper.min.js",
                "asset/js/crop-master.js",
                "asset/js/plugins/select2/select2.full.min.js",
                "asset/js/plugins/lightbox/js/lightbox.js"
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'create', $data);
        $this->load->view(FOOTER_MANAGER, $footer);
    }


    /**
     * detail artikel
     */
    public function detail($id = null)
    {
        if(empty($id) && !is_numeric($id) && $id == '') {
            show_404();
        }

        $data['artikel'] = $this->_article_model->get_all_data(array(
            "select"                  => "at.*, at.artikel_id, artd.artikel_id, k.name, k.kategori_id,tr.role_id",
            "joined"                  => array(
                "tbl_user u"   => array("u.user_id" => "at.artikel_created_by")
            ),
            "left_joined"             => array(
                "tbl_kategori k"          => array("k.kategori_id"  => "at.artikel_category_id"),
                "tbl_artikel_detail artd" => array("artd.artikel_id" => "at.artikel_id"),
                "tbl_user_role tr"        => array("tr.role_id" => "u.role_Id")
            ),
            "conditions"              => array("at.artikel_id" => $id),
            "row_array"               => true,
            "order_by"                => array("at.artikel_id" => "asc"),
        ))['datas'];

       $data['artikel_detail'] = $this->_dm->set_model("tbl_artikel_detail","tad","artikel_detail_id")->get_all_data(array(
            "select"         => "tad.tag_id, tad.*, t.name",
            "joined"         => array(
                "tbl_artikel ar" => array("ar.artikel_id" => "tad.artikel_id"),
                "tbl_tag t"      => array("t.tag_id" => "tad.tag_id")),
            "conditions"     => array("tad.artikel_id" => $id),
            "row_array"      => true,
            "status"         => -1
        ))['datas'];
        // pr($data['artikel_detail']);exit;

        $header = array(
            "title"         => $this->_title ."- Detail",
            "title_page"    => $this->_title_page. "- Detail",
            "breadcrumb"    => $this->_breadcrumb ."<li> Detail Artikel</li>",
            "active-page"   => $this->_active_page ."Detail",
                "css" => array(
                    "asset/css/select2.min.css",
                    "asset/js/plugins/lightbox/css/lightbox.css",
            ),
        );

        $footer = array(
            "script" => array(
                "asset/js/pages/artikel/publish.js",
                "asset/js/plugins/tinymce/tinymce.min.js",
                "asset/js/plugins/select2/select2.full.min.js",
                "asset/js/plugins/lightbox/js/lightbox.js"
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'view', $data);
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
        $select = array(
            "at.artikel_id",
            "at.artikel_status",
            "artikel_judul",
            "artikel_isi",
            "artikel_photo",
            "artikel_created_date",
            "artikel_created_by",
            "u.username",
            "tur.role_id"
        );

        $joined = array(
            "tbl_user u" => array("u.user_id" => "artikel_created_by")
        );

        $left_joined = array(
            "tbl_user_role tur" => array("tur.role_id" => "u.role_Id")
        );

        $conditions = array("artikel_status NOT IN(0) " => NULL);

        $params = array(
            'select'            => $select,
            'conditions'        => $conditions,
            'order_by'          => array($select[$sort_col] => $sort_dir),
            'joined'            => $joined,
            'left_joined'       => $left_joined,
            'count_all_first'   => true,
            'limit'             => $limit,
            'keywords'          => $search,
        );

        $result = $this->_article_model->get_all_data($params);
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
     * ajax form
     */
    public function process_form()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error'] = true;
        $message['redirect_to'] = '';

        $id                  = $this->input->post('artikel_id');
        $artikel_judul       = $this->input->post('artikel_judul');
        $artikel_seo         = slug($this->input->post('artikel_seo'));
        $artikel_isi         = $this->input->post('artikel_isi');
        $artikel_create_date = date('Y-m-d H:i:s');
        $artikel_create_by   = $this->_currentAdmin['user_id'];
        $category_id         = $this->input->post('category_id');
        $tag                 = $this->input->post('tag');
        $data_image          = $this->input->post('data-image');

        $tag = (is_array($tag) && !empty($tag)) ? $tag : [];

        //set validation
        $this->_set_rule_validation();
        if($this->form_validation->run($this) == FALSE)
        {
            $message['error_msg'] = validation_errors();
        }
        else {
            $this->load->library('Uploader');

            $image = $this->upload_image("pejuangshubuh", "upload/article", "image-file", $data_image, 640, 640, $id );

            //begin transaction
            $this->db->trans_begin();
            //validation success
            //prepare save to DB
            $arrayToDb = array(
                'artikel_judul'        => $artikel_judul,
                'artikel_pretty_url'   => $artikel_seo,
                'artikel_isi'          => $artikel_isi,
                'artikel_created_date' => $artikel_create_date,
                'artikel_created_by'   => $artikel_create_by,
                'artikel_category_id'  => $category_id,
            );

            if(!empty($image)) {
                $arrayToDb['artikel_photo'] = $image;
            }

            //insert or update
            if($id == "") {
                //insert new tag to DB
                //insert to DB
                $result = $this->_article_model->insert($arrayToDb);
                $this->insert_tag($tag, $result);

                //end transaction
                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error'] = false;
                    $message['notif_title'] = 'Good!';
                    $message['notif_message'] = 'Article has been added';
                    $message['redirect_to'] = site_url('manager/article');
                }

            } else {

                $get_data = $this->_article_model->get_all_data(array(
                    "conditions" => array("artikel_id" => $artikel_id),
                    "row_array"  => true
                ))['datas'];

                //update
                $condition = array('artikel_id' => $artikel_id);

                if(!empty($image) && isset($get_data['artikel_photo']) && !empty($artikel_photo)) {
                    unlink( FCPATH .$get_data['artikel_photo']);
                }
                
                //update status to 2
                $arrayToDb['artikel_status'] = STATUS_EDITED;
                $result = $this->_article_model->update($arrayToDb, $condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Insert failed! Please try again.';
                } else {
                    $this->db->trans_commit();
                    //growler.
                    $message['is_error'] = false;
                    $message['notif_title'] = "Excellent!";
                    $message['notif_message'] = "Article has been updated.";

                    //on update, redirect.
                    $message['redirect_to'] = site_url('manager/article/');
                }
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * insert tag to table tag
     */
    public function insert_tag($tag, $id)
    {
        $condition = array("artikel_id" => $id);
        $delet_tag = $this->_dm->set_model("tbl_artikel_detail","tad","artikel_detail_id")->delete($condition);

        foreach($tag as $key => $value)
        {
            $tag_id = [];

            //check
            $check_tag = $this->_dm->set_model("tbl_tag","tg","tag_id")->get_all_data(array(
                "conditions" => array("tag_id" => $value),
                "row_array"  => true,
            ))['datas'];

            if($check_tag) {
                //jika ada
                $tag_id = $check_tag['tag_id'];
            }
            else {
                $insert_tag = $this->_dm->set_model("tbl_tag","tg","tag_id")->insert(array(
                    "name"         => $value,
                    "created_date" => date('Y-m-d H:i:s'),
                ));
                $tag_id = $insert_tag;
            }

            $insert_detail = $this->_dm->set_model("tbl_artikel_detail","tad","artikel_detail_id")->insert(array(
                // 'artikel_detail_id' => uniqid(),
                'artikel_id'        => $id,
                'tag_id'            => $tag_id
            ));
        }
    }

    //validation input
    private function _set_rule_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('');
        $this->form_validation->set_rules('artikel_judul','Judul','trim|required');
        $this->form_validation->set_rules('artikel_seo','Artikel SEO','trim|required');
        $this->form_validation->set_rules('category_id', 'Kategori artikel', 'trim|required');
    }

    /**
     * delete
     */
    public function delete()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $id          = $this->input->post('id');
        $delete_by   = $this->_currentAdmin["user_id"];
        $delete_date = date("Y-m-d H:i:s");

        if(empty($id) && !is_numeric($id)) {
            show_404();
        }
        else {

            $this->db->trans_begin();

            $arrayToDb = array(
                "artikel_status"        => STATUS_DELETED,
                "artikel_deleted_by"    => $delete_by,
                "artikel_deleted_date"  => $delete_date
            );

            $condition = array("artikel_id" => $id);

            $result = $this->_article_model->update($arrayToDb, $condition);
            //delete table relasi 
            if($result) {
                $this->_dm->set_model("tbl_artikel_detail","tad","artikel_detail_id")->delete(array("artikel_id" => $id));
            }

             //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['is_error']   = true;
            } else {
                $this->db->trans_commit();
                //growler.
                $message['is_error']   = false;
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article has been deleted.";

                //on update, redirect.
                $message['redirect_to'] = site_url('admin/article/');
            }
        }
        //send output
        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }
    
    //upload image
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

    /*
    * fungsi untuk publikasi artikel
    */
    public function publish_artikel()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initial 
        $message['is_error'] = true;

        $id = $this->input->post('id');

        if(empty($id)) {
        	$message['error_msg'] = "Invalid ID.";
        }
        else {

        	$this->db->trans_begin();

        	$arrayToDb = array(
        		"artikel_status"        => STATUS_PUBLISH,
                "artikel_published_date"  => NOW,
        	);

            $conditions = array("artikel_id" => $id);

        	$result = $this->_article_model->update($arrayToDb, $conditions);

        	 //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Database operation failed.';
            } else {
                $this->db->trans_commit();
                //growler.
                $message['is_error']    = false;
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article has been published.";

                //redirect
                $message['redirect_to'] = site_url('manager/article/');
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /*
    * fungsi untuk checked artikel
    */
    public function checked_artikel()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');

        if(empty($id)) {
            show_404();
        }
        else {

            $this->db->trans_begin();

            $arrayToDb = array(
                "artikel_stage"        => CHECKED_ARTICLE,
            );

            $conditions = array("artikel_id" => $id);

            $result = $this->_article_model->update($arrayToDb, $conditions);

             //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Database operation failed.';
            } else {
                $this->db->trans_commit();
                //growler.
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article has been published.";

                //on update, redirect.
                $message['redirect_to'] = site_url('admin/article/');
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /*
    * fungsi untuk cancel artikel
    */
    public function cancel_artikel()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');

        if(empty($id)) {
            show_404();
        }
        else {

            $this->db->trans_begin();

            $data = $this->_article_model->get_all_data(array(
                "count_all_first" => true,
            ))['datas'];

            $arrayToDb = array(
                "artikel_stage"        => CANCEL_ARTICLE,
            );

            $conditions = array("artikel_id" => $id);

            $result = $this->_article_model->update($arrayToDb, $conditions);

             //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Database operation failed.';
            } else {
                $this->db->trans_commit();
                //growler.
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article has been published.";

                //on update, redirect.
                $message['redirect_to'] = site_url('admin/article/');
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function list_select_tag()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();

        if($select_q != "") {
            $filters['name'] = $select_q;
        }

        $conditions = array();

        $params = $this->_dm->set_model("tbl_tag","tt","tag_id")->get_all_data(array(
            "select"     => "tag_id, name",
            "count_all_first" => true,
            "filter_or"  => $filters,
            "conditions" => $conditions,
            "limit"      => $limit,
            "start"      => $start
        ));

        //prepare returns.
        $message["page"] = $select_page;
        $message["total_data"] = $params['total'];
        $message["paging_size"] = $limit;
        $message["datas"] = $params['datas'];

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

    public function list_select_kategori()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();
        if($select_q != "") {
            $filters['name'] = $select_q;

        }
        $conditions = array();

        $params = $this->_dm->set_model("tbl_kategori","tk","kategori_id")->get_all_data(array(
            "select"     => "kategori_id, name",
            "filter_or"  => $filters,
            "conditions" => $conditions,
            "count_all_first" => true,
            "limit"      => $limit,
            "start"      => $start
        ));

        //prepare returns.
        $message["page"] = $select_page;
        $message["total_data"] = $params['total'];
        $message["paging_size"] = $limit;
        $message["datas"] = $params['datas'];

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }
}
/* End of file News.php */
/* Location: ./application/controllers/admin/News.php */
