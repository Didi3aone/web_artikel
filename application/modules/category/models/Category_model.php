<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    
    private $_table = 'tbl_kategori';
    private $_table_alias = 'tk';
    private $_pk_field    = 'kategori_id';

	public function __construct() {
		parent::__construct();
	}
     
    //get category id from category name
    public function get_category_id ($category_name) {
    	return $this->db->query("SELECT $this->_pk_field FROM $this->_table WHERE nama_kategori = ?", $category_name)->row(0)->kategori_id;
    }

    public function get_category_name ($category_id) {
    	return $this->db->query("SELECT nama_kategori FROM $this->_table WHERE $this->_pk_field = ?", array($category_id))->row(0)->nama_kategori;
    }

    public function get_subcategory () {
    	return $this->db->query("SELECT * FROM $this->_table WHERE parent_id <> 0")->result_array();
    }

    public function get_subcategory_by_category($category, $keystroke) {
    	return $this->db->query("SELECT DISTINCT $this->_pk_field, nama_kategori FROM $this->_table WHERE parent_id = ? AND nama_kategori LIKE ?", array($category, "%".$keystroke."%"))->result_array();
    }
}

/* End of file Category_model.php */
/* Location: ./application/modules/category/models/Category_model.php */