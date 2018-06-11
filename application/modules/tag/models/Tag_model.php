<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model {
     
    private $_table = 'tbl_tag';
    private $_pk_field = 'tag_id';
    private $_table_alias = 'tg';

	function __construct() {
		parent::__construct();
	}

	public function get_all_data($params = array()){
        //default values.
        (isset($params["select"])) ? $select = $params["select"] : $select = "*";
        (isset($params["status"])) ? $status = $params["status"] : $status = STATUS_ACTIVE;
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
            $this->db->like("tag",$keywords);
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
        
        if(isset($result['create_date'])) $result['create_date'] = format_date($result['create_date']);
        if(isset($result['last_update'])) $result['last_update'] = format_date($result['last_update']);
        
        return $result;
    }


    private function _get_array() {
        $result = $this->db->get()->result_array();
        
        if (count($result) > 0) {
            foreach ($result as $key => $data) {
                if(isset($result[$key]['create_date'])) $result[$key]['create_date'] = format_date($data['create_date']);
                if(isset($result[$key]['last_update'])) $result[$key]['last_update'] = format_date($data['last_update']);
            }
        }
        
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
            $this->db->like("tag",$keywords);
            $this->db->or_like("status",$keywords);
            $this->db->group_end();
        }

        return $this->db->get($this->_table)->row()->total;   
    }


    public function insert($datas)
    {
        $this->db->insert($this->_table, $datas);
        return $this->db->insert_id();
    }

   
    public function update($datas, $condition)
    {
        $datas['article_update'] = date('Y-m-d H:i:s');
        // $this->db->where('artikel_id', $id);
        return $this->db->update($this->_table, $datas, $condition);
    }
}

/* End of file Category_model.php */
/* Location: ./application/models/Category_model.php */