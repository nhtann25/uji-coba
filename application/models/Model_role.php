<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Model_role extends CI_Model{
    
    public function update_role($data,$table,$where){
        $this->db->update($table,$data,$where);
    }

    public function delete_data($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
    }

    
 }