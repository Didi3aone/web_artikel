<?php if (!defined('BASEPATH')) exit ( 'No direct script access allowed');

class Article_model extends CI_Model
{
    private $_table = 'tbl_artikel';
    private $_pk_field = 'artikel_id';
    private $_table_alias = 'at';

    public static $status = array(
        0 => "Non-active",
        1 => "Created" ,
        2 => "Edited",
        3 => "Checked",
        4 => "Published"
    );

    function __construct()
    {
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
            $this->db->or_like($this->_table_alias.".artikel_status",$keywords);
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
    
    //private class output row array
    private function _get_row () {
        $result = $this->db->get()->row_array();
        
        return $result;
    }

    //private class output result array
    private function _get_array() {
        $result = $this->db->get()->result_array();
        
        //convert static
        if(count($result) > 0) {
            foreach ($result as $key => $value) {
                if(isset($value['artikel_status']) && array_key_exists($value['artikel_status'], self::$status) === TRUE) {
                    $result[$key]["status_name"] = self::$status[$value['artikel_status']];
                }
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

    public function update($datas, $condition)
    {
        $datas['artikel_updated_date'] = NOW;
        
        return $this->db->update($this->_table, $datas, $condition);
    }

    public function get_single_post()
    {
        $query = $this->db->query("SELECT artikel_id, artikel_judul, artikel_isi, artikel_photo, artikel_seo_title FROM $this->_table WHERE status = 1 ORDER BY artikel_id desc");

        return $query->row();
    }

    public function artikel_by_category($kategori_id)
    {
        $query = $this->db->query("
            SELECT * FROM $this->_table $this->_table_alias JOIN tbl_kategori tk ON $this->_table_alias.artikel_category_id = tk.kategori_id WHERE tk.kategori_id = $kategori_id AND $this->_table_alias.artikel_status = 'STATUS_PUBLISH' "
        );

        return $query->result_array();
    }

    function popular_post($id)
    {
        $active = 0;// default is delete
        $artikel_status = 1;// artikel active

        $this->db->select('a.*, t.name as tag_name');
        $this->db->from('artikel a');
        $this->db->join('category c', 'c.kategori_id = a.category_id');
        $this->db->join('user u', 'u.user_id = a.user_id');
        $this->db->join('tag t', 't.tag_id = a.tag_id');
        $this->db->where('a.artikel_is_delete', $active);
        $this->db->where('a.artikel_status', $artikel_status);

        $res = $this->db->get();

        if($res->num_rows() > 0)
        {
            return $res->result();
        }

        return null;
    }

    function update_counter($slug) {
    // return current article views 
        $this->db->where('artikel_slug', urldecode($slug));
        $this->db->select('article_viewer');
        $count = $this->db->get('artikel')->row();
    // then increase by one 
        $this->db->where('artikel_slug', urldecode($slug));
        $this->db->set('artikel_viewer', ($count->article_viewer + 1));
        $this->db->update('artikel');
    }

    // public function get_by_slug_and_id($slug, $id) 
    // {
    //     $this->db->query("SELECT *, FROM artikel at JOIN user u ON u.user_id = at.artikel_create_by ")
    // }

    function get_artikel_with_page($category_name, $limit, $start) 
    {
        $data = array();

        $data['data'] = $this->db->query(
            "SELECT *,(SELECT name FROM user u WHERE u.user_id = at.artikel_create_by) AS writer FROM artikel at WHERE is_active = 1 AND artikel_is_publish = 1 AND category_id (SELECT kategori_id FROM kategori WHERE kategori_nama = ?) ORDER BY at.artikel_create_date DESC LIMIT ?, ?", array($category_name, $start, $limit))->result_array();

        $data['count_all'] = $this->db->query(
            "SELECT count(artikel_id) as 'total' FROM artikel at WHERE is_active = 1 AND artikel_is_publish = 1 AND category_id = (SELECT kategori_id FROM kategori WHERE kategori_nama = ?)", array($category_name))->row_array()['total'];
        return $data;
    }
}