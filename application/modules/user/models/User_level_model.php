<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_level_model extends CI_Model {
    
    private $_table = 'tbl_user_role';
    private $_pk 	= 'role_id';

    public function __construct() {
    	parent::__construct();
    }	

    public function get_all_data()
    {
    	$this->db->select($this->_table.".*");
    	$this->db->from($this->_table);

    	$res = $this->db->get();

    	return $res->result_array();
    }

    public function name_exist($name) {

        $this->db->where('role_name', $name);
        $res = $this->db->get($this->_table);
        return $res->row_array();
    }

    public function getById($id)
    {
    	$this->db->where('role_id', $id);
    	return $this->db->get($this->_table)->row_array();
    }

    public function insert($data) {
    	$this->db->insert($this->_table, $data);
    	return $this->db->insert_id();
    }

    public function update($data, $condition) {

    	return $this->db->update($this->_table, $data, $condition);
    }

    public function delete($id)
    {
    	$this->db->where('role_id', $id);
    	$this->db->delete($this->_table);
    }

    public function select_ajax($limit, $start, $condition) {

        $this->db->select('role_name, role_id');
        $this->db->where($condition);
        $this->db->limit($limit, $start);

        return $this->db->get($this->_table)->result_array();
    }

}

/* End of file User_level_model.php */
/* Location: ./application/models/User_level_model.php */