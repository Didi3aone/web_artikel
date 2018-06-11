<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class article_video_manager extends CI_Controller {

    private $_avm;
    private $_currentAdmin;
    private $_title = "Artikel-video";
    private $_title_page = 'Artikel Video ';
    private $_breadcrumb = "<li><a href='/artikel-video/admin/dashboard'>Home</a></li>";
    private $_active_page = "artikel-video";

    protected $_currentUser;

    function __construct() {
        parent::__construct();

        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }

        //load model
        $this->load->model("Article_video_model");
        //new class for model
        $this->_avm = new Article_video_model();
    }

    /*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"      => $this->_title,
            "title_page" => $this->_title_page,
            "breadcrumb" => $this->_breadcrumb ."<li>Artikel Video</li>",
            "active_page"=> $this->_active_page ."-list",
        );

        // pr($this->_header);exit;

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "asset/js/pages/artikel_video/list.js"
            ),
        );

       $this->load->view(HEADER_MANAGER, $header);
       $this->load->view('article_video/index');
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
        );
        // pr($header);exit;

        $footer = array(
            "script" => array(
                // "asset/js/pages/artikel_video/create.js",
                "asset/js/plugins/markdown/markdown.min.js",
                "asset/js/plugins/markdown/to-markdown.min.js",
                "asset/js/plugins/markdown/bootstrap-markdown.min.js",
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view('admin/article-video/create');
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

        $data['artikel'] = $this->_avm->get_all_data(array(
            "conditions"              => array("artikel_video_id" => $id),
            "row_array"               => true,
        ))['datas'];

        $header = array(
            "title"         => $this->_title ."Edit",
            "title_page"    => $this->_title_page. "- Edit",
            "breadcrumb"    => $this->_breadcrumb ."<li> Edit Artikel</li>",
            "active-page"   => $this->_active_page ."edit",
        );

        $footer = array(
            "script" => array(
                "asset/js/pages/artikel_video/create.js",
                "asset/js/plugins/markdown/markdown.min.js",
                "asset/js/plugins/markdown/to-markdown.min.js",
                "asset/js/plugins/markdown/bootstrap-markdown.min.js",
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view('admin/article-video/create',$data);
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
        $select = array("artikel_video_id", "copyright", "url_video", "title");
        $conditions = array("av.status" => 1);

        $params = array(
            'select'            => $select,
            'conditions'        => $conditions,
            'order_by'          => array($select[$sort_col] => $sort_dir),
            'count_all_first'   => true,
            'limit'             => $limit,
            'keywords'          => $search,
        );

        $result = $this->_avm->get_all_data($params)['datas'];
        //Get total rows
        $total_rows = $this->_avm->count_all_data(null, $search);

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
     * ajax form
     */
    public function process_form()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //load library form validation
        $this->load->library("form_validation");

        //initital
        $message['is_error'] = true;
        $message['redirect_to'] = '';
        pr($this->input->post());exit;
        $id          = $this->input->post('id');
        $judul       = $this->input->post('judul');
        $url         = $this->input->post('url');
        $content     = $this->input->post("content");
        $sumber      = $this->input->post('sumber');
        $prettty_url = slug($this->input->post('pretty_url'));
        $now         = date("Y-m-d H:i:s");
        $writter     = $this->_currentAdmin['user_id'];

        //conversion to embed video youtube
        $url_video   = str_replace("/watch?v=","/embed/",$url);
        // $image_url   = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url_video, $match);
        // $image_url = $match[1];
        // $image_url = "http://img.youtube.com/vi/".$image_url."/0.jpg";

        //set validation
        $this->form_validation->set_rules("judul", "Judul", "trim|required");
        $this->form_validation->set_rules("url", "URL", "trim|required");
        $this->form_validation->set_rules("content", "Content", "trim|required");
        $this->form_validation->set_rules("prettty_url", "URL SEO", "trim|required");
 
        if($this->form_validation->run() == FALSE)
        {
            $message['error_msg'] = validation_errors();
        }
        else {
            //begin transaction
            $this->db->trans_begin();
            //validation success
            //prepare save to DB
            $arrayToDb = array(
                "title"       => $judul,
                "pretty_url"  => $prettty_url,
                "url_video"   => $url_video,
                // "url_image"   => $image_url,
                "conten"      => $content,
                "copyright"   => $sumber,
                "created_date" => $now,
                "created_by"  => $writter
            );

            //insert or update
            if($id) {

                //update
                $condition = array('artikel_video_id' => $id);     
                //then  insert updated date
                $arrayToDb['updated_date'] = $now;

                $result = $this->_avm->update($arrayToDb, $condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Insert failed! Please try again.';
                } else {
                    $this->db->trans_commit();
                    //growler.
                    $message['is_error']        = false;
                    $message['notif_title']     = "Excellent!";
                    $message['notif_message']   = "Article video has been updated.";

                    //on update, redirect.
                    $message['redirect_to']     = site_url('manager/artikel_video');
                }

            } else {

                //insert new tag to DB
                //insert to DB
                $result = $this->_avm->insert($arrayToDb);

                //end transaction
                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['notif_title']     = 'Good!';
                    $message['notif_message']   = 'Article video has been added';
                    $message['redirect_to']     = site_url('manager/artikel_video');
                }

            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
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
        $is_delete   = 0;
        if(empty($id) && !is_numeric($id)) {
            show_404();
        }
        else {

            $this->db->trans_begin();

            $arrayToDb = array(
                "status"     => $is_delete,
                "deleted_by" => $delete_by,
            );

            $condition = array("artikel_id" => $id);

            $result = $this->_avm->update($arrayToDb, $condition);

             //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Insert failed! Please try again.';
            } else {
                $this->db->trans_commit();
                //growler.
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article video has been deleted.";

                //on update, redirect.
                $message['redirect_to'] = site_url('admin/article_video');
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [publish_artikel description]
     * @return [array json]
     */
    public function publish_artikel()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $id  = $this->input->post('id');
        $now = date("Y-m-d H:i:s");
        //cheked id
        if(empty($id)) {
        	show_404();
        }
        else {

        	$this->db->trans_begin();

        	$data = $this->_avm->get_all_data(array(
        		"count_all_first" => true,
        	))['datas'];

        	$arrayToDb = array(
        		"is_publish"   => 1,
                "publish_date" => $now,
        	);

            $conditions = array("artikel_video_id" => $id);

        	$result = $this->_avm->update($arrayToDb, $conditions);

        	 //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Database operation failed.';
            } else {
                $this->db->trans_commit();
                //growler.
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article video has been published.";

                //on update, redirect.
                $message['redirect_to'] = site_url('admin/article-video');
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }
}
