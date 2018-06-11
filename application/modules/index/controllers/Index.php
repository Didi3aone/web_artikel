<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    private $_article_model;
    private $_dm;
    private $_avm;
    private $_table = "tbl_kategori";
    private $_table_aliases = "tk";
    private $_pk_field = "kategori_id";

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model(array(
            'article/Article_model',
            'article_video/Article_video_model',
            'Dynamic_model'
        ));
        //new class for model
        $this->_article_model  = new Article_model();
        $this->_avm            = new Article_video_model();
        $this->_dm             = new Dynamic_model();
    }

    public function index()
    {
        ## -- Get artikel slide -- ##
        $select = 'at.*, t.name, u.username as create_by';
        //left joined
        $left_joined = array(
            'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
            'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
        );
        //joined
        $joined = array(
            'tbl_user u'            => array('u.user_id'     => 'at.artikel_created_by'),
        );
        //conditions
        $conditions = array(
            'at.artikel_status' => STATUS_PUBLISH,
        );
     
        $data['artikel'] = $this->_article_model->get_all_data(array(
            'select'            => $select,
            'joined'            => $joined,
            'left_joined'       => $left_joined, 
            'conditions'        => $conditions,
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => 3
        ))['datas'];
        // pr($data['artikel']);exit;
        ## -- End get artikel tab -- ##

        ##-- Artikel kategori berita harian -- ##
        $select = "
            tk.name, 
            tk.kategori_id, 
            at.artikel_judul, 
            at.artikel_isi,
            at.artikel_photo,
            at.artikel_pretty_url,
            at.artikel_status,
            t.name,
            tu.name,
        ";
        //joined
        $joined = array("tbl_artikel at" => array("at.artikel_category_id" => "tk.kategori_id"));
        //left_joined
        $left_joined = array(
            "tbl_artikel_detail tad" => array("tad.artikel_id" => "at.artikel_id"),
            "tbl_tag t"              => array("t.tag_id" => "tad.tag_id"),
            "tbl_user tu"            => array("tu.user_id" => "at.artikel_created_by")
        );
        //conditions 
        $conditions = array(
            "tk.kategori_id"    => ARTIKEL_KATEGORI_BERITA,
            "at.artikel_status" => STATUS_PUBLISH
        );

        $data['berita_harian'] = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk_field)->get_all_data(array(
            "select"        => $select,
            "joined"        => $joined,
            "left_joined"   => $left_joined,
            "limit"         => 3,
            "conditions"    => array("tk.kategori_id" => "46"),
            "order_by"      => array("at.artikel_id" => "desc"),
        ))['datas'];
        ##-- End artikel kategori berita harian --##

        ##-- Get all kategori --##
        $left_joined = array('tbl_artikel at' => array('at.artikel_category_id' => 'kt.kategori_id'));
        $data['kategori'] = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            'select'       => '*, at.*,',
            'left_joined'  => $left_joined,
        ))['datas'];
        ## -- End get all kategori --##

        ## -- Get artikel popular post -- ##
        $data['popular_post'] = $this->_article_model->get_all_data(array(
           
        ))['datas'];
        ## -- end get popular post -- ##
        
        ## -- prepare header -- ## 
        $header = array(
            "title"            => TITLE_WEBSITE,
            "meta_description" => null
        );
        ## -- End prepare Header -- ##
        // pr($header);exit();

        $this->load->view(LAYOUT_WEB_HEADER, $data);
        $this->load->view('index/front/index', $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
    }

    public function read($id = null, $slug = null)
    {
        $this->add_count($slug);
        $data['title']    = 'Read';
        $data['article']  = $this->Article_model->get_single_post(array('slug' => $slug,'id' => $id));
        // var_dump($data['article']);
        $this->load->view('web/header');
        $this->load->view('web/article', $data);
        $this->load->view('web/footer');
    }

    public function artikel_by_kategori($kategori_id = "") 
    {
        $header = array();

        $footer = array();

        // $header['slider'] =$this->_dm->set_model("tbl_background_slider","tbs","slider_id")->get_all_data(array(
        //     "conditions" => array("status" => STATUS_ACTIVE),
        //     "limit"      => 3,
        // ))['datas'];
               
        $data['artikel_by_kategori'] = $this->Article_model->artikel_by_category( $kategori_id );

        $this->load->view(LAYOUT_WEB_HEADER,$header);
        $this->load->view('index/front/artikel_by_kategori',$data);
        $this->load->view(LAYOUT_WEB_FOOTER,$footer);
    }
}

/* End of file News.php */
/* Location: ./application/controllers/News.php */