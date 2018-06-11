<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_video_model extends CI_Model {
    
    public $_table = 'tbl_artikel_video';
    public $_table_alias = 'av';
    public $_pk_field    = 'artikel_video_id';

	function __construct() {
		parent::__construct();
	}

    /**
     * $params (Array) :
     * select (optional, default all) - array();
     * is_active (optional, default true) - boolean
     * order_by (optional , default id asc) - array("column" => "order");
     * find_by_pk (optional, default false) - array ("id1", "id2");
     * limit (optional default 0) - int
     * start (optional default 0) - int
     * keywords (optional default empty) - string
     * conditions (optional default false) - array()
     * row_array (optional default false) - boolean
     */
    public function get_all_data($params = array()){
        //default values.
        (isset($params["select"])) ? $select = $params["select"] : $select = "*";
        // (isset($params["status"])) ? $status = $params["status"] : $status = STATUS_ACTIVE;
        (isset($params["order_by"]) && $params["order_by"] != null) ? $orderBy = $params["order_by"] : $orderBy = array($this->_pk_field => "asc");
        (isset($params["find_by_pk"])) ? $findByPK = $params["find_by_pk"]: $findByPK = array();
        (isset($params["limit"])) ? $limit = $params["limit"] : $limit = 0;
        (isset($params["start"])) ? $start = $params["start"] : $start = 0;
        (isset($params["conditions"])) ? $conditions = $params["conditions"] : $conditions = "";
        (isset($params["filter"])) ? $filter = $params["filter"] : $filter = array();
        (isset($params["filter_or"])) ? $filter_or = $params["filter_or"] : $filter_or = array();
        (isset($params["row_array"])) ? $row_array = $params["row_array"] : $row_array = false;
        (isset($params["count_all_first"])) ? $count_all_first = $params["count_all_first"] : $count_all_first = false;
        (isset($params["joined"])) ? $joined = $params["joined"] : $joined = null;
        (isset($params["left_joined"])) ? $left_joined = $params["left_joined"] : $left_joined = null;
        (isset($params["from"])) ? $from = $params["from"] : $from = $this->_table." ".$this->_table_alias;
        (isset($params["group_by"])) ? $group_by = $params["group_by"] : $group_by = null;
        (isset($params["debug"])) ? $debug = $params["debug"] : $debug = false;
        (isset($params["keywords"])) ? $keywords = $params["keywords"] : $keywords = "";
        
        $this->db->select($select);
        // $this->db->where("is_active", $isActive);
        
        //for search for PK "id" as array.
        if (count($findByPK) > 0) {
            $this->db->where_in($this->_pk_field,$findByPK);
        }
        
        if ($conditions != "") {
            $this->db->where($conditions);
        }

          //for join table.
        if ($joined != null) {
            foreach ($joined as $table_name => $connector) {
                $this->db->join($table_name, key($connector)." = ".$connector[key($connector)]);
            }
        }

        //for left joined table.
        if ($left_joined != null) {
            foreach ($left_joined as $table_name => $connector) {
                $this->db->join($table_name, key($connector)." = ".$connector[key($connector)], "left", true);
            }
        }

        //for group by
        if ($group_by != null) {
            $this->db->group_by($group_by);
        }
        
        //before adding limit and start, count all first.
        if ($count_all_first) {
            $result['total'] = $this->db->count_all_results($from, false);
        } else {
            $result['total'] = 0;
            $this->db->from($from);
        }

        //for keywords will be put at the rest of the where syntax.
        if ($keywords != "") {
            $this->db->group_start();
            $this->db->like("artikel_judul",$keywords);
            $this->db->or_like("status",$keywords);
            $this->db->group_end();
        }
        
        //for ordering.
        foreach ($orderBy as $column => $order) {
            $this->db->order_by($column, $order);
        }

        //limit and start.
        $this->db->limit($limit, $start);
        //debug.
        if ($debug) {
            pq($this->db);exit;
        }
        
        if ($row_array === TRUE) {
            $result['datas'] = $this->_get_row();
        } else {
            $result['datas'] = $this->_get_array();
        }

        //return it.
        return $result;
    }

    private function _get_row () {
        $result = $this->db->get()->row_array();
    
        return $result;
    }


    private function _get_array() {
        $result = $this->db->get()->result_array();
        
        return $result;
    }

    public function count_all_data($isActive = null, $keywords = null, $conditions = null)
    {
        $this->db->select("count($this->_pk_field) as total");

        if ($keywords === null) $keywords = "";
        
        if ($conditions != "") {
            $this->db->where($conditions);
        }

        if ($keywords != "") {
            $this->db->group_start();
            $this->db->like("artikel_judul",$keywords);
            // $this->db->or_like("status",$keywords);
            $this->db->group_end();
        }

        return $this->db->get($this->_table)->row()->total;   
    }

    function insert($datas)
    {
        $this->db->insert($this->_table, $datas);
        return $this->db->insert_id();
    }

   
    function update($datas, $condition)
    {
        return $this->db->update($this->_table, $datas, $condition);
    }

    //function delete
    public function delete ($condition) {
        return $this->db->delete($this->_table, $condition);
    }
}

/* End of file Article_detail_model.php */
/* Location: ./application/models/Article_detail_model.php */