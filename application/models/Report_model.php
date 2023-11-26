<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Report_model extends CI_Model {
 
    public function get_report()
    {
        $query = $this->db->get('tbl_pesanan');
        return $query->result_array();
    }

    public function bookReport()
    {
        $query = $this->db->get('tbl_buku');
        return $query->result_array();
    }
}
?>